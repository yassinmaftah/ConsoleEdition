# 🚀 BlogCMS Console Edition

> A robust, CLI-based Content Management System built with pure PHP and Object-Oriented Programming principles.

## 📝 About The Project
**BlogCMS Console Edition** is a backend project developed as part of the **YouCode** curriculum. The goal is to build a fully functional CMS that operates entirely in the command line, simulating a corporate blogging system for "MediaPress International".

This project focuses on mastering **OOP concepts** (Inheritance, Polymorphism, Encapsulation) without relying on external frameworks.

## 👥 User Roles & Permissions
The system implements a strict permission matrix for 4 types of users:
* **Administrator:** Manages users, roles, and has full access to content.
* **Editor:** Manages all articles, categories, and comments.
* **Author:** Can create and manage *only* their own articles.
* **Visitor:** Read-only access (simulating a frontend consumer).

## 🛠️ Technical Stack
* **Language:** PHP 8+ (Strict Types)
* **Paradigm:** Object-Oriented Programming (OOP)
* **Interface:** Command Line Interface (CLI)
* **Database:** MySQL (via PDO)
* **Tools:** Git, Composer (Autoloading)

## 📂 Project Structure
```text
BlogCMS/
├── src/            # Source code (Classes)
├── config/         # Database configuration
├── bin/            # Executable scripts
├── docs/           # UML Diagrams & Documentation
└── README.md