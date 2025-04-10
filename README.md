# Cake-Bakery-System
BCA Final Year Project

🎂  Cake Bakery System
An online cake ordering system built with PHP and MySQL, perfect for bakeries to showcase their cakes, manage orders, and let customers shop online.

📁 Features :

- 🧁 View available cakes with images, descriptions, and prices  
- 🛒 Add to cart and checkout system  
- 🔐 User registration/login  
- 🧾 Order management  
- 🛠️ Admin dashboard to manage items and categories  

---

## 🚀 How to Run

### 1. Requirements
- PHP >= 7.x
- MySQL/MariaDB
- Apache server (XAMPP/LAMP/WAMP recommended)


### 2. Setup
1. Place the project folder into your `htdocs` (or equivalent) directory.
2. Import the database:
   - Open phpMyAdmin
   - Create a new database (e.g. `bakerydb`)
   - Import the included `.sql` file (usually in `/database` or `/admin` folder)


3. Update database credentials in:

    - includes/dbconnection.php


4. Run the app by accessing:

   - http://localhost/cakebakerysystem


---

## 🔐 Admin Panel

Accessible at:

 - http://localhost/cakebakerysystem/admin/


 📂 Folder Structure :

 cakebakerysystem/
├── admin/                # Admin dashboard
├── includes/             # DB connection
├── css/, js/, images/    # Frontend assets
├── *.php                 # Core functionality files
└── database.sql          # MySQL DB file


 
    

