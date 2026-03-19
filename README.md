<p align="center">
  <img src="logo.png" alt="KinGames Logo" width="120"/>
</p>

<h1 align="center">KinGames</h1>

<p align="center">
  <b>Browser-based mini-games platform with multiplayer support, leaderboards and user profiles.</b>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"/>
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"/>
  <img src="https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap"/>
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript"/>
  <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" alt="jQuery"/>
</p>

---

## Summary

- [Description](#description)
- [Features](#features)
- [Available Games](#available-games)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Installation](#installation)
- [Configuration](#configuration)
- [Team](#team)
- [License](#license)

---

## Description

KinGames is a web platform collecting several mini-games playable directly
in the browser. Users can register, play, earn points and climb global,
national or per-game leaderboards. The project includes a multiplayer
system with waiting rooms and multilanguage support (Italian / English).

---

## Features

| Feature | Description |
|---|---|
| Authentication | Multi-step registration and login with PHP session management |
| User Profile | Selectable avatar, nickname, country, game statistics |
| Profile Editing | Change nickname, email, password and avatar |
| Leaderboards | Global, national, local (country filter) and per-game |
| Multilanguage | Italian and English with dynamic switch |
| Multiplayer | Room creation and search, waiting lobby with polling |
| Scores | Automatic score saving at end of match |
| Public Profiles | View other players' details and top scores |
| Responsive | Adaptive interface via Bootstrap |

---

## Available Games

| Game | Type | Description |
|---|---|---|
| Snake | Single-player | Classic snake game |
| Tetris | Single-player | Falling block puzzle |
| Candy | Single-player | Match-3 puzzle game |
| TrisTris | Multiplayer | Online Tic-Tac-Toe |
| Cacciatore | Single-player | Aim and reflex game |
| TurnBattle | Single-player | Turn-based RPG with shop and team management |
| Arcade | Single-player | Arcade mini-game |

---

## Tech Stack

- **Backend:** PHP 7/8 (vanilla, no framework)
- **Database:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3, JavaScript (ES6+)
- **CSS Framework:** Bootstrap 3 / 5
- **JS Libraries:** jQuery 3.x, Select2
- **Server:** Apache (XAMPP / WAMP / LAMP)

---

## Project Structure
```
Kingame/
├── index.php                 # Homepage
├── login.php                 # Login page
├── registrazione.php         # Multi-step registration
├── giochi.php                # Game catalog
├── classifica.php            # Leaderboards with filters
├── chisiamo.php              # About page
├── impostazione.php          # User profile
├── modifica.php              # Profile editing
├── dettagliUtente.php        # Public user profile
├── menu.php                  # Shared navbar
├── footer.php                # Shared footer
├── config.php                # Host configuration
├── db_connect.php            # Database connection
├── logRequest.php            # Login handler
├── regRiquest.php            # Registration handler
├── modRequest.php            # Profile edit handler
├── logout.php                # Logout
├── getUteneData.php          # User data API (JSON)
├── datiUtente.php            # Session data loader
├── privacy.php               # Privacy policy
├── termini.php               # Terms of service
│
├── css/                      # Stylesheets
│   ├── index.css
│   ├── navbar.css
│   ├── classifica.css
│   └── footer.css
│
├── lang/                     # Translation files
│   ├── it.php                # Italian
│   └── en.php                # English
│
├── db/
│   └── kingame.sql           # Database dump
│
├── giochi/                   # Mini-games
│   ├── snake/
│   ├── tetris/
│   ├── candy/
│   ├── TrisTris/
│   ├── cacciatore/
│   ├── pm/
│   └── Gioco_Bettini/
│
├── MultiplayerSystem/        # Multiplayer system
│   ├── CreaStanza.php        # Room creation
│   ├── AggiungiStanza.php    # Join existing room
│   ├── StanzaAttesa.php      # Waiting lobby
│   ├── CercaStanze.php       # Room search
│   ├── CercaGiocatori.php    # Player search in room
│   ├── AggiornaDB.php        # Room database update
│   └── removeSession.php     # Player session removal
│
├── img/                      # Site images
└── data/
    └── States.json           # Country data
```

---

## Installation

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (or WAMP / MAMP / LAMP)
- PHP >= 7.4
- MySQL / MariaDB

### Steps

1. **Clone the repository**
```bash
   git clone https://github.com/Elm4lek/Kingame.git
```

2. **Move to the server folder**
```bash
   # XAMPP (Windows)
   mv Kingame C:/xampp/htdocs/kingame

   # LAMP (Linux)
   mv Kingame /var/www/html/kingame
```

3. **Import the database**
   - Open [phpMyAdmin](http://localhost/phpmyadmin)
   - Create a new database named `kingame`
   - Import `db/kingame.sql`

4. **Configure the connection**
   - Set your host in `config.php`
   - Set your database credentials in `db_connect.php`

5. **Start the server**
   - Start Apache and MySQL from XAMPP
   - Go to [http://localhost/kingame](http://localhost/kingame)

---

## Configuration

### `config.php`
```php

```

Configure database credentials directly in `db_connect.php`. For
production environments, use secure credentials and environment variables.

---
