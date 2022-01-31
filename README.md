## Breaking Bad Characters
This is an application where you can view information about the characters in the series 'Breaking Bad' and 'Better Call Saul'

## Local Development

> **Requires:**
- **Laravel 8.x**
- **Livewire 2.x**
- **AlpineJS 3.x**
- **TailwindCSS 3.x**
- **Postgres 10 or higher**

Follow the instructions below to work on the project:

1. Clone or Fork this repository
2. Open your terminal and `cd` into the project
3. Run the `start.sh` bin script, which will execute the scripts necessary for the installation:
    ```bash
    sh ./bin/start.sh
    ```
4. Run the below artisan command to populate the database
    ```bash
    php artisan fetch:characters-and-quotes
    ```
   
