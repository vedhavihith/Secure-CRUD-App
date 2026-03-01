# Secure CRUD Application – Task 4

## 📌 Project Overview
This project is a security-enhanced PHP & MySQL CRUD application developed as part of Task 4.

The application implements secure coding practices to prevent common web vulnerabilities.

---

## 🔐 Security Enhancements Implemented

### 1️⃣ Prepared Statements
All database queries use MySQLi prepared statements to prevent SQL Injection attacks.

### 2️⃣ Password Hashing
Passwords are securely stored using:
- `password_hash()`
- `password_verify()`

No plain-text passwords are stored.

### 3️⃣ Server-Side Validation
All form inputs are validated using PHP before processing.

### 4️⃣ Client-Side Validation
HTML `required` attributes are used for improved user experience.

### 5️⃣ Role-Based Access Control
Two user roles:
- **Admin**
- **User**

Admin can:
- Add posts
- Edit posts
- Delete posts

User:
- Cannot modify posts
- Receives "Access Denied"

---

## 🗄 Database Structure

### users table
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- username (VARCHAR)
- password (VARCHAR)
- role (VARCHAR)

### posts table
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- title (VARCHAR)
- content (TEXT)

---

## 🛠 Technologies Used
- PHP
- MySQL
- XAMPP
- phpMyAdmin
- Git & GitHub

---

## 🚀 Outcome
The application is secured against:
- SQL Injection
- Unauthorized access
- Weak password storage

This completes Task 4 – Security Enhancements.
