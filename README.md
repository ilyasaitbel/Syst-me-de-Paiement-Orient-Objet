# 💳 Application Console PHP – Système de Paiement (POO)

## 🧾 Description
Ce projet est une **application console (CLI)** développée en **PHP ≥ 8.1**,
basée sur la **programmation orientée objet**,
permettant de gérer des **clients**,
des **commandes** et des **paiements polymorphes**,
avec une **persistance des données via MySQL et PDO**.

Le projet respecte les **bonnes pratiques professionnelles**,
les normes **PSR-4 / PSR-12**,
et met l’accent sur une **architecture claire,
maintenable et extensible**.

---

## 🎯 Objectifs du projet
- Modéliser correctement le domaine métier du paiement
- Appliquer les concepts avancés de la POO
- Séparer les responsabilités (Entity / Repository / Service)
- Traiter les paiements de manière polymorphe
- Garantir la cohérence et la sécurité des données
- Utiliser PDO avec des requêtes préparées

---

## 🧱 Architecture du projet

---

## 🧠 Concepts POO utilisés
- Classes et objets
- Encapsulation (private / protected)
- Getters et setters avec validation
- Héritage
- Polymorphisme
- Classes abstraites
- Interfaces
- Type hinting
- Exceptions personnalisées

---

## 🔗 Relations métier
- Un **Client** peut passer plusieurs **Commandes**
- Une **Commande** est associée à un seul **Client**
- Une **Commande** contient obligatoirement un **Paiement**
- Les moyens de paiement (**CarteBancaire, Paypal, Virement**) héritent de **Paiement**

---

## 💳 Paiement polymorphe
Le traitement des paiements est effectué sans connaître le type concret du paiement, ce qui permet :
- l’ajout de nouveaux moyens de paiement
- sans modifier le code existant
- en respectant le principe **Open / Closed**

---

## 🗄️ Base de données
- SGBD : MySQL / MariaDB
- Accès aux données via **PDO uniquement**
- Utilisation de **requêtes préparées** pour la sécurité

Les scripts SQL de création des tables sont inclus dans le dépôt.

---

## 📐 UML
Le projet contient :
- Un **diagramme de cas d’utilisation**
- Un **diagramme de classes UML**

Les diagrammes sont cohérents avec l’implémentation du code.

---