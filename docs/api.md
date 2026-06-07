# Inventory System API v1

Dokumentasi API untuk sistem inventaris barang. Seluruh endpoint menggunakan prefix `/api/v1` dan mengembalikan response dalam format JSON yang konsisten menggunakan response wrapper.

## 📌 Base URL
`http://localhost:8000/api/v1`

---

## 🔐 Autentikasi

### 1. Register User
* **Method:** `POST`
* **URL:** `/register`
* **Headers:**
  ```http
  Accept: application/json
  Content-Type: application/json
  ```
* **Request Body:**
  ```json
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }
  ```
* **Response Sukses (201 Created):**
  ```json
  {
    "success": true,
    "data": {
      "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "updated_at": "2026-06-07T17:50:00.000000Z",
        "created_at": "2026-06-07T17:50:00.000000Z"
      },
      "token": "1|abcdef123456..."
    },
    "message": "User registered"
  }
  ```

### 2. Login User
* **Method:** `POST`
* **URL:** `/login`
* **Headers:**
  ```http
  Accept: application/json
  Content-Type: application/json
  ```
* **Request Body:**
  ```json
  {
    "email": "john@example.com",
    "password": "password123"
  }
  ```
* **Response Sukses (200 OK):**
  ```json
  {
    "success": true,
    "data": {
      "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "updated_at": "2026-06-07T17:50:00.000000Z",
        "created_at": "2026-06-07T17:50:00.000000Z"
      },
      "token": "2|abcdef123456..."
    },
    "message": "User logged in"
  }
  ```

---

## 🏷️ Kategori Barang

### 1. Menarik Semua Kategori
* **Method:** `GET`
* **URL:** `/categories`
* **Headers:**
  ```http
  Accept: application/json
  Authorization: Bearer {token}
  ```
* **Response Sukses (200 OK):**
  ```json
  {
    "success": true,
    "data": [
      {
        "id": 1,
        "name": "Elektronik",
        "created_at": "2026-06-07T17:50:00.000000Z",
        "updated_at": "2026-06-07T17:50:00.000000Z"
      }
    ],
    "message": "Berhasil menarik semua data Kategori"
  }
  ```

### 2. Menambahkan Kategori Baru
* **Method:** `POST`
* **URL:** `/categories`
* **Headers:**
  ```http
  Accept: application/json
  Content-Type: application/json
  Authorization: Bearer {token}
  ```
* **Request Body:**
  ```json
  {
    "name": "Pakaian"
  }
  ```
* **Response Sukses (201 Created):**
  ```json
  {
    "success": true,
    "data": {
      "id": 2,
      "name": "Pakaian",
      "updated_at": "2026-06-07T17:52:00.000000Z",
      "created_at": "2026-06-07T17:52:00.000000Z"
    },
    "message": "Kategori berhasil dibuat"
  }
  ```

### 3. Detail Satu Kategori
* **Method:** `GET`
* **URL:** `/categories/{id}`
* **Headers:**
  ```http
  Accept: application/json
  Authorization: Bearer {token}
  ```
* **Response Sukses (200 OK):**
  ```json
  {
    "success": true,
    "data": {
      "id": 1,
      "name": "Elektronik",
      "created_at": "2026-06-07T17:50:00.000000Z",
      "updated_at": "2026-06-07T17:50:00.000000Z"
    },
    "message": "Berhasil menarik satu data kategori"
  }
  ```

### 4. Memperbarui Kategori
* **Method:** `PUT` / `PATCH`
* **URL:** `/categories/{id}`
* **Headers:**
  ```http
  Accept: application/json
  Content-Type: application/json
  Authorization: Bearer {token}
  ```
* **Request Body:**
  ```json
  {
    "name": "Elektronik Rumah Tangga"
  }
  ```
* **Response Sukses (200 OK):**
  ```json
  {
    "success": true,
    "data": {
      "id": 1,
      "name": "Elektronik Rumah Tangga",
      "created_at": "2026-06-07T17:50:00.000000Z",
      "updated_at": "2026-06-07T17:55:00.000000Z"
    },
    "message": "Kategori berhasil diperbarui"
  }
  ```

### 5. Menghapus Kategori (Khusus Admin)
* **Method:** `DELETE`
* **URL:** `/categories/{id}`
* **Headers:**
  ```http
  Accept: application/json
  Authorization: Bearer {token}
  ```
* **Response Sukses (200 OK):**
  ```json
  {
    "success": true,
    "data": null,
    "message": "Kategori berhasil dihapus"
  }
  ```

---

## 📦 Item Barang

### 1. Menarik Semua Item
* **Method:** `GET`
* **URL:** `/items`
* **Headers:**
  ```http
  Accept: application/json
  Authorization: Bearer {token}
  ```
* **Response Sukses (200 OK):**
  ```json
  {
    "success": true,
    "data": [
      {
        "id": 1,
        "name": "Laptop Gaming",
        "quantity": 10,
        "price": "15000000.00",
        "category_id": 1,
        "created_at": "2026-06-07T17:50:00.000000Z",
        "updated_at": "2026-06-07T17:50:00.000000Z"
      }
    ],
    "message": "Berhasil menarik semua data Item"
  }
  ```

### 2. Menambahkan Item Baru (Dengan Sanitasi HTML)
* **Method:** `POST`
* **URL:** `/items`
* **Headers:**
  ```http
  Accept: application/json
  Content-Type: application/json
  Authorization: Bearer {token}
  ```
* **Request Body:** (Mengirimkan input name dengan tag `<script>` untuk pengujian sanitasi)
  ```json
  {
    "name": "<script>Smartphone Ultra</script>",
    "quantity": 15,
    "price": 8000000,
    "category_id": 1
  }
  ```
* **Response Sukses (201 Created):** (Menunjukkan input tag HTML berhasil dibersihkan menjadi text bersih)
  ```json
  {
    "success": true,
    "data": {
      "id": 2,
      "name": "Smartphone Ultra",
      "quantity": 15,
      "price": 8000000,
      "category_id": 1,
      "updated_at": "2026-06-07T17:58:00.000000Z",
      "created_at": "2026-06-07T17:58:00.000000Z"
    },
    "message": "Item berhasil dibuat"
  }
  ```

### 3. Detail Satu Item
* **Method:** `GET`
* **URL:** `/items/{id}`
* **Headers:**
  ```http
  Accept: application/json
  Authorization: Bearer {token}
  ```
* **Response Sukses (200 OK):**
  ```json
  {
    "success": true,
    "data": {
      "id": 1,
      "name": "Laptop Gaming",
      "quantity": 10,
      "price": "15000000.00",
      "category_id": 1,
      "created_at": "2026-06-07T17:50:00.000000Z",
      "updated_at": "2026-06-07T17:50:00.000000Z"
    },
    "message": "Berhasil menarik satu data Item"
  }
  ```
* **Response Error (404 Not Found) - Menggunakan ID yang tidak ada:**
  ```json
  {
    "success": false,
    "data": null,
    "message": "No query results for model [App\\Models\\Item] 999"
  }
  ```

### 4. Memperbarui Item
* **Method:** `PUT` / `PATCH`
* **URL:** `/items/{id}`
* **Headers:**
  ```http
  Accept: application/json
  Content-Type: application/json
  Authorization: Bearer {token}
  ```
* **Request Body:**
  ```json
  {
    "name": "Laptop Gaming ROG",
    "quantity": 8,
    "price": 14500000
  }
  ```
* **Response Sukses (200 OK):**
  ```json
  {
    "success": true,
    "data": {
      "id": 1,
      "name": "Laptop Gaming ROG",
      "quantity": 8,
      "price": 14500000,
      "category_id": 1,
      "created_at": "2026-06-07T17:50:00.000000Z",
      "updated_at": "2026-06-07T17:59:00.000000Z"
    },
    "message": "Item berhasil diperbarui"
  }
  ```

### 5. Menghapus Item (Khusus Admin)
* **Method:** `DELETE`
* **URL:** `/items/{id}`
* **Headers:**
  ```http
  Accept: application/json
  Authorization: Bearer {token}
  ```
* **Response Sukses (200 OK):**
  ```json
  {
    "success": true,
    "data": null,
    "message": "Item berhasil dihapus"
  }
  ```