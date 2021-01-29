# Docker for local web development, part 5: HTTPS all the things

This repository accompanies a [tutorial series](https://tech.osteel.me/posts/docker-for-local-web-development-why-should-you-care "Docker for local web development, introduction: why should you care?") about leveraging Docker for local web development.

The current branch covers part 5 of the series, which is about adding SSL/TLS to the environment using a self-signed certificate. Please refer to the [full article](https://tech.osteel.me/posts/docker-for-local-web-development-part-5-https-all-the-things "Docker for local web development, part 5: HTTPS all the things") for a detailed explanation.

## Content

This branch contains a [three-tier architecture](https://www.techopedia.com/definition/24649/three-tier-architecture) application running on a LEMP stack, supported by Docker and orchestrated by Docker Compose.

It includes:

* A container for Nginx;
* A container for the backend application (based on [Laravel](https://laravel.com/));
* A container for the frontend application (based on [Vue.js](https://vuejs.org/));
* A container for MySQL;
* A container for phpMyAdmin;
* A volume to persist MySQL data.

The containers are based on Alpine images when available, for an optimised size.

## Prerequisites

Make sure [Docker Desktop for Mac or PC](https://www.docker.com/products/docker-desktop) is installed and running, or head [over here](https://docs.docker.com/install/) if you are a Linux user. You will also need a terminal running [Git](https://git-scm.com/) and [Bash](https://www.gnu.org/software/bash/).

This setup also uses localhost's ports 80 and 443, so make sure those are available.

## Directions of use

Add the following domains to your machine's `hosts` file:

```
127.0.0.1 backend.demo.test frontend.demo.test phpmyadmin.test
```

Clone the repository and `checkout` the `part-5` branch:

```
$ git clone git@github.com:osteel/docker-tutorial.git && cd docker-tutorial
$ git checkout part-5
```

Add the following function to your Bash start-up file (`.bashrc`, `.zshrc`...):

```
function demo {
    cd <PATH>/docker-tutorial && bash demo $*
        cd -
}
```

Where `<PATH>` is the absolute path leading to the folder where the repository was cloned.

Open a new terminal window or `source` your Bash start-up file for the changes to take effect, then run the following command:

```
$ demo init
```

This will download and build the images listed in `docker-compose.yml`, create and start the corresponding containers, and take other various steps to set up the project (this might take a while).

You're also likely to be prompted for your system account's password to install the SSL/TLS self-signed certificate, unless you're on Windows, in which case you'll need to install it [manually](https://www.thewindowsclub.com/manage-trusted-root-certificates-windows) (you will find it under `.docker/nginx/certs`).

Once the script is done, you can visit [frontend.demo.test](https://frontend.demo.test) and [backend.demo.test](https://backend.demo.test).

Learn about the available commands by displaying the menu:

```
$ demo
```

## Explanation

The images used by the setup are listed and configured in [`docker-compose.yml`](https://github.com/osteel/docker-tutorial/blob/part-5/docker-compose.yml).

When building and starting the containers based on the images for the first time, a MySQL database named `demo` is automatically created (you can pick a different name in the MySQL service's description in `docker-compose.yml`).

Minimalist Nginx configurations for the [backend application](https://github.com/osteel/docker-tutorial/blob/part-5/.docker/nginx/conf.d/backend.conf), the [frontend application](https://github.com/osteel/docker-tutorial/blob/part-5/.docker/nginx/conf.d/frontend.conf) and [phpMyAdmin](https://github.com/osteel/docker-tutorial/blob/part-5/.docker/nginx/conf.d/phpmyadmin.conf) are also copied over to Nginx's container, making them available at [backend.demo.test](https://backend.demo.test), [frontend.demo.test](https://frontend.demo.test) and [phpmyadmin.test](https://phpmyadmin.test) respectively (the database credentials are *root* / *root*).

The directories containing the backend and frontend applications are mounted onto both Nginx's and the applications' containers, meaning any update to the code is immediately available upon refreshing the page, without having to rebuild any container.

Moreover, the Vue.js development server is automatically started, meaning you can update the code and benefit from _hot-reload_ straight away.

The frontend application is consuming a simple endpoint from the backend application to fetch and display the text below the animated gif.

The database data is persisted in its own local directory through the volume `mysqldata`, which is mounted onto MySQL's container.

When running `demo init`, all of the required steps to set up the project (installing dependencies, running database migrations, generating `.env` files, etc.) are automatically handled by a [Bash function](https://github.com/osteel/docker-tutorial/blob/part-5/demo#L42). Since the backend requires some extra steps, a [dedicated script](https://github.com/osteel/docker-tutorial/blob/part-5/.docker/backend/init) is mounted onto and run directly in its container.

The SSL/TLS certificate is generated using OpenSSL on the Nginx container, and is installed automatically on your local machine unless you are on [Windows](https://www.thewindowsclub.com/manage-trusted-root-certificates-windows). It is also installed on the backend container, which allows it to directly communicate with the frontend container via the `frontend.demo.test` network alias defined for the Nginx service in `docker-compose.yml`.

Please refer to the [full article](https://tech.osteel.me/posts/docker-for-local-web-development-part-5-https-all-the-things "Docker for local web development, part 5: HTTPS all the things") for a detailed explanation.

## Cleaning up

To stop the containers:

```
$ demo stop
```

To destroy the containers:

```
$ demo down
```

To destroy the containers and the associated volumes:

```
$ demo down -v
```

To remove everything, including images and orphans containers:

```
$ demo destroy
```
