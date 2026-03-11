# Product Dashboard – Laravel Project

## Overview

This project is a web application built with **Laravel** that allows users to browse, filter, edit, and manage products organized by categories.

The application demonstrates typical CRUD functionality together with filtering, pagination, and a structured dashboard interface.

The goal of the project is to showcase good Laravel practices such as:

* MVC architecture
* Blade templating
* Eloquent relationships
* Factories and seeders
* Form validation
* Reusable partial views

---

## Features

### Category overview

When opening the dashboard, the user is presented with a visual overview of all product categories.

Each category displays:

* An icon
* The category name
* Number of products in the category

Selecting a category opens the product view for that category.

---

### Product listing

Inside a category, users can see a list of products containing:

* Product name
* Description
* Color
* Category
* Price
* Stock amount

Products are paginated for better performance and usability.

---

### Filtering

Products can be filtered using the filter form:

* Search by product name
* Color
* Filter by category
* Minimum price
* Maximum price
* Stock availability
* Sorting (name, price, stock)

Filtering uses **GET parameters**, allowing filtered views to be bookmarked or shared.

---

### Product management

Users can manage products through:

* **Edit** – update product details
* **Delete** – remove a product from the database

Laravel validation ensures that all submitted data is valid.

---

## Technologies Used

* **Laravel**
* **PHP**
* **Blade templates**
* **Eloquent ORM**
* **HTML / CSS**
* **Factories and Seeders**
* **Pagination**

---

## Database Structure

The application uses two main models:

### Categories

Stores product categories.

Fields:

* `id`
* `name`
* timestamps

Relationship:

* A category **has many products**

---

### Products

Stores product information.

Fields:

* `id`
* `name`
* `description`
* `color`
* `price`
* `stock`
* `category_id`
* timestamps

Relationship:

* A product **belongs to a category**

---

## Factories and Seeders

The project includes database seeders that populate the application with realistic demo data.

This ensures the application looks the same when run locally as it does for reviewers or clients.

Seeded data includes:

* Several predefined categories
* Multiple products with realistic names, descriptions, prices, and stock values

---

## Installation

Clone the repository:

```bash
git clone https://github.com/saadondaniella/Nailed-It
cd project-folder
```

Install dependencies:

```bash
composer install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

## Database Setup

Run migrations and seed the database:

```bash
php artisan migrate:fresh --seed
```

This will:

* create all tables
* populate the database with demo data

---

## Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

Open the application in your browser:

```
http://localhost:8000
```

---

## Project Structure

Important directories:

```
app/
    Models/
    Http/Controllers/

resources/views/
    layouts/
    dashboard/
    partials/

database/
    factories/
    seeders/
```

* **Controllers** handle business logic
* **Models** manage database relationships
* **Views** are rendered using Blade templates

---

## Security Considerations

The application includes several security practices:

* Blade escaping (`{{ }}`) prevents XSS attacks
* Form validation ensures correct input
* CSRF protection is enabled for all forms
* Method spoofing is used for DELETE requests

---

## Future Improvements

Possible improvements for the project:

* Product image uploads
* API endpoints
* Product search optimization

---

## Authors

Project created as part of a Laravel development assignment.
