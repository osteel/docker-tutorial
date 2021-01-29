# Docker for local web development, part 1: a basic LEMP stack

This repository accompanies a [tutorial series](https://tech.osteel.me/posts/docker-for-local-web-development-why-should-you-care "Docker for local web development, introduction: why should you care?") about leveraging Docker for local web development.

The current branch covers part 1 of the series, which is about setting up a basic LEMP stack with Docker Compose. Please refer to the [full article](https://tech.osteel.me/posts/docker-for-local-web-development-part-1-a-basic-lemp-stack "Docker for local web development, part 1: a basic LEMP stack") for a detailed explanation.

## Content

This branch contains a basic LEMP stack running on Docker and orchestrated by Docker Compose, including:

* A container for Nginx;
* A container for PHP-FPM;
* A container for MySQL;
* A container for phpMyAdmin;
* A volume to persist MySQL data.

## Prerequisites

Make sure [Docker Desktop for Mac or PC](https://www.docker.com/products/docker-desktop) is installed and running, or head [over here](https://docs.docker.com/install/) if you are a Linux user. You will also need a terminal running [Git](https://git-scm.com/).

This setup also uses localhost's port 80, so make sure it is available.

## Directions of use

Add the following domain to your machine's `hosts` file:

```
127.0.0.1 php.test
```

Clone the repository and change the current directory for the project's root:

```
$ git clone git@github.com:osteel/docker-tutorial.git
$ cd docker-tutorial
```

Copy `.env.example` to `.env`:

```
$ cp .env.example .env
```

Run the following command:

```
$ docker-compose up -d
```

This may take a little bit of time, as some Docker images might need downloading.

Once the script is done, visit [php.test](http://php.test) (you might initially get a MySQL error message: this is because the database is still being created; the error will soon disappear upon refreshing the page).

## Explanation

The images used by the setup are listed and configured in [`docker-compose.yml`](https://github.com/osteel/docker-tutorial/blob/part-1/docker-compose.yml).

When building and starting the containers based on the images for the first time, a MySQL database named `demo` is automatically created (you can pick a different name in the MySQL service's description in `docker-compose.yml`).

A [minimalist Nginx configuration](https://github.com/osteel/docker-tutorial/blob/part-1/.docker/nginx/conf.d/php.conf) for the PHP application is also copied over to Nginx's container, making it available at [php.test](http://php.test).

The `src/` directory containing the application is mounted onto both Nginx's and the application's containers, meaning any update to the code is immediately available upon refreshing the page, without having to rebuild any container.

The database data is persisted in its own local directory through the volume `mysqldata`, which is mounted onto MySQL's container. A phpMyAdmin interface is available at [localhost:8080](http://localhost:8080) (the database credentials are root / root).

Please refer to the [full article](https://tech.osteel.me/posts/docker-for-local-web-development-part-1-a-basic-lemp-stack "Docker for local web development, part 1: a basic LEMP stack") for a detailed explanation.

## Cleaning up

To stop the containers:

```
$ docker-compose stop
```

To destroy the containers:

```
$ docker-compose down
```

To destroy the containers and the associated volumes:

```
$ docker-compose down -v
```

To remove everything, including images and orphan containers:

```
$ docker-compose down -v --rmi all --remove-orphans
```
