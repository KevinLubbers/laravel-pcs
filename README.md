# PCS Ticket System
The purpose of this project is to provide a fully functioning ticket system to help cut down on email noise for the PCS Department
 - Members of other departments submit tickets to this system when they need assistance of some sort
 - Tickets are routed to a specialist based on the user's Task, Division, and Model selection
 - Email confirmtion is sent to the user who submitted the ticket and the specialist assigned the ticket
 - Ticket Dashboard lets the whole department stay on the same page without anyone needing to say a word
## Local Setup with Sail

This project is built with Laravel 10 and uses Laravel Sail for local development (and viewing / testing) via Docker.

Please feel free to run this web application on your own machine!


### Requirements (for Windows)
---

Before starting, make sure you have the following installed on your machine:

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [Git](https://git-scm.com/install/windows)
- [Windows Subsystem for Linux (WSL 2)](https://learn.microsoft.com/en-us/windows/wsl/install) 

No local PHP, Composer, or database installation is required. We are using Docker to manage those dependencies.

---

## Setup Instructions

## 1. Clone the repository and navigate to new folder
```
git clone https://github.com/KevinLubbers/laravel-pcs.git
cd laravel-pcs
```
## 2. Copy the example env file 
Default values have already been entered into .env.example to work with Laravel Sail

Laravel reads environment variables from .env file
```
cp .env.example .env
```
## 3. Raise the Sails
This command tells Docker to read the docker-compose.yml file and execute the instructions found within (setting up the database, webserver, redis, etc)
```
./vendor/bin/sail up -d
```
It gets tiring typing this command over and over again. Set up an alias to make your life easier!

<sup>How To: [Laravel Docs](https://laravel.com/docs/12.x/sail#configuring-a-shell-alias)</sup>
## 4. Application Key, Migrations, and Seeders
The Application Key is used during encryption / decryption, signing URLs, and password reset tokens
```
./vendor/bin/sail artisan key:generate
```
- Migrations create the database programatically
- Seeders fill the database with predefined data programatically
```
./vendor/bin/sail artisan migrate --seed
```

## 5. Install Front-End Dependancies

```
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```
## 6. Open your web browser and visit localhost to see my work
A test account is included in the seeder. Log in and test the functionality. Tell me if you like how it looks.
 - username: test@gmail.com
 - password: password
