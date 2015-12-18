# Docker tutorial

This repository comes with the blog article [From Vagrant to Docker: How to use Docker for local web development](http://blog.osteel.me/posts/2015/12/18/from-vagrant-to-docker-how-to-use-docker-for-local-web-development.html "From Vagrant to Docker: How to use Docker for local web development"). Please refer to it for a full explanation.

It contains a basic LEMP stack running with Docker, intented to be used for local web development.

## Get started

[Install Docker](https://docs.docker.com/engine/installation/ "Install Docker Engine") on your machine.

Clone the project:

    $ git clone git@github.com:osteel/docker-tutorial.git

From the project root:

    $ docker-compose up -d

Get the Docker Machine IP:

    $ docker-machine ip default

Access it from your browser.

phpMyAdmin is available on port 8080.

## Description

The different containers are described in `docker-compose.yml`.

There are 6 of them:

 - a container for Nginx
 - a container for PHP-FPM
 - a container for MySQL
 - a container for phpMyAdmin
 - a container to make MySQL data persistent
 - a container for the application code

All of them are using official images.

The application is available on the port 80 of the host machine.

Again, for the complete tutorial please head to the [original post](http://blog.osteel.me/posts/2015/12/18/from-vagrant-to-docker-how-to-use-docker-for-local-web-development.html "From Vagrant to Docker: How to use Docker for local web development").