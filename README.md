# 📸 Instagram Spam Detection System

## 🧠 Project Overview

The **Instagram Spam Detection System** is a web-based application that simulates an Instagram-style user interface and scans uploaded images for **spam content**. It uses **Tesseract-OCR** to extract text from images and identifies spam based on a predefined list of keywords and suspicious links. The project is developed using **HTML**, **CSS**, **JavaScript**, **PHP**, and **MySQL**, and is run locally via **XAMPP**.

---

## 🚀 Features

- ✅ User-friendly Instagram-like interface
- 🖼️ Image upload and text extraction using **Tesseract-OCR**
- 🔍 Real-time spam detection using keyword matching
- ⚠️ Alert notification if spam content is found
- 🗃️ Backend integration with **PHP and MySQL**
- 📁 Organized file structure without subfolders for ease of deployment

---

## 🧰 Technologies Used

| Technology     | Purpose                          |
|----------------|----------------------------------|
| HTML/CSS       | Frontend structure and styling   |
| JavaScript     | UI interaction & alert handling  |
| PHP            | Backend logic and OCR integration |
| MySQL (XAMPP)  | User data and spam analysis logs |
| Tesseract-OCR  | Text extraction from images      |

---


📌 **Important:**
- Tesseract-OCR must be installed and accessible via the system path.
- No subfolders are used; all files remain in a single directory for XAMPP compatibility.

---

## 🛠️ Setup Instructions

### 1. Install Dependencies
- [XAMPP](https://www.apachefriends.org/)
- [Tesseract-OCR](https://github.com/tesseract-ocr/tesseract)

### 2. Database Setup
1. Launch **phpMyAdmin**
2. Create a new database:
   ```sql
   CREATE DATABASE instagram_spam_detection;
3. (Optional) Add tables for user authentication or spam logs

### 3. Project Deployment
1. Place all project files in:
- C:\xampp\htdocs\Instagram-Clone
2. Start Apache and MySQL from the XAMPP control panel.
3. Open your browser and go to:
- http://localhost/Instagram-Clone/index.html

---

## 🧪 How It Works
### 1. User logs in via index.html.
### 2. On home.html, they upload an image.
### 3. When SPAM is clicked:

- predict.php is triggered.
- Tesseract extracts text from the image.
- Extracted text is compared with keywords in spam_data.csv.
- Result is displayed as an alert message at the top of the page.

### Example alert:

⚠️ This content is Instagram spam detection

---

## 📈 Future Enhancements
1. Spam score rating (High/Medium/Low)
2. Admin dashboard for managing spam keyword list
3. User login system with roles (Admin/User)
4. OCR accuracy improvements with image preprocessing
5. Visual spam indicators instead of just alerts

---

## 👨‍💻 Author
### Ezhil Bharghavi K

St. Peter's College of Engineering and Technology

GitHub: https://github.com/EBharghavi

