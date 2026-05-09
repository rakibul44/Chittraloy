# Chittraloy - Photography & Gallery Management System

Chittraloy is a premium, full-stack web application designed for photographers and creative studios to showcase their work, manage service packages, and handle client inquiries. It features a dynamic, luxury-aesthetic frontend and a robust administrative dashboard for comprehensive content management.

## 🚀 Key Features

-   **Dynamic Gallery**: Organize and display photography work with categories, custom ordering, and lightbox viewing.
-   **Service Packages**: Manage service offerings with pricing, features, and "featured" highlighting for premium tiers.
-   **Client Interaction**: 
    -   Integrated booking inquiry forms with detailed wedding/event information.
    -   General contact forms for broader communication.
    -   Status tracking (Pending/Replied) within the admin panel.
-   **Content Management System (CMS)**:
    -   **Hero Manager**: Customize homepage slides with background image uploads.
    -   **Project Showcase**: Manage featured stories and projects.
    -   **Testimonial Manager**: Display and manage client feedback and ratings.
    -   **Global Settings**: Centralized control for site metadata, social links, contact info, and video sections.
-   **Image Optimization**: Automated processing using Intervention Image (resizing and WebP conversion) to ensure high performance without sacrificing visual quality.
-   **Secure Admin Panel**: Role-based access (via Laravel Auth) to a specialized dashboard for site operations.

## 🛠️ Technology Stack

### Backend (Laravel Ecosystem)
-   **Framework**: [Laravel 12.x](https://laravel.com/)
-   **Language**: PHP 8.2+
-   **Authentication**: Built-in Laravel Auth with Session-based protection.
-   **API**: RESTful API endpoints for administrative tasks and form submissions.
-   **Image Processing**: [Intervention Image 3.x](https://image.intervention.io/) with GD driver for automated resizing and WebP optimization.

### Frontend
-   **Framework**: [Bootstrap 5.3](https://getbootstrap.com/) for layout, responsive components (Modals, Carousels), and icons.
-   **Styling**: [Tailwind CSS 4.0](https://tailwindcss.com/) for modern utility-based styling and custom design tokens.
-   **Build Tool**: [Vite 7.x](https://vitejs.dev/) for optimized asset bundling and fast HMR.
-   **Templating**: Blade (Laravel's native engine).
-   **Icons**: [Bootstrap Icons](https://icons.getbootstrap.com/) and [Font Awesome 6](https://fontawesome.com/).
-   **Interactions**: Vanilla JS and [Axios](https://axios-http.com/) for seamless, asynchronous data handling.

### Database
-   **Primary Database**: SQLite (Default) or MySQL/PostgreSQL.
-   **Schema Design**: 12+ migrations providing a structured data layer for:
    -   `users`: Administrative credentials.
    -   `heroes`: Homepage slider content.
    -   `projects`: Featured work details.
    -   `galleries`: Categorized portfolio images.
    -   `packages`: Pricing and service feature lists.
    -   `testimonials`: Client reviews and star ratings.
    -   `inquiries`: Detailed client booking requests.
    -   `contacts`: General contact form messages.
    -   `settings`: Key-value configuration for site-wide variables.

## 📂 Project Structure

-   `app/Models/`: Eloquent models representing the database entities.
-   `app/Http/Controllers/`: Backend logic, featuring `AdminApiController` for centralized dashboard operations.
-   `resources/views/`: 
    -   `layouts/`: Base templates (`main.blade.php` for public, `admin.blade.php` for admin).
    -   `admin/`: Dashboard-specific views.
    -   `auth/`: Login and registration templates.
-   `routes/`: 
    -   `web.php`: Frontend routing and authentication.
    -   `api.php`: Admin and public form API endpoints.
-   `public/storage/`: Managed storage for uploaded assets.

## ⚙️ Installation & Setup

1.  **Clone the repository**:
    ```bash
    git clone <repository-url>
    ```

2.  **Install dependencies**:
    ```bash
    composer install
    npm install
    ```

3.  **Environment Setup**:
    -   Copy `.env.example` to `.env`.
    -   Generate application key: `php artisan key:generate`.
    -   Initialize SQLite database: `touch database/database.sqlite`.

4.  **Database Migration**:
    ```bash
    php artisan migrate
    ```

5.  **Run Development Environment**:
    ```bash
    # Run both Laravel serve and Vite in parallel
    npm run dev
    ```

---

*Premium Photography Solution for Modern Studios.*
