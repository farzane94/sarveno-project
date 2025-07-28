# 🗂 Shopping List Project using PHP Native

A simple shopping list application built using **PHP (without any frameworks)**, **MySQL**, and **Vanilla JavaScript**.

---

## 🚀 Technologies Used

- PHP (No framework)
- MySQL
- JavaScript (Vanilla)
- HTML5 / CSS3
- Basic MVC Pattern
- RESTful API
- Git (for version control)

---

## ⚙️ Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/farzane94/sarveno-project.git
cd sarveno-project
```

### 2. Run the PHP Server

```bash
php -S localhost:8000 -t public
```
### Then open this URL in your browser:

🌐 http://localhost:8000/index.html


### 3. Create the Database
````
CREATE DATABASE shopping_list;
USE shopping_list;

CREATE TABLE items (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
is_checked BOOLEAN DEFAULT FALSE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

````


## ✨ Features

-Add new items
-Edit existing items
-Delete items
-Mark items as completed
-RESTful API integration
-Simple and responsive UI

## 📬 Contact

Built with 👩‍💻💻🖱️ by Farzaneh Rahmani
