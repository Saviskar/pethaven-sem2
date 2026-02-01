# Postman Production Testing Guide (Complete Reference)

This guide covers **every single available endpoint** in the PetHaven API.

## Prerequisites

1.  **Environment**: Ensure you have a "Production" environment set up with `base_url` (e.g., `http://your-ip/api`) and `token`.
2.  **Headers**: For **ALL** requests, it is best practice to include:
    *   `Accept`: `application/json` (Prevents HTML error pages)
3.  **Authentication**: For all **Protected** endpoints, add `Authorization: Bearer {{token}}`.

---

## 1. Authentication

### Register User
 Creates a new user account.
*   **Method**: `POST`
*   **URL**: `{{base_url}}/register`
*   **Body** (JSON):
    ```json
    {
        "name": "Test User",
        "email": "test@example.com",
        "password": "password",
        "password_confirmation": "password"
    }
    ```
*   **Response**: `201 Created` with `access_token`.

### Login User
Authenticates a user and returns a token.
*   **Method**: `POST`
*   **URL**: `{{base_url}}/login`
*   **Body** (JSON):
    ```json
    {
        "email": "test@example.com",
        "password": "password"
    }
    ```
*   **Response**: `200 OK` with `access_token`.
*   **Tip**: Add this to **Tests** tab to auto-save token:
    ```javascript
    if (pm.response.code === 200 || pm.response.code === 201) {
        pm.environment.set("token", pm.response.json().access_token);
        console.log("Token saved");
    }
    ```

### Get User Profile (Protected)
Returns details of the currently logged-in user.
*   **Method**: `GET`
*   **URL**: `{{base_url}}/user`
*   **Auth**: Bearer Token
*   **Response**: User object (`id`, `name`, `email`).

### Logout (Protected)
Invalidates the current token.
*   **Method**: `POST`
*   **URL**: `{{base_url}}/logout`
*   **Auth**: Bearer Token
*   **Response**: `200 OK` message.

---

## 2. Products & Categories (Public)

### List All Products
Returns a paginated list of products.
*   **Method**: `GET`
*   **URL**: `{{base_url}}/products`
*   **Query Parameters** (Optional):
    *   `page`: Page number (e.g., `?page=2`)
    *   `search`: Search by name (e.g., `?search=dog`)
    *   `category_id`: Filter by category (e.g., `?category_id=1`)
*   **Response**: Paginated JSON object (`data`, `links`, `meta`).

### Get Single Product
Returns details of a specific product.
*   **Method**: `GET`
*   **URL**: `{{base_url}}/products/{id}`
    *   Example: `{{base_url}}/products/1`
*   **Response**: Product object with category details.

### List Categories
Returns all product categories.
*   **Method**: `GET`
*   **URL**: `{{base_url}}/categories`
*   **Response**: List of categories.

---

## 3. Shopping Cart (Protected)

**Note**: The cart is stored persistently in the database for the logged-in user.

### View Cart
*   **Method**: `GET`
*   **URL**: `{{base_url}}/cart`
*   **Auth**: Bearer Token
*   **Response**: Cart object containing a list of `items` and their associated `product`.

### Add Item to Cart
*   **Method**: `POST`
*   **URL**: `{{base_url}}/cart`
*   **Auth**: Bearer Token
*   **Body** (JSON):
    ```json
    {
        "product_id": 1,
        "quantity": 1
    }
    ```
*   **Response**: Success message.

### Update Cart Item Quantity
Updates the quantity of a specific item **already in the cart**.
*   **Method**: `PUT`
*   **URL**: `{{base_url}}/cart/{item_id}`
    *   **Important**: `{item_id}` is the ID of the **CartItem** (found in the "View Cart" response), NOT the Product ID.
*   **Auth**: Bearer Token
*   **Body** (JSON):
    ```json
    {
        "quantity": 3
    }
    ```
*   **Response**: Success message.

### Remove Item from Cart
*   **Method**: `DELETE`
*   **URL**: `{{base_url}}/cart/{item_id}`
    *   **Important**: Use **CartItem ID**, not Product ID.
*   **Auth**: Bearer Token
*   **Response**: Success message.

---

## 4. Orders (Protected)

### Place Order
Converts the user's current cart into an order.
*   **Method**: `POST`
*   **URL**: `{{base_url}}/orders`
*   **Auth**: Bearer Token
*   **Body**: Empty (server uses current cart).
*   **Response**: Order object (ID, status, timestamp).

### List Orders
Returns user's order history.
*   **Method**: `GET`
*   **URL**: `{{base_url}}/orders`
*   **Auth**: Bearer Token
*   **Response**: List of orders with their items.

### Get Order Details
Returns full details of a specific order.
*   **Method**: `GET`
*   **URL**: `{{base_url}}/orders/{id}`
*   **Auth**: Bearer Token
*   **Response**: Order object including `items` and `product` details for each item.
