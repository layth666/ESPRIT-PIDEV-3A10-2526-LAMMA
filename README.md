# LAMMA __ PI_DEV 3A10 ESPRIT SCOOL OF ENGINEERING

![PHP](https://img.shields.io/badge/PHP-8.x-purple)
![Symfony](https://img.shields.io/badge/Symfony-Framework-black)
![Twig](https://img.shields.io/badge/Twig-UI-green)
![Doctrine](https://img.shields.io/badge/Doctrine-ORM-red)
![MySQL](https://img.shields.io/badge/MySQL-Database-blue)
![Status](https://img.shields.io/badge/Project-Academic-green)

---

## Overview

This project was developed as part of the **PIDEV – 3rd Year Engineering Program at Esprit School of Engineering (Academic Year 2025–2026)**.

**PI_DEV** is a modular web application that allows users to manage events and interact with several services related to those events.  
The platform integrates multiple modules such as user management, event organization, sponsorship, blog interactions, transport services, and subscription management.

The application was built using **Symfony Framework for the web interface** and **MySQL for data persistence**, following an **MVC architecture**.

---

## Features

### User Management

- User registration and authentication  
- Profile management  
- User role management (admin / user)  

### Event Management

- Create events  
- Modify events  
- Delete events  
- Display event list  
- Manage event programs and schedules  

### Sponsoring

- Manage sponsors  
- Associate sponsors with events  
- Track sponsorship activities  

### Blog / Interactions

- Publish blog posts  
- Comment and interact with content  
- Share experiences related to events  

### Transport and Equipment

- Organize carpooling for event participants  
- Equipment store for buying or renting equipment  

### Subscription and Restoration

- Manage user subscriptions  
- Restaurant and food services related to events  

---

## Tech Stack

### Frontend

- Twig  
- HTML  
- CSS  
- Bootstrap  

### Backend

- PHP 8+  
- Symfony Framework  
- Doctrine ORM  
- MySQL  

---

## Architecture

The application follows an **MVC architecture**:

### Presentation Layer

Handles the user interface and interactions.

- Twig templates  
- HTML / CSS  
- Frontend rendering  

### Business Logic Layer

Contains the core application logic.

- Controllers  
- Services  
- Validation  

### Data Layer

Responsible for managing the data model and persistence.

- Entities  
- Repositories  
- Database access (MySQL)  

---

## Project Structure

```
PI_DEV
│
├── src
│   ├── Controller
│   │    ├── UserController.php
│   │    ├── EventController.php
│   │    ├── SponsoringController.php
│   │    ├── BlogController.php
│   │    ├── TransportController.php
│   │    └── SubscriptionController.php
│   │
│   ├── Entity
│   │
│   ├── Repository
│   │
│   ├── Service
│   │
│   └── Utils
│
├── templates
├── public
├── config
├── migrations
├── .env
├── composer.json
└── README.md
```

---

## Contributors

| Contributor         | Module                       |
|--------------------|----------------------------|
| **Saif**            | User Management            |
| **Feryel Lamouchi** | Event Management           |
| **Mouheb**          | Sponsoring                 |
| **Layth**           | Blog / Interactions        |
| **Weal**            | Transport and Equipment    |
| **Aycha**           | Subscription and Restoration |

---

## Academic Context

Developed at **Esprit School of Engineering – Tunisia**  
PIDEV – 3rd Year Engineering Program | 2025–2026  

This project was developed as part of a **collaborative academic project**, applying software engineering practices such as:

- modular design  
- MVC architecture  
- Git version control  
- teamwork and agile development  

---

## Getting Started

### 1️⃣ Clone the repository

```bash
git clone https://github.com/layth666/LAMMA
```

### 2️⃣ Open the project

Open the project using **VS Code / PhpStorm / IntelliJ**.

### 3️⃣ Install dependencies

```bash
composer install
```

### 4️⃣ Configure the database

Update `.env` file:

```env
DATABASE_URL="mysql://username:password@127.0.0.1:3306/pi_dev"
```

### 5️⃣ Create database

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 6️⃣ Run the application

```bash
symfony server:start
```

---

## Acknowledgments

This project was developed as part of the **PIDEV academic project** at **Esprit School of Engineering**.  
It aims to apply software engineering concepts in a real-world collaborative development environment.
