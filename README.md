#### PowerDNS - Simple Admin Interface

SimplePDNS is simplified and free administrative tool for PowerDNS compatible with MariaDB as a records storage.

SimplePDNS is based on:
* [Symfony v4](https://symfony.com/) as managing Front-end/Back-end.
* XTreme Admin Lite by [wrappixel](https://wrappixel.com/) the free lite version of a Bootstrap v4 theme for he look&feel.
* Dockerized & ready for use containers for local development by [wodby](https://github.com/wodby).

#### Requirements
* Docker
* NodeJS
* Yarn

#### Basic configuration to setup the project for local usage

1. Clone this repository in your desired directory.
2. Use your favorite terminal to navigate to the `<project root>`.
3. Make sure `Docker` is running on your system. To build the containers execute `make up` and wait for the command to finish.
4. Setup the project configuration for the first time.
    * Execute `make shell` to open a bash session inside your container.
    * Execute `./bin/console doctrine:schema:create` from your container to create the database tables for the first time.
    * Execute `./bin/console doctrine:migrations:migrate -n` to execute all pending migrations.
    * Type `exit` to close your bash session.
5. Setup the npm dependencies.
    * Navigate to the document root directory of the project - `www/`
    * Execute `yarn` and wait few minutes to download all of the dependent packages.
    * Execute `yarn encore dev` or `yarn encore production` to build all of the project assets.
6. Open up in browser.
    * Navigate to `http://pdns.localhost:8091/` and you should immediately be prompted for login credentials.
    * Use `admin@example.com` for e-mail and `admin` for password.
    
#### Other tools available

* There are at least 2 ways to access the database directly, if needed.
    * By using `Adminer`, one of the available containers, by navigating to `http://adminer.pdns.localhost:8091/` or by opening a bash session with `make shell`
    * Credentials can be found in the `.env` file of the project root.
    
#### Developer note

Although this project is fairy small and simple, it is still on process of development.