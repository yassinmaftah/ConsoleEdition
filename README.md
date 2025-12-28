# 💻 PHP Console Blog Application (OOP Edition)

Un système de gestion de contenu (CMS) simple basé sur la console (CLI), développé en **PHP pur** pour démontrer les principes de la **Programmation Orientée Objet (POO)**.

Ce projet gère l'authentification, les rôles utilisateurs (RBAC), le cycle de vie des articles (Draft/Publish) et les commentaires.

---

## 🚀 Fonctionnalités Principales

* **Authentification Système :** Login sécurisé pour différents types d'utilisateurs.
* **Gestion des Rôles (RBAC) :**
    * **Admin :** Gestion des utilisateurs (Ajout/Suppression) et vue d'ensemble.
    * **Editor :** Validation des articles (Passage de "Draft" à "Publish").
    * **Author :** Création d'articles (Statut initial "Draft") et consultation de ses propres articles.
    * **Visiteur :** Consultation des articles publiés et ajout de commentaires.
* **Système de Commentaires :** Les utilisateurs (et visiteurs) peuvent commenter les articles publiés avec leur nom.
* **Affichage Dynamique :** Liste des articles, détails, et timeline interactive gérée par une méthode statique.

---

## 🛠️ Architecture Technique (POO)

Le projet respecte une architecture stricte orientée objet :

### 1. Héritage & Polymorphisme
* **User (Parent Class) :** Contient les propriétés de base (id, username, email) et la logique d'affichage.
* **Moderateur extends User :** Classe intermédiaire pour les rôles de gestion.
* **Admin extends Moderateur :** Possède les droits de gestion utilisateurs (`CreateUser`, `deleteUser`).
* **Editor extends Moderateur :** Possède les droits de validation (`ArticleStatus`).
* **Author extends User :** Possède les droits de création de contenu (`addArticle`).

### 2. Relations
* **User -> Article :** Un auteur possède plusieurs articles.
* **Article -> Comment :** Un article contient une liste d'objets `Comment`.

### 3. Concepts Avancés
* **Encapsulation :** Utilisation de propriétés `protected` et de `Getters` pour sécuriser les données.

---

## ⚙️ Installation & Exécution

1.  **Prérequis :** Avoir PHP installé sur votre machine (CLI).
2.  **Cloner/Télécharger** les fichiers dans un dossier.
3.  **Lancer l'application :**
    Ouvrez votre terminal à la racine du dossier et exécutez :

```bash
php App.php

### Identifiants de Test (Données Initiales)

Rôle,       Email,              Mot de passe,   Permissions
Admin,      admin1@test.com,    1111,           Ajouter/Supprimer Users
Editor,     editor1@test.com,   4444,           Valider les Articles
Author,     author1@test.com,   7777,           Créer des Articles
Visiteur,   (Pas de login),      -  ,           Voir Articles & Commenter