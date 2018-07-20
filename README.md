## Data Driven Test Development Demo

This is a simple demo that shows how to build a JWT-authenticated REST API from scratch by following a data-driven test development methodology. Let's run a few CRUD operations on the UK Premier League.

#### /team/create

| Method       | Description                                |
|--------------|--------------------------------------------|
| `POST`       | Creates a new team                         |

#### /team/{season}

| Method       | Description                                |
|--------------|--------------------------------------------|
| `GET`        | Gets the teams in the given season         |

#### /team/update/{id}

| Method       | Description                                |
|--------------|--------------------------------------------|
| `PUT`        | Updates the given team                     |

#### /team/delete/{id}

| Method       | Description                                |
|--------------|--------------------------------------------|
| `DELETE`     | Deletes the given team                     |

TODO

### Examples

TODO

## How Tos

### Database Setup

Make sure your `.env` contains the following variables:

    DB_DRIVER=pdo_mysql
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=ddtd_demo
    DB_USERNAME=root
    DB_PASSWORD=password

### Create the Database Schema

SSH the PHP container:

    sudo docker exec -it <container name> /bin/bash
    cd /data-driven-test-development-demo/

Create the database schema:

    php vendor/bin/doctrine orm:schema-tool:create

### Run the Tests:

    php bin/phpunit

## Contributions

Contributions are welcome.

- Feel free to send a pull request
- Drop an email at info@programarivm.com with the subject "Data Driven Test Development Demo"
- Leave me a comment on [Twitter](https://twitter.com/programarivm)
- Say hello on [Google+](https://plus.google.com/+Programarivm)

Many thanks.
