# Postman API Testing Guide for PetHaven

This guide will help you set up and test the PetHaven REST API using Postman.

## 1. Prerequisites

- Download and install [Postman](https://www.postman.com/downloads/).
- Ensure your Laravel server is running:
  ```bash
  php artisan serve --host=0.0.0.0
  ```
  *(Note: Adjust the host/port if necessary)*

## 2. Environment Setup

To make testing easier, we'll use Postman Environment variables.

1.  Open Postman.
2.  Click on **Environments** in the left sidebar -> **Create Environment**.
3.  Name it `PetHaven Local`.
4.  Add the following variables:

    | Variable | Initial Value | Current Value |
    | :--- | :--- | :--- |
    | `base_url` | `http://127.0.0.1:8000/api` | `http://127.0.0.1:8000/api` |
    | `token` | *(leave empty)* | *(leave empty)* |

5.  **Save** the environment and select it from the top-right dropdown.

---

## 3. Collection Structure & Requests

Create a new Collection named `PetHaven API`.

### A. Authentication Folder

#### 1. Register User
*   **Method**: `POST`
*   **URL**: `{{base_url}}/register`
*   **Headers**:
    *   `Accept`: `application/json`
*   **Body** (`raw` -> `JSON`):
    ```json
    {
        "name": "Test User",
        "email": "test@example.com",
        "password": "password",
        "password_confirmation": "password"
    }
    ```
*   **Tests** (Tab):
    *   Add this script to automatically save the token:
        ```javascript
        if (pm.response.code === 201) {
            var jsonData = pm.response.json();
            pm.environment.set("token", jsonData.access_token);
            console.log("Token saved:", jsonData.access_token);
        }
        ```

#### 2. Login User
*   **Method**: `POST`
*   **URL**: `{{base_url}}/login`
*   **Headers**:
    *   `Accept`: `application/json`
*   **Body** (`raw` -> `JSON`):
    ```json
    {
        "email": "test@example.com",
        "password": "password"
    }
    ```
*   **Tests** (Tab):
    *   Add the same script as Register to update the token on login:
        ```javascript
        if (pm.response.code === 200) {
            var jsonData = pm.response.json();
            pm.environment.set("token", jsonData.access_token);
        }
        ```

#### 3. Logout
*   **Method**: `POST`
*   **URL**: `{{base_url}}/logout`
*   **Auth**: Type `Bearer Token` -> Token: `{{token}}`
*   **Headers**: `Accept: application/json`

#### 4. Get User Profile
*   **Method**: `GET`
*   **URL**: `{{base_url}}/user`
*   **Auth**: Type `Bearer Token` -> Token: `{{token}}`
*   **Headers**: `Accept: application/json`

---

### B. Products & Categories (Public)

#### 1. List Categories
*   **Method**: `GET`
*   **URL**: `{{base_url}}/categories`
*   **Headers**: `Accept: application/json`

#### 2. List Products
*   **Method**: `GET`
*   **URL**: `{{base_url}}/products`
*   **Headers**: `Accept: application/json`
*   **Query Params** (Optional):
    *   `category_id`: `1`
    *   `search`: `drug`

#### 3. Get Single Product
*   **Method**: `GET`
*   **URL**: `{{base_url}}/products/1`
*   **Headers**: `Accept: application/json`

---

### C. Cart (Protected)

**Important**: For all requests in this folder, go to the **Authorization** tab, select **Bearer Token**, and enter `{{token}}`.

#### 1. View Cart
*   **Method**: `GET`
*   **URL**: `{{base_url}}/cart`

#### 2. Add to Cart
*   **Method**: `POST`
*   **URL**: `{{base_url}}/cart`
*   **Body** (`raw` -> `JSON`):
    ```json
    {
        "product_id": 1,
        "quantity": 1
    }
    ```

#### 3. Update Cart Item
*   **Method**: `PUT`
*   **URL**: `{{base_url}}/cart/{cart_item_id}`
    *   *(Replace `{cart_item_id}` with an actual ID from the View Cart response)*
*   **Body** (`raw` -> `JSON`):
    ```json
    {
        "quantity": 3
    }
    ```

#### 4. Remove Cart Item
*   **Method**: `DELETE`
*   **URL**: `{{base_url}}/cart/{cart_item_id}`

---

### D. Orders (Protected)

**Important**: Ensure **Bearer Token** is set to `{{token}}`.

#### 1. Place Order
*   **Method**: `POST`
*   **URL**: `{{base_url}}/orders`
*   **Body**: *(Empty if your logic takes all items from cart)*

#### 2. List Orders
*   **Method**: `GET`
*   **URL**: `{{base_url}}/orders`

#### 3. Get Order Details
*   **Method**: `GET`
*   **URL**: `{{base_url}}/orders/{order_id}`

---

## 4. Common Issues & Troubleshooting

| Status Code | Meaning | Solution |
| :--- | :--- | :--- |
| **401 Unauthorized** | Token is missing or invalid. | Run the **Login** request again to refresh the `token` variable. Check if **Authorization** tab is set to Bearer Token. |
| **422 Unprocessable Content** | Validation failed. | Check the response body for error messages (e.g., missing fields, wrong data types). |
| **500 Internal Server Error** | Server-side crash. | Check your Laravel logs (`storage/logs/laravel.log`) or the terminal running `php artisan serve`. |
| **Connection Refused** | Server not running. | Ensure `php artisan serve` is running and the `base_url` port matches. |

## 5. Next Steps
Once you have verified that all endpoints work correctly in Postman, you can confidently proceed to integrate them into your Flutter application, knowing the backend logic is sound.
