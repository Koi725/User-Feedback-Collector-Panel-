# Dark Feedback Panel (PHP Beginner Project)

A minimal, dark-themed user feedback portal built with pure PHP and JSON file storage.  
Includes role-based access for **admin** and **normal users**, with secure login, registration, and feedback management.

---

## 🌟 Features

- 🌓 Dark UI with Orbitron futuristic font
- 🔐 Login & Register system (using JSON, no database)
- 👤 Role-based access:
  - Admin can view **all** feedbacks
  - Users can **submit** & **view their own** feedbacks
- 💬 Feedback system with title, message & timestamp
- 🔁 Sessions and logout functionality
- 📁 JSON file-based data storage (`users.json`, `feedbacks.json`)

---

## 📂 File Structure

project/
│
├── index.php # Entry point
├── login.php # Login form + logic
├── register.php # Registration form + validation
├── dashboard.php # Role-based dashboard
├── submit_feedback.php # Feedback form (for users)
├── view_feedbacks.php # View own feedbacks (user)
├── view_all_feedbacks.php # Admin-only: view all feedbacks
├── logout.php # Destroy session and redirect
│
├── users.json # Stores user data
├── feedbacks.json # Stores feedbacks
└── README.md # You are here ✅

---

## ✅ How to Use

1. Clone or download the repo.
2. Run with a local server (e.g., XAMPP, MAMP, or built-in PHP server).
3. Register a new user.
4. Or manually add an admin in `users.json`:
   ```json
   {
     "users": [
       {
         "username": "admin",
         "password": "admin123!",
         "role": "admin"
       }
     ]
   }
   ```

Free to use for learning and non-commercial purposes.
Made with ❤️ by Kousha
