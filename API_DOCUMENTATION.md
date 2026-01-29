# PetHaven API Documentation

Base URL: `http://<your-server-ip>:8000/api`

## Authentication

### Register
Create a new user account.

- **Endpoint**: `POST /register`
- **Headers**: `Accept: application/json`
- **Body**:
    ```json
    {
        "name": "User Name",
        "email": "user@example.com",
        "password": "password",
        "mobile": "0123456789" // Optional
    }
    ```
- **Response** (201 Created):
    ```json
    {
        "message": "User registered successfully",
        "data": { ...user details... },
        "access_token": "1|...",
        "token_type": "Bearer"
    }
    ```

### Login
Login and receive an access token.

- **Endpoint**: `POST /login`
- **Headers**: `Accept: application/json`
- **Body**:
    ```json
    {
        "email": "user@example.com",
        "password": "password"
    }
    ```
- **Response** (200 OK):
    ```json
    {
        "message": "Login successful",
        "data": { ...user details... },
        "access_token": "2|...",
        "token_type": "Bearer"
    }
    ```

### Logout
Revoke the current access token.

- **Endpoint**: `POST /logout`
- **Headers**: 
    - `Accept: application/json`
    - `Authorization: Bearer <token>`
- **Response** (200 OK):
    ```json
    {
        "message": "Logged out successfully"
    }
    ```

### Get User Profile
Get the currently authenticated user's details.

- **Endpoint**: `GET /user`
- **Headers**: `Authorization: Bearer <token>`
- **Response** (200 OK): `User object`

---

## Products & Categories

### List Categories
Get all product categories.

- **Endpoint**: `GET /categories`
- **Headers**: `Accept: application/json`
- **Response** (200 OK):
    ```json
    {
        "data": [
            { "id": 1, "name": "Dog", ... }
        ]
    }
    ```

### List Products
Get a list of products with optional filtering.

- **Endpoint**: `GET /products`
- **Query Parameters**:
    - `category_id`: Filter by category ID (e.g., `?category_id=1`)
    - `search`: Search by product name (e.g., `?search=food`)
- **Response** (200 OK): Paginated list of products.

### Get Product Details
Get details of a specific product.

- **Endpoint**: `GET /products/{id}`
- **Response** (200 OK):
    ```json
    {
        "data": { "id": 1, "name": "Product Name", "price": 100.00, ... }
    }
    ```

---

## Cart
**Require Authentication** (`Authorization: Bearer <token>`)

### View Cart
Get the current user's cart.

- **Endpoint**: `GET /cart`
- **Response** (200 OK):
    ```json
    {
        "data": {
            "id": 1,
            "items": [
                {
                    "id": 1,
                    "product_id": 5,
                    "quantity": 2,
                    "product": { ... }
                }
            ]
        }
    }
    ```

### Add to Cart
Add an item to the cart.

- **Endpoint**: `POST /cart`
- **Body**:
    ```json
    {
        "product_id": 1,
        "quantity": 1
    }
    ```
- **Response** (200 OK): `{"message": "Item added to cart"}`

### Update Cart Item
Update the quantity of a specific item in the cart.

- **Endpoint**: `PUT /cart/{cartItemId}`
- **Body**:
    ```json
    {
        "quantity": 3
    }
    ```
- **Response** (200 OK): `{"message": "Cart updated"}`

### Remove from Cart
Remove an item from the cart.

- **Endpoint**: `DELETE /cart/{cartItemId}`
- **Response** (200 OK): `{"message": "Item removed from cart"}`

---

## Orders
**Require Authentication** (`Authorization: Bearer <token>`)

### Place Order
Create an order from the current items in the cart.

- **Endpoint**: `POST /orders`
- **Response** (201 Created):
    ```json
    {
        "message": "Order placed successfully",
        "data": { "id": 101, "status": "processing", ... }
    }
    ```

### List Orders
Get a list of the user's past orders.

- **Endpoint**: `GET /orders`
- **Response** (200 OK): `{"data": [ ...list of orders... ]}`

### Get Order Details
Get details of a specific order.

- **Endpoint**: `GET /orders/{id}`
- **Response** (200 OK): `{"data": { ...order details with items... }}`
