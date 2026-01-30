import requests
import random
import string
import sys

BASE_URL = 'http://127.0.0.1:8001/api'

def get_random_string(length):
    letters = string.ascii_lowercase
    return ''.join(random.choice(letters) for i in range(length))

def log(msg):
    print(f"[TEST] {msg}")

def test_workflow():
    session = requests.Session()
    
    # 1. Register
    email = f"test_{get_random_string(5)}@example.com"
    password = "password123"
    name = "Test User"
    
    log(f"Registering user: {email}")
    res = session.post(f"{BASE_URL}/register", json={
        "name": name,
        "email": email,
        "password": password,
        "password_confirmation": password
    })
    
    if res.status_code != 201:
        log(f"Registration failed: {res.text}")
        sys.exit(1)
        
    token = res.json()['access_token']
    headers = {'Authorization': f'Bearer {token}', 'Accept': 'application/json'}
    log("Registration successful.")

    # 2. Login (Optional since register returns token, but good to test)
    log("Testing Login")
    res = session.post(f"{BASE_URL}/login", json={
        "email": email,
        "password": password
    })
    if res.status_code != 200:
        log(f"Login failed: {res.text}")
        sys.exit(1)
    
    # Update token from login just in case
    token = res.json()['access_token']
    headers = {'Authorization': f'Bearer {token}', 'Accept': 'application/json'}
    log("Login successful.")

    # 3. Get Categories
    log("Fetching Categories")
    res = requests.get(f"{BASE_URL}/categories", headers={'Accept': 'application/json'}) # Public
    if res.status_code != 200:
        log(f"Get Categories failed: {res.text}")
        sys.exit(1)
    log(f"Categories found: {len(res.json()['data'])}")

    # 4. Get Products
    log("Fetching Products")
    res = requests.get(f"{BASE_URL}/products", headers={'Accept': 'application/json'})
    if res.status_code != 200:
        log(f"Get Products failed: {res.text}")
        sys.exit(1)
    
    products = res.json()['data']
    if len(products) == 0:
        log("No products found to test cart with. Warning.")
    else:
        product_id = products[0]['id']
        log(f"Using Product ID: {product_id}")

        # 5. Add to Cart
        log("Adding to Cart")
        res = requests.post(f"{BASE_URL}/cart", headers=headers, json={
            "product_id": product_id,
            "quantity": 1
        })
        if res.status_code != 200:
            log(f"Add to Cart failed: {res.text}")
            sys.exit(1)
        log("Added to cart.")

        # 6. View Cart
        log("Viewing Cart")
        res = requests.get(f"{BASE_URL}/cart", headers=headers)
        if res.status_code != 200:
            log(f"View Cart failed: {res.text}")
            sys.exit(1)
        
        cart_data = res.json()['data']
        # Check if item is in cart
        if not cart_data['items'] or cart_data['items'][0]['product_id'] != product_id:
            log("Cart verification failed: Product not in cart")
            sys.exit(1)
        log("Cart verified.")

        # 7. Place Order
        log("Placing Order")
        res = requests.post(f"{BASE_URL}/orders", headers=headers)
        if res.status_code != 201:
            log(f"Place Order failed: {res.text}")
            sys.exit(1)
        log("Order placed.")

        # 8. List Orders
        log("Listing Orders")
        res = requests.get(f"{BASE_URL}/orders", headers=headers)
        if res.status_code != 200:
            log(f"List Orders failed: {res.text}")
            sys.exit(1)
        
        orders = res.json()['data']
        if len(orders) == 0:
            log("Order list verification failed: No orders found")
            sys.exit(1)
        log("Orders listed successfully.")

    log("ALL TESTS PASSED")

if __name__ == "__main__":
    test_workflow()
