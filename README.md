# Exchange Rate Calculator

The Exchange Rate Calculator is a simple fully authenticated and secured web application designed to facilitate currency exchange calculations.

## User Tasks

Calculate Exchange

User Registration and Editing

## Admin Tasks

Searching Users

Sorting Users

Manage Users

Edit Any User

Assign Roles

Delete Users

Vue-JS Powered User Addition Without Loading

## Getting Started

To run the application locally, follow these steps:

Install the required dependencies:

    ```bash
    composer install
    ```

    ```bash
    php artisan migrate
    ```

    ```bash
    php artisan db:seed --class=AdminSeeder
    ```

    ```bash
    php artisan db:seed --class=UserSeeder
    ```

add this items in .env:

    EXCHANGE_RATE_API_KEY={{ Api key }}
    EXCHANGERATESAPI_BASE_URL=https://api.exchangeratesapi.io/v1/

run this command

    ```bash
    php artisan serve
    ```

### Author

**[Sakib](https://github.com/saakiiib/)**
