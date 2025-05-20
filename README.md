<img src="webroot/img/cc_logo.png" alt="Crunchy Cravings Logo" width="600" />

# E-Commerce Platform

## Project Overview

Crunchy Cravings is a full-featured e-commerce platform developed using CakePHP 5.x framework. The application allows customers to browse products, place orders, track deliveries, contact administrators and more. The admin panel provides comprehensive management tools for products, categories, orders, FAQs, and site content.

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
  - Enquiry/content management including the abiltiy to reply
  - Product and category management
  - FAQ management
  - Users management
  - Content block management for dynamic website content

**Business Operations**
  - Order processing and tracking
  - User account management
  - Product Inventory management
  - Enquiry/contact management

## Credentials

### Customer Test Accounts
- Email: test@example.com | Password: Fit3047@
- Email: customer@gmail.com | Password: Fit3047@

### Administrator Accounts
- Email: asd@gmail.com | Password: Fit3047@
- Email: admin@gmail.com | Password: Fit3047@


## System Requirements

### Server Requirements
- PHP 8.1 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Web server: Apache

### PHP Extensions Required
- mbstring (Multibyte string support)
- PDO (Database connectivity)
- pdo_mysql (MySQL database driver)

### Environment Configuration
The application uses environment-specific configuration files:

- `config/app.php` - Default application settings
- `config/app_local.php` - Environment-specific settings (database, email, etc.)

## APIs and External Integrations
The application integrates with the following external services:

- Leaflet.js for map visualization in order tracking
- Payment processing via Stripe
- Boostrap 5 for enhanced visual elements

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

This application was developed by Team068 using the CakePHP framework.