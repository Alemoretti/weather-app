# Weather App

This Weather App allows users to check the weather around the world. Users can add locations, view weather forecasts, and manage their favorite locations.
Jetstream was used in Laravel’s installation since it already provides login and registration features.
I kept the registration form created by Jetstream although it wasn’t needed. I can remove if necessary.

## Features

- Add and manage locations
- View weather forecasts for added locations
- User authentication and authorization
- Responsive design

## Installation

Follow these steps to set up and run the Weather App on your local machine.

Install PHP Dependencies
```composer install```

Install Node.js Dependencies
```npm install```

Set Up Environment Variables
Copy the .env.example file to .env and update the environment variables as needed.
Don't forget to insert your Opentheweather API Key in the .env file
```cp .env.example .env```

Generate Application Key
```php artisan key:generate```

Set Up Database
Update the .env file with your database credentials and then run the following commands to create the database tables and seed the database.
```php artisan migrate```
```php artisan db:seed```

Run the Development Server
Start the PHP development server and the Vite development server.
```php artisan serve```
```npm run dev```

Access the Application
Open your browser and navigate to http://localhost:8000 to access the Weather App.

### Prerequisites

- PHP 8.x
- Composer
- Node.js and npm
- SQL, MySQL or any other supported database. The project was created using SQLite, but you can change the database configuration in the .env file to use another supported database.