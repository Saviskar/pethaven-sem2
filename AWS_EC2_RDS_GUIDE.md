# AWS Deployment Guide: Laravel on EC2 + RDS

This guide will walk you through hosting your Laravel application on **AWS EC2** (Ubuntu Server) and using **AWS RDS** (MySQL) for the database.

## Prerequisites

- An active AWS Account.
- **Region**: Select **Asia Pacific (Singapore) ap-southeast-1** in the top-right corner of the AWS Console.
- Terminal (Linux/Mac) or PowerShell/Git Bash (Windows) on your local machine.
- This project code.

---

## Phase 1: Create the Database (AWS RDS)

1.  **Log in to AWS Console** and search for **RDS**.
2.  Click **Create database**.
3.  **Choose a database creation method**: Standard create.
4.  **Engine options**: MySQL.
5.  **Templates**: Free tier.
6.  **Settings**:
    -   **DB instance identifier**: `pethaven-db`
    -   **Master username**: `admin`
    -   **Master password**: Create a secure password (and save it!).
7.  **Instance configuration**: `db.t3.micro` (or `db.t2.micro` if t3 not available).
8.  **Connectivity**:
    -   **Public access**: **No** (For security, only EC2 should access it).
    -   **VPC security group**: Create new. Name it `rds-sec-group`.
9.  Click **Create database**.
10. Note: This will take a few minutes to create.

---

## Phase 2: Create the Server (AWS EC2)

1.  Search for **EC2** in AWS Console.
2.  Click **Launch Instances**.
3.  **Name**: `pethaven-server`.
4.  **OS Images**: Ubuntu Server 24.04 LTS (HVM), SSD Volume Type.
5.  **Instance type**: `t2.micro` (Free tier eligible) or `t3.micro`.
6.  **Key pair (login)**:
    -   Click **Create new key pair**.
    -   Name: `pethaven-key`.
    -   Type: `RSA`.
    -   Format: `.pem` (for Linux/Mac) or `.ppk` (if using PuTTY on Windows, but `.pem` is standard now for OpenSSH).
    -   **Download the key file** and store it safely (e.g., `~/.ssh/pethaven-key.pem`).
7.  **Network settings**:
    -   **Allow SSH traffic** from **My IP** (For security).
    -   **Allow HTTPS traffic** from the internet.
    -   **Allow HTTP traffic** from the internet.
8.  Click **Launch instance**.

---

## Phase 3: Network Configuration (Connecting EC2 to RDS)

1.  Go to **EC2 Dashboard** > **Instances**.
2.  Select your new instance (`pethaven-server`) and copy the **Private IPv4 address**. (We might not need this explicitly if using Security Groups correctly).
3.  Go to **RDS Dashboard** > **Databases**.
4.  Click on `pethaven-db`.
5.  Under **Connectivity & security**, click the link under **VPC security groups** (e.g., `rds-sec-group`).
6.  Select the security group again, go to the **Inbound rules** tab, and click **Edit inbound rules**.
7.  **Add rule**:
    -   **Type**: MySQL/Aurora (3306).
    -   **Source**: **Custom**. Start typing "sg" and select the **Security Group ID of your EC2 instance** specifically (this is the safest way). Alternatively, enter the Private IP of the EC2 instance `/32`.
8.  Click **Save rules**.

---

## Phase 4: Server Setup (Installing Software)

1.  **Connect to your EC2 instance**:
    Open your local terminal where your key is located.
    ```bash
    chmod 400 pethaven-key.pem
    # Check your Public IP from EC2 Console
    ssh -i "pethaven-key.pem" ubuntu@<YOUR_EC2_PUBLIC_IP>
    ```

2.  **Update and Install Dependencies**:
    Run the following commands on the server:
    ```bash
    sudo apt update
    sudo apt install -y nginx zip unzip git curl libpng-dev libonig-dev libxml2-dev
    ```

3.  **Install PHP 8.2** (Ubuntu 24.04 usually has 8.3 by default, let's verify or add PPA):
    ```bash
    sudo add-apt-repository ppa:ondrej/php -y
    sudo apt update
    sudo apt install -y php8.2-fpm php8.2-cli php8.2-mysql php8.2-mbstring php8.2-xml php8.2-bcmath php8.2-curl php8.2-zip php8.2-intl php8.2-gd
    ```

4.  **Install Composer**:
    ```bash
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
    ```

---

## Phase 5: Deploy Application

1.  **Clone your repository**:
    (You might need to generate an SSH key on the server and add it to GitHub/GitLab if it's private, or use HTTPS with a token).
    ```bash
    cd /var/www
    sudo git clone <YOUR_REPO_URL> pethaven
    # If private: use HTTPS and enter username/personal_access_token
    ```

2.  **Set Permissions**:
    ```bash
    sudo chown -R ubuntu:www-data /var/www/pethaven
    sudo chmod -R 775 /var/www/pethaven/storage
    sudo chmod -R 775 /var/www/pethaven/bootstrap/cache
    ```

3.  **Setup Environment**:
    ```bash
    cd /var/www/pethaven
    cp .env.production.example .env
    nano .env
    ```
    -   **Fill in**: `DB_HOST` (RDS Endpoint from AWS Console), `DB_PASSWORD`, etc.
    -   Set `APP_URL=http://<YOUR_EC2_PUBLIC_IP>`

4.  **Install Dependencies & Build**:
    ```bash
    composer install --optimize-autoloader --no-dev
    php artisan key:generate
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan migrate --force
    ```
    *Note: Since we are not building frontend assets on the server (node/npm is heavy/complex), it's best to commit your `public/build` folder if using Vite, OR run `npm install && npm run build` on the server if you have enough RAM (t2.micro might crash).*
    *Recommended for t2.micro*: Build locally and commit `public/build`, or use SCP to upload `public/build`.

---

## Phase 6: Nginx Configuration

1.  **Create Nginx Config**:
    ```bash
    sudo nano /etc/nginx/sites-available/pethaven
    ```

2.  **Paste the following content** (Modify `server_name` if you have a domain):
    ```nginx
    server {
        listen 80;
        listen [::]:80;
        server_name _;
        root /var/www/pethaven/public;

        add_header X-Frame-Options "SAMEORIGIN";
        add_header X-Content-Type-Options "nosniff";

        index index.php;

        charset utf-8;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt  { access_log off; log_not_found off; }

        error_page 404 /index.php;

        location ~ \.php$ {
            fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
            fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
            include fastcgi_params;
        }

        location ~ /\.(?!well-known).* {
            deny all;
        }
    }
    ```

3.  **Enable Site**:
    ```bash
    sudo ln -s /etc/nginx/sites-available/pethaven /etc/nginx/sites-enabled/
    sudo rm /etc/nginx/sites-enabled/default
    sudo nginx -t
    sudo systemctl restart nginx
    ```

## Phase 7: Mobile App Access

Your API is now available at:
`http://<EC2_PUBLIC_IP>/api`

In your Flutter app, update your base URL to this IP.
