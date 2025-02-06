
# Track Rental

This is a track car rental project. Reserve your cars for your track day.

# Features for users

### User Registration and Authentication
- **Sign Up**: Create a new account using your email.
- **Login**: Access your account with your credentials.

### User Profile
- **View Profile**: See your profile details, including your username, email, and password.
- **Edit Profile**: Update any profile information and delete your account.

### Website updates
- **Review any website message**: Check the daily message by the admin on site or car information, if any set.

### Filtering
- **Filter cars**: Specify what type of car you are looking for by model, seats, drivetrain, and transmission.

### Car Browsing and reserving
- **Explore Cars**: Browse a vast collection of cars.
- **View Content Details**: Check any car's specs.

# Features for admin

### Admin Dashboard
- **Reservations**: Check out reservations made by users and modify them.
- **Car management**: CRUD any car.
- **User management**: Manage any user if needed.
- **Daily message**: Set a message to any user visiting the website in the session.

# How to install

## Prerequisites
- Make sure you have node.js installed
- Make sure you have npm installed
- Make sure you have composer installed

## Installation
- Navigate to the root folder of the project in your console or terminal
- Run `composer install` to install composer dependencies
- Run `npm install` to install npm dependencies
- Create you own or simply copy the example `.env` file
- Make sure to create a database with the same name as set in `DB_DATABASE` in the `.env` file
- Once you have `.env` ready run `php artisan key:generate`
- Run `php artisan migrate` to set up the db
- Run `php artisan db:seed` to seed the db
- Run `npm run dev` (preferably in a new console or terminal)
- Run `php artisan serve` and go to `localhost:8000` (or the port you were assigned with when running the artisan serve command)

## Default credentials
- `admin@admin.com`:`adminadmin` - admin
- `rainbow@six.com`:`rainbow6` - user

You can now log in as the admin and access the dashboard, as well as entering as a regular user.
As a guest user you may explore, filter, and see any cars' details.
As a regular user you may explore, filter, detail and reserve cars.
As an admin you may explore the dashboard and its features aforementioned in 'Features for admin' section.
