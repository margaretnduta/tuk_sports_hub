# 🏅 TUK Sports Hub

**A Laravel-based sports management platform** for the Technical University of Kenya (TUK).  
It allows **coaches**, **players**, and **fans** to collaborate and interact through sports events, galleries, and updates — all in one hub.

---

## 📘 Project Overview

### 🎯 Purpose
TUK Sports Hub simplifies how TUK manages and promotes its sports activities.  
It brings together **coaches**, **players**, and **fans** under a unified platform for event creation, participation, and engagement.

### 💡 Core Idea
> “Play. Coach. Cheer.”  
A digital sports ecosystem where coaches manage events, players confirm participation, and fans see available events they can attend to.

---

## 🧱 Tech Stack

| Layer | Technology |
|-------|-------------|
| **Backend** | Laravel 11 (PHP 8+) |
| **Frontend** | Blade + Tailwind CSS |
| **Database** | MySQL |
| **Auth** | Laravel Breeze |
| **Storage** | Local / `public/storage` (linked via `php artisan storage:link`) |
| **Icons/UI** | Heroicons, Lucide React (via CDN optional) |

---

## ⚙️ Features by Role

### 👑 Admin
- Approves or removes coaches.
- Manages site content (blogs, reviews, success stories).
- Oversees system statistics and user reports.

### 🧑‍🏫 Coach
- Creates, edits, postpones, or deletes sports events.
- Uploads **cover images** and **event updates** (text or photos).
- Views player availability and fan RSVPs in real time.
- Edits their **coach profile** (sport type and bio).

### ⚽ Player
- Views upcoming events by sport.
- Confirms or declines participation.
- Updates personal profile and achievements.

### 🎉 Fan
- Sees available events.


---

## 🖥️ Screens & Pages

| Page | Description |
|------|-------------|
| `/` | Landing page (Join or Login) |
| `/register` | Register as Player or Fan |
| `/dashboard` | Redirects to role-based dashboards |
| `/coach/events` | Coach event management (cards view) |
| `/coach/events/create` | Create a new event with image upload |
| `/coach/profile` | Edit sport and bio |
| `/coach/events/{event}` | Full event details, roster, postpone option |

---

## 🧩 Installation

### 1️⃣ Clone Repository
```bash
git clone https://github.com/your-username/tuk-sports-hub.git
cd tuk-sports-hub
