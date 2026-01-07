# AJAX Blog

A simple blog platform powered by PHP and PostgreSQL, designed to be served via Nginx and run in a Docker environment. This project uses AJAX calls to interact with the PHP backend.

## Tech Stack

- **Backend:** PHP
- **Database:** PostgreSQL
- **Web Server:** Nginx
- **Containerization:** Docker

## Folder Structure

```
.
├── docker-compose.yml     # Main Docker orchestration file
├── database/
│   └── users.sql          # Initial database schema
└── web_page/
    ├── docker/            # Docker configurations for services
    │   ├── nginx/
    │   └── php/
    ├── public/            # Public web root, accessible to browsers
    │   └── index.php      # Main entry point for the application
    └── src/               # PHP source code and application logic
```

## Getting Started

### Prerequisites

- [Docker](https://docs.docker.com/get-docker/)
- Docker Compose (usually included with Docker Desktop)

### Running the Application

1. Clone or download the project.
2. From the root of the project directory, build and start the services using Docker Compose:

    ```bash
    docker compose up -d --build
    ```

This command will build the custom PHP image and start all the required services (Nginx, PHP, PostgreSQL, and Adminer) in the background.

### Accessing the Services

- **Main Application:** [http://localhost:8000](http://localhost:8000)
- **Database Management (Adminer):** [http://localhost:8080](http://localhost:8080)

To log into Adminer, use the following credentials:
- **System:** `PostgreSQL`
- **Server:** `db` (this is the service name from `docker-compose.yml`)
- **Username:** `user`
- **Password:** `password`
- **Database:** `blog_db`

## Stopping the Application

To stop all running services and remove the containers, run:

```bash
docker compose down
```
