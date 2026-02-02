# CloudFront Integration Guide (Default Domain)

This guide walks you through setting up AWS CloudFront to serve your site via HTTPS using the default CloudFront domain (e.g., `https://d12345.cloudfront.net`).

## Prerequisites
- Access to your AWS Console.

---

## Step 1: Create CloudFront Distribution

1.  Go to the **AWS Console** -> **CloudFront**.
2.  Click **Create distribution**.  

### Origin Settings
- **Origin domain**: **Manually paste** your server's **Public IPv4 DNS** (e.g., `ec2-xx-xx.amazonaws.com`).
  - **IMPORTANT**: Do NOT use the IP address. AWS requires the DNS name (which looks like a long URL starting with `ec2-`).
  - *Ignore the dropdown list of S3 buckets.*
- **Protocol**: Select **Match Viewer**.

### Default Cache Behavior
- **Viewer protocol policy**: Select **Redirect HTTP to HTTPS**.
- **Allowed HTTP methods**: Select **GET, HEAD, OPTIONS, PUT, POST, PATCH, DELETE**.
- **Cache key and origin requests**:
  - **Cache policy**: Select `UseOriginCacheControlHeaders`.
  - **Origin request policy**: Select `AllViewer`.
    - *CRITICAL*: This option is essential. It ensures CloudFront forwards your User Login cookies, `Host` header, and everything else to Laravel.
    - *If you don't see it, search for "AllViewer" in the dropdown.*

### Web Application Firewall (WAF)
- **Select**: **Do not enable security protections**.
  - *Why?* "Enable security protections" adds AWS WAF, which costs extra ($$). For a basic HTTPS setup, you do not need this.

### Settings
- **Price class**: Use "Use all edge locations" (default).
- **Alternate domain name (CNAME)**: **LEAVE BLANK**.
- **Custom SSL certificate**: **LEAVE BLANK** (It will default to the CloudFront certificate).

3.  Click **Create distribution**.
4.  Wait for the status to change from "Deploying" to **Enabled**.

---

## Step 2: Configure Your Production Env

Once your distribution is created, you will get a domain like `d12345abcd.cloudfront.net`.

1.  Use SSH to access your production server.
2.  Edit your `.env` file:
    ```bash
    APP_URL=https://d12345abcd.cloudfront.net
    ASSET_URL=https://d12345abcd.cloudfront.net
    ```
    *Replace `d12345abcd.cloudfront.net` with your actual CloudFront domain.*

3.  Clear the cache:
    ```bash
    php artisan config:cache
    ```

---

## Verification
1.  Visit your new CloudFront URL: `https://d12345abcd.cloudfront.net`.
2.  Verify the site loads with valid SSL (lock icon).
3.  Right-click an image -> **Inspect**. Verify the URL starts with your CloudFront domain.

---

### Troubleshooting
- **Links point to old IP?** Make sure you updated `APP_URL` in your `.env` and cleared the cache.
- **Images broken?** CloudFront might take a minute to cache the first time. Refresh.

### Code Changes (Already Applied)
I have updated `bootstrap/app.php` to trust proxies so Laravel handles the secure connection correctly.
