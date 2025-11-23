# 🎥 CineMundo – TV Series Web App (SAÉ R3.01)

A modern and ergonomic web application built with **PHP (CodeIgniter 3 – MVC)** to browse, search and review TV series.

For this project, we decided to **rebuild the entire front-end from scratch** (HTML/CSS/JS) instead of reusing the provided views, as a challenge and to improve our UI/UX and web architecture skills.

---

## 📖 Table of Contents

* [Introduction](#introduction)
* [Main Features](#main-features)
* [Technical Stack](#technical-stack)
* [Project Structure](#project-structure)
* [MVC Overview](#mvc-overview)
* [Installation & Setup](#installation--setup)
* [Usage](#usage)
* [Authors](#authors)
* [Acknowledgements](#acknowledgements)

---

<a id="introduction"></a>
## 🪶 Introduction

**CineMundo** is a TV series browser and review application developed as part of the **SAÉ R3.01** project (Web Development, semester 3).

The application is built on top of a series database (series, seasons, episodes, reviews) originally provided by the teachers. Our goals were to:

* Offer a **clean, modern and responsive interface** for browsing series
* Implement an **MVC architecture** using **CodeIgniter 3**
* Allow authenticated users to **rate and review series**

The result is a web app that looks and feels like a small streaming platform: series cards, posters, filters, search bar, and a user area for managing reviews.

---

<a id="main-features"></a>
## 🚀 Main Features

### 🔍 Public features

* **Series listing**

  * Grid layout with poster, title and number of seasons
  * Search bar and filters (e.g. by genre)

* **Series details page**

  * Full information about the selected TV show
  * List of seasons with number of episodes

* **Season details page**

  * Episodes list with basic information
  * Direct navigation back to the series

* **Legal notices page**

  * Accessible footer link to legal information

Navigation between all these views is simple and consistent.

---

### 👤 User features (authenticated area)

After creating an account and logging in, a user can:

* Create an account and log in/log out
* Access an **“Account”** page
* Leave a **rating and review** for a TV show (or a specific season)
* See and manage their own reviews (edit / update)

---

### 🎨 Design & UX

We chose to completely redesign the interface:

* **Custom front-end**, coded from scratch (no bootstrap template)
* Responsive layout for desktop and laptop
* Clean cards for series with posters
* Consistent header and footer across all pages
* Minimal, readable forms for login / registration
* Icons for navigation, account, search, filters, etc.

---

<a id="technical-stack"></a>
## 🛠️ Technical Stack

* **PHP 7+** with **CodeIgniter 3** (MVC framework)
* **MySQL / MariaDB** (series database)
* **HTML5 / CSS3 / JavaScript**
* Custom assets (CSS/JS/images)
* Deployed behind Apache (IUT server / local environment)

---

<a id="project-structure"></a>

## 🗂️ Project Structure

Only the most relevant directories for the web app are shown here.

```plaintext
CineMundo/
│   index.php                # Front controller (CodeIgniter entry point)
│   composer.json
│   Diagramme.png            # UML / schema (documentation)
│   README.md
│
├── application/             # CodeIgniter application (MVC)
│   ├── controllers/
│   │   ├── Home.php         # Home page, series listing, filters
│   │   ├── Details.php      # Series & season details
│   │   ├── Account.php      # User account, profile & reviews
│   │   ├── Notices.php      # Legal notices
│   │   └── index.html
│   │
│   ├── models/
│   │   ├── TVShowData.php   # Data access for series, seasons, episodes
│   │   ├── RatingData.php   # Data access for ratings & reviews
│   │   ├── UserData.php     # Data access for users
│   │   │
│   │   ├── elements/
│   │   │   ├── Rating.php
│   │   │   ├── tvshow/
│   │   │   │   ├── TVShow.php
│   │   │   │   ├── Season.php
│   │   │   │   ├── Episode.php
│   │   │   │   ├── Genre.php
│   │   │   │   └── Poster.php
│   │   │   └── user/
│   │   │       └── User.php
│   │   │
│   │   └── errors/
│   │       └── CustomError.php
│   │
│   └── views/
│       ├── header.php
│       ├── footer.php
│       ├── home.php
│       ├── tvshow_details.php
│       ├── season_details.php
│       ├── account.php
│       ├── login.php
│       ├── register.php
│       ├── legal_notices.php
│       └── back_button.php
│
├── assets/
│   ├── css/
│   ├── js/
│   ├── icones/
│   └── img/
│
└── system/
```

---

<a id="mvc-overview"></a>

## 🧱 MVC Overview

* **Controllers** (`Home`, `Details`, `Account`, `Notices`)
* **Models** (`TVShowData`, `RatingData`, `UserData` + element classes)
* **Views** (`home.php`, `tvshow_details.php`, `season_details.php`, etc.)

---

<a id="installation--setup"></a>

## ⚙️ Website Link :

> [CineMundo](https://dwarves.iut-fbleau.fr/~demircio/SAE202_2025/)

---

<a id="usage"></a>

## 🎮 Usage

* Access the home page to see the **list of series**
* Filter or search by **genre** or **title**
* Click on a series to see **details and seasons**
* Click on a season to view **episodes**
* Create an account to **log in** and start leaving **ratings and reviews**

---

<a id="authors"></a>

## 👨‍💻 Authors

| Name                                                                                  | Role                                  |
| --------------------------                                                            | ------------------------------------- |
| **Canpolat DEMIRCI–ÖZMEN**                                                            | Front-end design, UI/UX & Model Logic |
| **Nathan BAUDRIER [Git](https://github.com/NathanBaudrier)**                          | Controllers & Database integration    |
| **Lakshman MURALITHARAN [Git](https://grond.iut-fbleau.fr/muralith/)**                | Model integration & User management   |

---

<a id="acknowledgements"></a>

## 💬 Acknowledgements

Thanks to:

* **Jérôme Cutrona** for the original series database
* **Denis Monnerat** and the Web module teaching team for the assignment and guidance
* **IUT de Fontainebleau (UPEC)** for hosting and infrastructure

This project helped us strengthen our skills in:

* PHP MVC with **CodeIgniter 3**
* Database-driven web applications (with PHPmyAdmin)
* Front-end architecture and responsive design
* Team collaboration and version control (Git)

---

## 🥇 Grade

> Grade : 🥇 17.00 / 20