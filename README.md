<img src="webroot/img/cc_logo.png" alt="Crunchy Cravings Logo" width="600" />

# E-Commerce Platform

website: https://prod.u25s1068.iedev.org/

---

## Table of Contents

- [Project Overview](#project-overview)
- [Code Repository](#code-repository)
- [High-level System Architecture](#system-architecture)
- [Features](#features)
- [Credentials](#testing-credentials)
- [System Requirements](#system-requirements)
- [APIs and External Plugins](#apis-and-external-plugins)
- [Deployment Instruction](#deployment-instruction)
- [Maintenance and Updates](#maintenance-and-updates)

---

## Project Overview

Crunchy Cravings is a full-featured e-commerce platform developed using CakePHP 5.x framework. The application allows customers to browse products, place orders, track deliveries, contact administrators and more. The admin panel provides comprehensive management tools for products, categories, orders, FAQs, and site content.

---

## Code Repository

For detailed instructions on cloning the repository, commit message conventions, and branch naming, see the [Code Repository Guidelines](docs/Code_Repository_Guidelines.md).

---

## System Architecture

For detailed design and justification of ERD and system diagram, see the [High-level System Architecture](docs/High-level_System_Architecture.md).

---

## Features

### Customer-Facing Features

**User Management**
  - User registration and authentication
  - Secure login and logout
  - Order history

**Shopping Experience**
  - Product browsing with filters and sorting
  - Detailed product pages with specifications and images

**Purchase Processing**
  - Shopping cart functionality
  - Order placement and payment processing
  - Multiple payment method support

**Customer Support**
  - Order tracking with map visualization and lookup via tracking number
  - Contact form for inquiries
  - FAQ section

### Administrative Features

**Dashboard**
  - Sales analytics
  - User activity monitoring
  - System status overview

**Content Management**
  - Enquiry/content management including the ability to reply
  - Product and category management
  - FAQ management
  - Users management
  - Content block management for dynamic website content

**Business Operations**
  - Order processing and tracking
  - User account management
  - Product Inventory management
  - Enquiry/contact management

---

## Testing Credentials

### Customer Test Accounts
- Email: test@example.com | Password: Fit3047@
- Email: customer@gmail.com | Password: Fit3047@

### Administrator Accounts
- Email: asd@gmail.com | Password: Fit3047@
- Email: admin@gmail.com | Password: Fit3047@

---

## System Requirements

### Server Requirements
- **PHP**: Version 8.1 or higher
- **Database**: MySQL 5.7+ or MariaDB 10.3+
- **Web Server**: Apache (recommended)
- **Development Environment**: XAMPP (for Windows users)
- **Dependency Manager**: Composer 2.8+

### Required PHP Extensions
- **mbstring**: Provides multibyte string support
- **PDO**: Enables database connectivity
- **pdo_mysql**: MySQL database driver for PDO

### Environment Configuration
The application uses environment-specific configuration files:

- `config/app.php` - Default application settings
- `config/app_local.php` - Environment-specific settings (database credentials, email, etc.)
- `.env` - Environment variables for sensitive data (e.g., API keys)

---

## APIs and External Plugins
The application integrates with the following external services and plugins to enhance functionality:

- **Leaflet.js**: Enables map visualization for order tracking.
- **Stripe**: Manages secure payment processing with support for multiple payment methods.
- **Bootstrap 5**: Provides responsive and modern UI components for a better user experience.
- **jQuery**: Simplifies DOM manipulation and supports AJAX requests for dynamic content updates.
- **CakeDC/Auth (10.1+)**: Implements advanced authentication features for CakePHP.
- **CakePHP/Authentication (3.2+)**: Ensures secure user authentication.
- **Crabstudio/Recaptcha (4.1+)**: Integrates Google Recaptcha for spam protection in forms.
- **Josegonzalez/CakePHP-Upload (8.0+)**: Simplifies file uploads with customizable configurations.
- **Ugie-Cake/Content-Blocks (1.3+)**: Enables dynamic content management for flexible website updates.

### External Resources and Documentation

- **Recaptcha**:
  - [Google Recaptcha API](https://cloud.google.com/security/products/recaptcha)
  - [CakePHP Integration GitHub Repository](https://github.com/cakephp-fr/recaptcha)

- **ContentBlocks**:
  - [Plugin Documentation](https://github.com/ugie-cake/cakephp-content-blocks#readme)

- **CakePHP Authentication**:
  - [Official Documentation](https://book.cakephp.org/authentication/2/en/index.html)
  - [UGIE Customized Authentication GitHub Repository](https://git.infotech.monash.edu/UGIE/ugie-demo/cake_cms-auth/-/blob/main/docs/README.Authentication.md)

- **CakePHP Authorization**:
  - [Official Documentation](https://book.cakephp.org/authorization/2/en/index.html)

- **Josegonzalez/Upload**:
  - [File Upload Plugin GitHub Repository](https://github.com/FriendsOfCake/cakephp-upload?tab=readme-ov-file)

- **Stripe**:
  - [Stripe API Documentation](https://stripe.com/docs/api)
  - [CakePHP Integration GitHub Repository](https://github.com/stripe/stripe-php)

---

## Deployment Instruction
For detailed instructions on deploying the application, see the [Deployment Instructions](docs/Deployment_Instruction.md).

---

## Maintenance and Updates

### Updating the Application
```bash
# Pull latest changes
git pull origin main

# Update dependencies
composer install

# Install and seed content blocks plugin
composer require ugie-cake/cakephp-content-blocks
bin/cake migrations migrate --plugin=ContentBlocks
bin/cake migrations seed --seed ContentBlocksSeed
```

This application was developed by UGIE Team068 using the CakePHP framework.
