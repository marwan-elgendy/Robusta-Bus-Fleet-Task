[<p align="center"><img src="robusta.png" alt="robusta" width="500"/></p>](https://robustastudio.com/)  

# Fleet Management System(Bus Management)

## Intro
This Repo is for Robusta Studio Hiring Task.
The task is buidling a fleet management system.

## Features
1. JWT Secrets
2. Admin Middleware & Endpoints
3. Using Docker through Laravel Sail to create docker-compose.yaml
4. DB Seeders
5. Validation Through Requests
6. Using Repositories to decouple hard dependencies of models from controllers.
7. Using API Resources to shape responses made to the API.
8. Pagination.

## Prerequisities
 
 You Just have to have Docker installed on your device.

## Installation & Setup

1. Clone the Repository on your machine.
    ```
    git clone https://github.com/marwan-elgendy/Robusta-Bus-Fleet-Task
    ```
    ```
    cd Robusta-Bus-Fleet-Task
    ```
2. Configure bash alias for laravel Sail
    ```
    alias sail='bash vendor/bin/sail'
    ```
3. Build and Run the project using deatached mode
    ```
    sail up -d
    ```
4. Migrate & Seed the Database
    ```
    sail artisan migrate --seed
    ```
5. Import Postman Collection to test the endpoints
6. Try registering a new user or you can log in using these users:
    - Admin Account
        - email: admin@gmail.com
        - password: password
    - User Account:
        - email: testuser@gmail.com
        - password: password
7. After you get the access_token from the login response, you should add it in the collection variables, the name of the variable is bearer_token and it already exists in the Postman collection that comes with the project, you just have to update it.
8. To Stop The Containers Insert this command
    ```
    sail stop
    ```


## API Endpoints

All API Endpoints can be found with examples in this [Postman Collection](https://github.com/marwan-elgendy/Robusta-Bus-Fleet-Task/blob/master/Robusta%20Fleet%20Management.postman_collection.json)


### EED Diagram
![ERD](https://github.com/marwan-elgendy/Robusta-Bus-Fleet-Task/blob/master/Bus%20Ticketing%20System.png)
