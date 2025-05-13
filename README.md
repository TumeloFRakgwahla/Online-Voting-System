# 🗳️ Online Voting System

An online voting platform built to allow voters to log in and securely cast their votes in different elections. Ideal for educational or small-scale use.

---

## 📚 Table of Contents

- [Project Structure](#-project-structure)
- [Features](#️-features)
- [Technologies Used](#-technologies-used)
- [Setup Instructions](#️-setup-instructions)
- [Default Credentials](#-default-credentials)
- [Screenshots](#-screenshots-optional)
- [Future Improvements](#-future-improvements)
- [Author](#-author)

---

## 📁 Project Structure

```
/Online Voting System/
├── admin/              # Admin dashboard and management
├── includes/           # Database and common PHP includes
├── voters/             # Voter dashboard and voting form
├── css/                # Stylesheets
├── js/                 # JavaScript files
├── index.php           # Landing page
├── login.php           # Login functionality
└── README.md           # This file
```

## ⚙️ Features

- Voter registration and login
- Admin panel to manage elections and candidates
- Cast and store votes securely
- Check if a voter has already voted
- Show voting results
- Responsive design (basic)

## 🚀 Technologies Used

- PHP
- MySQL
- HTML, CSS, JavaScript
- Bootstrap (if applicable)

## 🛠️ Setup Instructions

1. Clone or extract this repository.
2. Import the SQL file into your MySQL database (`votingsystem.sql`).
3. Update your database connection in `/includes/db.php`:
   ```php
   $conn = new mysqli("localhost", "root", "", "votingsystem");
   ```
4. Run the app by opening `index.php` in your browser using a local server like XAMPP or WAMP.

## 🔐 Default Credentials

- **Admin Login**
  - Username: `admin`
  - Password: `admin123`
- **Sample Voter Login**
  - Voter ID: `V123456`
  - Password: `voterpass`

> ⚠️ Change credentials and secure your application before using it in production!

## 📸 Screenshots (Optional)

Include screenshots of:
- Voter login
 ![Alt text](Images/Login%20page.png)
- Voter Registration
![Alt text](Images/Regestertion%20page%20.png)
- Voting form
![Alt text](Images/Voting%20Form.png)
- Admin login
![Alt text](images/Admin%20Login%20page.png)
- Admin dashboard
![Alt text](images/Admin%20Home%20page.png)
- Results page
![Alt text](images/Result%20page.png)

## ✅ Future Improvements

- Two-factor authentication
- Email notifications
- Audit logs
- Mobile-friendly UI

## 🧑‍💻 Author

**Your Name** – [https://github.com/TumeloFRakgwahla]
