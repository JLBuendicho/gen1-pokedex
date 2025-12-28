# Gen1 Pokedex
A web based pokedex of gen1 pokemons with trainer trading functionality

## Prerequisites
Before running this project, make sure you have the following installed:

- **PHP 8.3 or higher**:
    1. Download PHP from https://windows.php.net/download/
    2. Extract to a location (e.g., C:\php)
    3. Copy php.ini-development to php.ini
    4. Edit php.ini to enable required extensions:
        - Uncomment (remove ;) from:
            ```ini
            extension=fileinfo
            extension=pdo_mysql
            extension=openssl
			extension=zip
            ```
    5. Add PHP to your system's PATH environment variable
    6. Verify installation:
        ```sh
        php -v
        ```

- **Composer** (PHP dependency manager): https://getcomposer.org/
- **Node.js and NPM** (JavaScript runtime and package manager): https://nodejs.org/
	- Note: We recommend checking the "Automatically install all the necessary tools." option in the Node.js installation
- **Laravel** (PHP framework):
    ```sh
    composer global require laravel/installer
    ```
- **MySQL** (or another supported database): https://dev.mysql.com/downloads/ (ensure you have a running database and credentials)


## Initial Setup
Do these steps only once when setting up the project for the first time:
1. Clone the repository
2. Install dependencies:
	```sh
	composer install
	npm install
	```
3. Set up your environment variables:
	- Copy the example environment file and update database credentials and other settings as needed:
	  ```sh
	  cp .env.example .env
	  # or on Windows
	  copy .env.example .env
	  ```
	- Generate the application key:
	  ```sh
	  php artisan key:generate
	  ```
	- Edit the `.env` file to set your database connection details (DB_DATABASE, DB_USERNAME, DB_PASSWORD, etc.)

4. Run database migrations (required):
   ```sh
   php artisan migrate
   ```

## Running the App
Use these commands every time you want to start the web application:
```sh
composer run dev
```
Then visit `http://localhost:8000/pokemons` in your browser.

## License
For educational and demonstration purposes only.
