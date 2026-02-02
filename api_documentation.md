# PetHaven API Documentation

This document outlines the API endpoints available for the PetHaven application.

**Base URL**: `http://<your-domain>/api` (e.g., `http://10.0.2.2:8000/api` for Android emulator accessing local server)

## Authentication

### Register
Create a new user account.

- **URL**: `/register`
- **Method**: `POST`
- **Access**: Public
- **Parameters**:
  - `name` (required, string): User's full name.
  - `email` (required, string, email): User's email address (unique).
  - `password` (required, string): Password (min 8 characters).
  - `mobile` (optional, string): Phone number.
- **Response**:
  - `201 Created`:
    ```json
    {
      "message": "User registered successfully",
      "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "mobile": "1234567890",
        "role_id": 2,
        "created_at": "...",
        "updated_at": "..."
      },
      "access_token": "qtw...",
      "token_type": "Bearer"
    }
    ```
  - `422 Unprocessable Entity`: Validation errors.

### Login
Authenticate a user and retrieve an access token.

- **URL**: `/login`
- **Method**: `POST`
- **Access**: Public
- **Parameters**:
  - `email` (required, string)
  - `password` (required, string)
- **Response**:
  - `200 OK`:
    ```json
    {
      "message": "Login successful",
      "data": { "id": 1, ... },
      "access_token": "qtw...",
      "token_type": "Bearer"
    }
    ```
  - `401 Unauthorized`: Invalid credentials.

### Logout
Invalidate the current access token.

- **URL**: `/logout`
- **Method**: `POST`
- **Access**: Protected (Bearer Token required)
- **Response**:
  - `200 OK`:
    ```json
    {
      "message": "Logged out successfully"
    }
    ```

### Get User Profile
Get the currently authenticated user's details.

- **URL**: `/user`
- **Method**: `GET`
- **Access**: Protected
- **Response**:
  - `200 OK`: Returns the user object JSON.

---

## Products & Categories

### Get All Products
Retrieve a paginated list of products.

- **URL**: `/products`
- **Method**: `GET`
- **Access**: Public
- **Parameters**:
  - `category_id` (optional): Filter products by category ID.
  - `search` (optional): Search products by name.
  - `page` (optional): Page number (default: 1).
- **Response**:
  - `200 OK`:
    ```json
    {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "name": "Dog Food",
          "category": { "id": 1, "name": "Food" },
          ...
        }
      ],
      "first_page_url": "...",
      "next_page_url": "...",
      ...
    }
    ```

### Get Single Product
Retrieve details of a specific product.

- **URL**: `/products/{id}`
- **Method**: `GET`
- **Access**: Public
- **Response**:
  - `200 OK`:
    ```json
    {
      "data": {
        "id": 1,
        "name": "Dog Food",
        "description": "...",
        "price": 10.00,
        "stock": 50,
        "category": { ... }
      }
    }
    ```
  - `404 Not Found`: Product does not exist.

### Get Categories
Retrieve all product categories.

- **URL**: `/categories`
- **Method**: `GET`
- **Access**: Public
- **Response**:
  - `200 OK`:
    ```json
    {
      "data": [
        { "id": 1, "name": "Food", "slug": "food", ... },
        { "id": 2, "name": "Toys", "slug": "toys", ... }
      ]
    }
    ```

---

## Cart
All cart endpoints require Authentication.

### Get Cart
Retrieve the current user's cart. Creates an empty cart if one doesn't exist.

- **URL**: `/cart`
- **Method**: `GET`
- **Access**: Protected
- **Response**:
  - `200 OK`:
    ```json
    {
      "data": {
        "id": 1,
        "user_id": 1,
        "items": [
          {
            "id": 5,
            "cart_id": 1,
            "product_id": 2,
            "quantity": 3,
            "product": { "id": 2, "name": "Cat Toy", "price": 5.00, ... }
          }
        ]
      }
    }
    ```

### Add to Cart
Add an item to the cart or update quantity if it already exists.

- **URL**: `/cart`
- **Method**: `POST`
- **Access**: Protected
- **Parameters**:
  - `product_id` (required, integer, exists in products table).
  - `quantity` (required, integer, min: 1).
- **Response**:
  - `200 OK`:
    ```json
    { "message": "Item added to cart" }
    ```

### Update Cart Item
Update the quantity of a specific item in the cart.

- **URL**: `/cart/{itemId}` (Note: `itemId` is the `id` from the `items` array in Get Cart response, NOT product_id)
- **Method**: `PUT`
- **Access**: Protected
- **Parameters**:
  - `quantity` (required, integer, min: 1).
- **Response**:
  - `200 OK`:
    ```json
    { "message": "Cart updated" }
    ```

### Remove Cart Item
Remove an item from the cart.

- **URL**: `/cart/{itemId}`
- **Method**: `DELETE`
- **Access**: Protected
- **Response**:
  - `200 OK`:
    ```json
    { "message": "Item removed from cart" }
    ```

---

## Orders
All order endpoints require Authentication.

### Get All Orders
Retrieve a history of orders placed by the user.

- **URL**: `/orders`
- **Method**: `GET`
- **Access**: Protected
- **Response**:
  - `200 OK`:
    ```json
    {
      "data": [
        {
          "id": 1,
          "placed_at": "2024-01-01...",
          "status": "processing",
          "items": [ ... ]
        }
      ]
    }
    ```

### Get Single Order
Retrieve details of a specific order.

- **URL**: `/orders/{id}`
- **Method**: `GET`
- **Access**: Protected
- **Response**:
  - `200 OK`: Returns order data with items.

### Place Order
Convert the current user's cart into an order.
**Note**: This action clears the cart and deducts stock.

- **URL**: `/orders`
- **Method**: `POST`
- **Access**: Protected
- **Parameters**: None (Uses current cart)
- **Response**:
  - `201 Created`:
    ```json
    {
      "message": "Order placed successfully",
      "data": { "id": 123, "status": "processing", ... }
    }
    ```
  - `400 Bad Request`: "Cart is empty"
  - `500 Internal Server Error`: "Product X is out of stock..."
