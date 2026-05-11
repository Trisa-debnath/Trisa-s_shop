# Trisa's Shop - Laravel Multi-Vendor E-Commerce Project

This is a Laravel based multi-vendor e-commerce web application. The project includes public product browsing, customer ordering, cart management, online/offline payment options, product review moderation, seller store/product management, and an admin dashboard for managing the full system.

## Portfolio Links

| Type | Link |
| --- | --- |
| GitHub Profile | `https://github.com/Trisa-debnath` |
| Project Repository | `https://github.com/Trisa-debnath/Trisa-s_shop` |
| Video Demo | `Video demo link will be added here` |
| LinkedIn | `https://www.linkedin.com/in/trisa-debnath-147249361` |
| Email | `trisha123nath321@gmail.com` |

## Project Overview

This project can be used to run an online marketplace where:

- Customers can browse products, search products, view product details, add items to cart, place orders, and submit reviews.
- Sellers/vendors can create stores, add products, manage their own products, and view order history.
- Admin can manage categories, subcategories, products, orders, discounts, product attributes, homepage settings, and reviews.

## My Contribution

This project was designed and developed by me as a Laravel multi-vendor e-commerce application. I implemented the main modules, database structure, role based access, admin panel, seller panel, customer panel, cart, order, payment, review, and product management features.

Main work completed by me:

- Built role based authentication for admin, vendor/seller, and customer.
- Created admin dashboard with product, order, user, revenue, and payment statistics.
- Built product, category, subcategory, store, discount, attribute, order, and review management.
- Developed seller store and product management workflow.
- Added customer panel routes for profile, order history, payment, and affiliate pages.
- Implemented session based cart and checkout flow.
- Added Stripe card payment, Cash on Delivery, bKash, and Nagad payment options.
- Added multiple product image upload and Laravel storage support.
- Added order PDF download using DomPDF.
- Used Livewire for product search, cart interaction, category/subcategory selection, and homepage components.

## Why This Project Is Useful

This project shows practical Laravel development skills through a real e-commerce workflow. It includes authentication, authorization, CRUD operations, file upload, database relationships, payment integration, dashboard statistics, PDF generation, and user role management.

Interviewers can review this project to understand my ability to build a complete web application with Laravel, Blade, Livewire, Tailwind CSS, MySQL, and third-party package integration.

## Main Features

### Public Website

- Home page with latest products, slider products, and discounted products.
- Product category page.
- Product details page.
- Live product search using Livewire.
- Add to cart using session based cart.
- Checkout/order proceed page.
- Order success and order cancel pages.
- Product review submission.

### Customer Panel

- Customer dashboard/profile page route.
- Customer order history page route.
- Customer payment page route.
- Customer affiliate page route.
- Profile update, password update, and account delete options through Laravel Breeze profile features.

### Seller/Vendor Panel

- Vendor dashboard.
- Store create, manage, edit, update, and delete.
- Product create and manage.
- Multiple product image upload.
- Seller order history page with search.
- Seller order search.

### Admin Panel

- Admin dashboard with product, order, user, revenue, pending, completed, cancelled, paid order, recent order, and recent product statistics.
- Category create, manage, edit, update, and delete.
- Subcategory create, manage, edit, update, and delete.
- Product create, manage, edit, update, and delete.
- Product image upload and delete.
- Product SKU and slug generation.
- Product stock, visibility, status, tax, SEO title, and SEO description management.
- Product discount create, manage, edit, update, and remove.
- Default product attribute create, manage, edit, update, and delete.
- Store and user management placeholder pages.
- Order history, order edit, order update, order delete, and order search.
- Order PDF download using DomPDF.
- Product review approve/reject system.
- Homepage setting update.

### Payment Features

- Cash on Delivery.
- bKash payment information collection.
- Nagad payment information collection.
- Stripe card payment integration.
- Payment status and transaction ID storing.

### Role Based Access

The project uses role based routing:

| Role | Value | Access |
| --- | ---: | --- |
| Admin | `0` | Admin dashboard and management modules |
| Vendor/Seller | `1` | Seller dashboard, store, product, and order history page |
| Customer | `2` | Customer dashboard/profile, order history, payment, and affiliate routes |

## Demo Login Setup

For a portfolio demo, the project includes seeded users for admin, vendor/seller, and customer login.

| Role | Email | Password |
| --- | --- | --- |
| Admin | `admin@gmail.com` | `password` |
| Vendor/Seller | `eti@gmail.com` | `password` |
| Customer | `trisha@gmail.com` | `password` |

Required role values:

- Admin: `0`
- Vendor/Seller: `1`
- Customer: `2`

Run the database seeder to create these accounts:

```bash
php artisan db:seed
```

These accounts should be tested before recording the demo video or sharing the live project link.

## Technology Stack

- Laravel 12
- PHP 8.2+
- Laravel Breeze authentication
- Livewire 3
- MySQL or any Laravel supported database
- Stripe PHP SDK
- DomPDF for order PDF generation
- Tailwind CSS
- Alpine.js
- Vite

## Important Packages

Composer packages:

- `laravel/framework`
- `laravel/breeze`
- `livewire/livewire`
- `stripe/stripe-php`
- `barryvdh/laravel-dompdf`

NPM packages:

- `vite`
- `tailwindcss`
- `alpinejs`
- `axios`
- `concurrently`
- `laravel-vite-plugin`

## Project Structure

```text
app/
  Http/Controllers/
    Admin/
    Customer/
    Seller/
  Livewire/
  Models/
database/
  migrations/
public/
  admin_asset/
  home_asset/
resources/
  views/
    admin/
    auth/
    customer/
    home/
    livewire/
    seller/
routes/
  web.php
  auth.php
```

## Main Routes

### Public Routes

- `/` - Home page
- `/category/{category_name}` - Category wise product page
- `/viewdetails/{id}` - Product details
- `/order/proceed` - Checkout/order proceed
- `/order/store` - Store order
- `/order/success` - Order success
- `/order/cancel` - Order cancel

### Admin Routes

- `/admin/dashboard`
- `/admin/category/create`
- `/admin/category/manage`
- `/admin/subcategory/create`
- `/admin/subcategory/manage`
- `/admin/product/create`
- `/admin/product/manage`
- `/admin/product/review/manage`
- `/admin/discount/create`
- `/admin/discount/manage`
- `/admin/order/history`
- `/admin/manage/users`
- `/admin/manage/stores`
- `/admin/seeting`

### Vendor Routes

- `/vendor/dashboard`
- `/vendor/store/create`
- `/vendor/store/manage`
- `/vendor/product/create`
- `/vendor/product/manage`
- `/vendor/orderhistory`

### Customer Routes

- `/user/dashboard`
- `/user/order/history`
- `/user/setting/payment`
- `/user/affiliate`

## Installation Guide

### 1. Clone The Project

```bash
git clone https://github.com/Trisa-debnath/Trisa-s_shop.git
cd Trisa-s_shop
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Create Environment File

```bash
cp .env.example .env
```

If `.env.example` is not available, create `.env` manually and add the required database, app, mail, and payment credentials.

### 5. Generate App Key

```bash
php artisan key:generate
```

### 6. Configure Database

Update these values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=trisa-shop
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Configure Payment Values

Add payment information in `.env`:

```env
STRIPE_KEY=stripe_public_key_here
STRIPE_SECRET=stripe_secret_key_here
BKASH_PAYMENT_NUMBER=01XXXXXXXXX
NAGAD_PAYMENT_NUMBER=01XXXXXXXXX
```

### 8. Run Migration

```bash
php artisan migrate
```

### 9. Seed Demo Users

```bash
php artisan db:seed
```

### 10. Create Storage Link

```bash
php artisan storage:link
```

### 11. Start Development Server

Run Laravel and Vite separately:

```bash
php artisan serve
npm run dev
```

Or run the combined development command:

```bash
composer run dev
```

Then open:

```text
http://127.0.0.1:8000
```

## Test Command

```bash
php artisan test
```

## Video Demo Guide

The project video link can be added in the `Portfolio Links` section after recording.

Recommended upload options:

- YouTube unlisted video.
- Google Drive video with public view permission.
- LinkedIn project post.

Recommended video length:

- Best: 3 to 5 minutes.
- Maximum: 7 minutes.
- Keep the demo focused on the real features already implemented in this project.

### What To Show In The Video

1. Start with the project name: Trisa's Shop.
2. Show the home page, product slider, discounted products, category products, and product details page.
3. Show product search and add-to-cart flow.
4. Show checkout and payment options: Cash on Delivery, bKash, Nagad, and Stripe card payment.
5. Login as vendor and show vendor dashboard, store management, product create/manage, and order history page.
6. Login as admin and show dashboard, category/subcategory, product, discount, order, review, homepage setting, and PDF download features.
7. Briefly show the code structure: routes, controllers, models, migrations, Livewire components, and Blade views.
8. End by explaining what you learned and what can be improved next.

### Demo Video Script

```text
Assalamu Alaikum, this is my Laravel multi-vendor e-commerce project named Trisa's Shop.

In this project, I built role based panels for admin, vendor, and customer.
Customers can browse products, search products, view product details, add products to cart, and place orders.

The checkout system supports Cash on Delivery, bKash, Nagad, and Stripe card payment.
After placing an order, the order information is stored with payment status and transaction ID.

For vendors, I built store management and product upload features.
Vendors can create stores, add products, upload product images, and view the order history page.

For admin, I built a dashboard with product, order, user, revenue, pending order, completed order, and paid order statistics.
Admin can manage categories, subcategories, products, discounts, product attributes, orders, homepage settings, and product reviews.
Admin can approve or reject customer reviews and download order details as PDF.

Technically, I used Laravel 12, Laravel Breeze, Livewire, Blade, Tailwind CSS, MySQL, Stripe SDK, and DomPDF.
This project helped me practice real-world Laravel features like authentication, role based authorization, CRUD, file upload, database relationships, session cart, payment integration, and PDF generation.

Thank you for watching my project demo.
```

### Tips For A Professional Video

- Record in 1080p if possible.
- Use a clear microphone or quiet room.
- Keep browser zoom around 90% or 100%.
- Prepare sample products, categories, users, and orders before recording.
- Do not show private `.env` values, API secrets, database passwords, or Stripe secret key.
- Keep the video smooth: login accounts should already be ready.
- Speak slowly and explain what problem each feature solves.

## How To Add Screenshots In README

1. Create a folder named `docs/screenshots` in the project root.
2. Put project screenshots inside that folder.
3. Use simple file names without spaces, for example:
   - `home-page.png`
   - `product-details.png`
   - `cart-page.png`
   - `checkout-page.png`
   - `admin-dashboard.png`
   - `seller-dashboard.png`
   - `customer-dashboard.png`
4. Add the screenshot in README like this:

```md
![Home Page](docs/screenshots/user-home.png)
```

If the image does not show on GitHub, check that the file name and path are exactly the same.

## Project Screenshots

Project screenshots are stored in `docs/screenshots/`.

### Home Page

![Home Page](docs/screenshots/user-home.png)

### Home Slider

![Home Slider](docs/screenshots/user-slide.png)

### Discount Products

![Discount Products](docs/screenshots/user-discount.png)

### Category Products

![Category Products](docs/screenshots/user-allcategory.png)

### Product Details

![Product Details](docs/screenshots/user-details.png)

### Add To Cart

![Add To Cart](docs/screenshots/user-addto%20cart.png)

### Cart / Checkout

![Cart Check](docs/screenshots/cart%20check.png)
![Order Checkout](docs/screenshots/order-checkout1.png)
![Checkout Page](docs/screenshots/checkout.png)

### Payment Options

![bKash Payment](docs/screenshots/bkash-payment.png)
![Nagad Payment](docs/screenshots/nogod-payment.png)
![Card Payment](docs/screenshots/pay%20with%20chard.png)

### Admin Dashboard

![Admin Dashboard](docs/screenshots/admin-dashboard.png)

### Admin Category Manage

![Admin Category Manage](docs/screenshots/admin-category-manage.png)

### Admin Product Create

![Admin Product Create](docs/screenshots/admin-product-create.png)

### Admin Product Manage

![Admin Product Manage](docs/screenshots/admin-pro-manage.png)

### Admin Discount Manage

![Admin Discount Manage](docs/screenshots/admin-discount-manage.png)

### Admin Review Manage

![Admin Review Manage](docs/screenshots/mange-product-review.png)

### Admin Homepage Setting

![Admin Homepage Setting](docs/screenshots/admin-seeting.png)

### Seller Dashboard

![Seller Dashboard](docs/screenshots/seller-dashboard.png)

## Suggested Screenshots To Take

- Home page
- Home slider section
- Discount product section
- Category product page
- Product details page
- Cart/add to cart message
- Checkout page
- bKash, Nagad, and card payment sections
- Order success page
- Login page
- Register page
- Admin dashboard
- Admin category manage page
- Admin product manage page
- Admin discount manage page
- Admin order history page
- Admin review manage page
- Admin homepage setting page
- Seller dashboard
- Seller store manage page
- Seller product manage page
- Customer panel pages

## Interview Preparation Notes

Be ready to explain these parts in an interview:

- How role based access works using the `rolemanager` middleware.
- How admin, vendor, and customer routes are separated.
- How product image upload works with Laravel storage.
- How cart data is stored in session.
- How checkout creates orders and order items.
- How Stripe payment is handled.
- How bKash/Nagad transaction information is stored.
- How reviews are submitted and approved/rejected by admin.
- How dashboard statistics are calculated.
- How database relationships work between users, stores, products, orders, order items, categories, subcategories, images, and reviews.

## Professional Checklist Before Sharing

- GitHub profile link added.
- Project repository link added.
- LinkedIn profile link added.
- Email address added.
- Video demo link will be added after recording.
- Project screenshots should be added in `docs/screenshots`.
- Demo accounts should be created and tested before sharing.
- Private API keys and passwords must stay inside `.env` only.
- `.env` is already listed in `.gitignore`.
- Migration should run successfully on a fresh database.
- Tests should be checked with `php artisan test` when needed.
- README formatting should be reviewed before final submission.

## Useful Notes

- Product images are stored in Laravel public storage, so `php artisan storage:link` is required.
- Admin, vendor, and customer access depends on the `role` value in the `users` table.
- Stripe payment requires valid `STRIPE_KEY` and `STRIPE_SECRET` values.
- bKash and Nagad payment numbers are read from `.env`.
- Product reviews are submitted first, then admin can approve or reject them.

## Future Improvement Ideas

- Add payment verification for bKash/Nagad.
- Add product wishlist.

## Author

Developed by:

```text
Trisa Debnath
Laravel / PHP Developer
GitHub: https://github.com/Trisa-debnath
LinkedIn: https://www.linkedin.com/in/trisa-debnath-147249361
Email: trisha123nath321@gmail.com
```
