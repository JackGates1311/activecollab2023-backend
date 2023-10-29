## Installation and Setup

1. Clone the repository to your local machine:

    ```bash
    git clone https://github.com/JackGates1311/activecollab2023-backend
    ```

2. Navigate to your project directory:

3. Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

4. Create a copy of the `.env.example` file and name it `.env`:

    ```bash
    cp .env.example .env
    ```

5. Configure the `.env` file:

    - Set the database connection details (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD) to match your MySQL 8 setup.

6. Migrate and seed the database:

    ```bash
    php artisan migrate
    ```

7. Configure the React Frontend:

   The frontend of this application is a separate React project. To set up the React application:

    - Clone the frontend repository to your local machine:

        ```bash
        git clone https://github.com/JackGates1311/activecollabproject2023react.git
        ```

    - Navigate to the frontend project directory:

    - Install Node.js dependencies:

        ```bash
        npm install
        ```

    - Start the React development server:

        ```bash
        npm start
        ```

8. Install JavaScript dependencies in the Laravel project (optional):

    ```bash
    npm install
    ```
9. Serve the Laravel application:

    ```bash
    php artisan serve
    ```
10. Start using your app right now at http://localhost:3000
