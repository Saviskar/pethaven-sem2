# How to Access API Data (Flutter Integration Guide)

This guide provides a step-by-step approach to consuming the PetHaven REST API in your Flutter application.

## 1. Prerequisites

### Base URL
Ensure your Laravel server is running and accessible from your emulator/device.
- **Android Emulator**: `http://10.0.2.2:8000/api`
- **iOS Simulator**: `http://127.0.0.1:8000/api`
- **Physical Device**: `http://<YOUR_PC_IP>:8000/api` (Ensure both devices are on the same Wi-Fi)

### Required Package
Add the `http` package to your `pubspec.yaml`:
```yaml
dependencies:
  http: ^1.2.0
  flutter_secure_storage: ^9.0.0 # Recommended for storing tokens
```

---

## 2. Authentication Flow

The API uses **Bearer Token** authentication (Laravel Sanctum). You must send the token in the `Authorization` header for protected endpoints (like Cart and Orders).

### Headers
Always include these headers in your requests:
```dart
Map<String, String> headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
};
```
*If authenticated:*
```dart
headers['Authorization'] = 'Bearer $yourToken';
```

---

## 3. Flutter Service Implementation (Example)

Create a file named `api_service.dart` to handle all network requests.

```dart
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter_secure_storage.dart';

class ApiService {
  // REPLACE with your actual IP address if testing on physical device
  static const String baseUrl = 'http://10.0.2.2:8000/api';
  
  final storage = const FlutterSecureStorage();

  // --- Helper to get headers ---
  Future<Map<String, String>> _getHeaders() async {
    String? token = await storage.read(key: 'auth_token');
    return {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      if (token != null) 'Authorization': 'Bearer $token',
    };
  }

  // --- Authentication ---
  
  Future<bool> login(String email, String password) async {
    final response = await http.post(
      Uri.parse('$baseUrl/login'),
      headers: {'Accept': 'application/json', 'Content-Type': 'application/json'},
      body: jsonEncode({'email': email, 'password': password}),
    );

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      await storage.write(key: 'auth_token', value: data['access_token']);
      return true;
    }
    return false;
  }

  Future<void> logout() async {
    final headers = await _getHeaders();
    await http.post(Uri.parse('$baseUrl/logout'), headers: headers);
    await storage.delete(key: 'auth_token');
  }

  // --- Public Data (Products) ---

  Future<List<dynamic>> getProducts() async {
    final response = await http.get(
      Uri.parse('$baseUrl/products'),
      headers: {'Accept': 'application/json'}, // Public endpoint, token optional
    );

    if (response.statusCode == 200) {
      final json = jsonDecode(response.body);
      return json['data']; // Returns list of products
    } else {
      throw Exception('Failed to load products');
    }
  }

  // --- Protected Data (Cart) ---

  Future<void> addToCart(int productId, int quantity) async {
    final headers = await _getHeaders();
    final response = await http.post(
      Uri.parse('$baseUrl/cart'),
      headers: headers,
      body: jsonEncode({
        'product_id': productId,
        'quantity': quantity,
      }),
    );

    if (response.statusCode != 200) {
      throw Exception('Failed to add to cart: ${response.body}');
    }
  }
}
```

## 4. Using the Data

### Displaying Products (Example Widget)
```dart
// Inside a FutureBuilder or similar State structure
final apiService = ApiService();

FutureBuilder(
  future: apiService.getProducts(),
  builder: (context, snapshot) {
    if (snapshot.hasData) {
      List products = snapshot.data;
      return ListView.builder(
        itemCount: products.length,
        itemBuilder: (context, index) {
          final product = products[index];
          return ListTile(
            title: Text(product['name']),
            subtitle: Text('\$${product['price']}'),
            leading: Image.network(product['image_url']),
          );
        },
      );
    }
    return CircularProgressIndicator();
  },
)
```

## 5. Troubleshooting Common Issues

1.  **Connection Refused (SocketException)**:
    - You are likely using `localhost` inside the Android emulator. Change the URL to `10.0.2.2` or your machine's LAN IP (e.g., `192.168.1.50`).

2.  **401 Unauthenticated**:
    - The token is missing or expired. Redirect the user to the Login screen.
    - Ensure you are reading the token from storage and adding `Bearer <token>` to the header.

3.  **422 Unprocessable Entity**:
    - Validation failed. Check the `errors` object in the JSON response to see which fields are invalid (e.g., email already taken, password too short).
