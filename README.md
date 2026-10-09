# Blog Institucional — Laravel 13 + Filament + AI

> A hands-on, educational project built for the online course **"Laravel 13, Filament and AI: Build Professional Systems"**. It shows how to go from an empty folder to a production-ready web application with a dynamic blog and a full admin panel, using modern Laravel and AI-assisted development.

**Course on Udemy:** _add your course link here_
**Author:** Ronaldo Aires — [GitHub](https://github.com/ronaldoaires) · [LinkedIn](https://www.linkedin.com/in/ronaldoaires/)

---

## Why this project exists

This repository is the companion code for a video course I created and recorded. It is **not** a commercial product: every commit, file and design decision exists to teach a specific concept in the simplest and most practical way possible.

At the same time, it is a public demonstration of how I build real-world applications:

- **Modern Laravel (v13)** with current conventions: routing, controllers, Blade layouts, Eloquent models, migrations, factories and seeders.
- **Filament** for building admin panels quickly, with proper access control.
- **AI-assisted development** used as a professional tool: generating migrations, models, resources and layouts, then **reviewing, testing and correcting** the output instead of trusting it blindly.
- **Real deployment** on shared hosting, which is the environment many real-world clients actually use.

I build modern, production-grade web systems, from management platforms to institutional sites with custom admin panels, and I teach what I use in production. This project is where those two things meet.

## What you will find here

A simple institutional website with a blog that evolves step by step, following the course modules:

| Module | Focus | What it covers |
|---|---|---|
| **1. Foundations** | Static site | Environment setup, first Laravel app, routes, controllers, 404 page, Blade layout, header/footer, config/ENV, dynamic SEO, favicon, deployment to real shared hosting |
| **2. Dynamic blog** | Database | Database connection, migrations, Eloquent models and relationships, factories and seeders, controllers feeding views, pagination and search, categories and posts |
| **3. Admin panel** | Filament | Filament installation, access control via `canAccessPanel`, Filament Resources, simple (modal) resources, working with AI-generated code |

The same project grows across the modules, so each lesson builds on the previous one.

## Tech stack

- **Backend:** PHP, Laravel 13
- **Admin panel:** Filament
- **Frontend:** Blade, Tailwind CSS
- **Database:** MySQL (InnoDB)
- **Tooling:** Composer, Node.js, Vite, Git
- **Hosting target:** shared hosting (no terminal access required for deployment)

## Key concepts demonstrated

- Clean MVC structure with resource-style controllers and named routes
- Reusable Blade layouts and components
- Database design with migrations and foreign-key relationships
- Eloquent relationships (posts, categories, users, user addresses)
- Realistic test data using factories and seeders
- Pagination, search and query filtering
- Role-based access to an admin panel (`is_admin` / `role` column)
- Filament Resources (full-page and simple modal variants)
- Environment-based configuration and dynamic SEO (title/description per page)
- A critical workflow for AI-generated code: generate, read, test, fix, consult the docs

## Getting started

### Requirements

- A PHP version supported by Laravel 13 (check the [official docs](https://laravel.com/docs))
- Composer
- Node.js and npm
- MySQL

### Installation

```bash
# Clone the repository
git clone https://github.com/ronaldoaires/blog-institucional.git
cd blog-institucional

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate
```

Create an empty MySQL database and set your credentials in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

Then run the migrations and seeders, and start the app:

```bash
php artisan migrate --seed
npm run dev
php artisan serve
```

### Admin panel

Create an admin user and open `/admin`:

```bash
php artisan make:filament-user
```

Access to the panel is restricted to authorized users (see the `canAccessPanel` implementation in the `User` model).

## Project status

This project is developed alongside the course recording.

- [x] Module 1 — Foundations
- [x] Module 2 — Dynamic blog
- [x] Module 3 — Admin panel with Filament
- [ ] Bonus lessons — extra topics added after the core course

## Notes on language

The course and the site content are in **Brazilian Portuguese**, since the target audience is Brazilian developers and clients. All code, comments and documentation are written in **English**.

## About the author

I'm Ronaldo Aires, a developer and civil engineer based in Mato Grosso, Brazil. I build modern Laravel, Filament, Livewire and Tailwind applications, including large and complex systems such as management platforms with quoting, catalogs and custom admin panels, and I enjoy turning what I learn in real projects into clear, practical teaching material.

I'm open to international opportunities, collaborations and remote work. Feel free to reach out.

- GitHub: [github.com/ronaldoaires](https://github.com/ronaldoaires)
- LinkedIn: [linkedin.com/in/ronaldoaires](https://www.linkedin.com/in/ronaldoaires/)
- Email: [ceo@unset.com.br](mailto:ceo@unset.com.br)

## License

This project is released for educational purposes. _Choose a license (for example MIT) and add a `LICENSE` file if you want others to reuse the code._
