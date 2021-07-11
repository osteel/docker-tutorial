# Docker for local web development, part 2: put your images on a diet

This repository accompanies a [tutorial series](https://tech.osteel.me/posts/docker-for-local-web-development-why-should-you-care "Docker for local web development, introduction: why should you care?") about leveraging Docker for local web development.

The current branch covers part 2 of the series, which is about reducing the size of the images. Please refer to the [full article](https://tech.osteel.me/posts/docker-for-local-web-development-part-2-put-your-images-on-a-diet "Docker for local web development, part 2: put your images on a diet") for a detailed explanation.

## Content

This branch contains a basic LEMP stack running on Docker and orchestrated by Docker Compose, including:

* A container for Nginx;
* A container for PHP-FPM;
* A container for MySQL;
* A container for phpMyAdmin;
* A volume to persist MySQL data.

The containers are based on Alpine images when available, for an optimised size.

## Prerequisites

Make sure [Docker Desktop for Mac or PC](https://www.docker.com/products/docker-desktop) is installed and running, or head [over here](https://docs.docker.com/install/) if you are a Linux user. You will also need a terminal running [Git](https://git-scm.com/).

This setup also uses localhost's port 80, so make sure it is available.

## Directions of use

Add the following domains to your machine's `hosts` file:

```
127.0.0.1 php.test phpmyadmin.test
```

Clone the repository and `checkout` the `part-2` branch:

```
$ git clone git@github.com:osteel/docker-tutorial.git && cd docker-tutorial
$ git checkout part-2
```

Copy `.env.example` to `.env`:

```
$ cp .env.example .env
```

Run the following command:

```
$ docker compose up -d
```

This may take a little bit of time, as some Docker images might need downloading.

Once the script is done, visit [php.test](http://php.test).

## Explanation

The images used by the setup are listed and configured in [`docker-compose.yml`](https://github.com/osteel/docker-tutorial/blob/part-2/docker-compose.yml).

When building and starting the containers based on the images for the first time, a MySQL database named `demo` is automatically created (you can pick a different name in the MySQL service's description in `docker-compose.yml`).

Minimalist Nginx configurations for the [PHP application](https://github.com/osteel/docker-tutorial/blob/part-2/.docker/nginx/conf.d/php.conf) and [phpMyAdmin](https://github.com/osteel/docker-tutorial/blob/part-2/.docker/nginx/conf.d/phpmyadmin.conf) are also copied over to Nginx's container, making them available at [php.test](http://php.test) and [phpmyadmin.test](http://phpmyadmin.test) respectively (the database credentials are *root* / *root*).

The `src/` directory containing the application is mounted onto both Nginx's and the application's containers, meaning any update to the code is immediately available upon refreshing the page, without having to rebuild any container.

The database data is persisted in its own local directory through the volume `mysqldata`, which is mounted onto MySQL's container.

Please refer to the [full article](https://tech.osteel.me/posts/docker-for-local-web-development-part-2-put-your-images-on-a-diet "Docker for local web development, part 2: put your images on a diet") for a detailed explanation.

## Cleaning up

To stop the containers:

```
$ docker compose stop
```

To destroy the containers:

```
$ docker compose down
```

To destroy the containers and the associated volumes:

```
$ docker compose down -v
```

To remove everything, including images and orphan containers:

```
$ docker compose down -v --rmi all --remove-orphans
```
