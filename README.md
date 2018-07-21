## Data Driven Test Development Demo

This is a simple demo that shows how to build a JWT-authenticated REST API from scratch by following a data-driven test development methodology.

Let's run a few CRUD operations on the UK Premier League.

### `/team/create`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `POST`       | Creates a new team                         |

Example:

    curl -X POST -i http://localhost:8000/team/create --data '{
        "name": "Arsenal",
        "location": "Holloway, London",
        "stadium": "Emirates Stadium",
        "season": "2017-18"
    }'

    {
      "status": 200,
      "message": "Team successfully created"
    }

### `/team/{season}`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `GET`        | Gets the teams in the given season         |

Example:

    curl -X GET -i http://localhost:8000/team/2017-18

    {
        "status": 200,
        "result": [{
            "id": 1,
            "name": "Arsenal",
            "location": "Holloway, London",
            "stadium": "Emirates Stadium",
            "season": "2017-18"
        }, {
            "id": 2,
            "name": "Bournemouth",
            "location": "Boscombe, Bournemouth",
            "stadium": "Vitality Stadium",
            "season": "2017-18"
        }, {
            "id": 3,
            "name": "Brighton and Hove Albion",
            "location": "Falmer, Brighton and Hove",
            "stadium": "Amex Stadium",
            "season": "2017-18"
        }, {
            "id": 4,
            "name": "Burnley",
            "location": "Burnley",
            "stadium": "Turf Moor",
            "season": "2017-18"
        }, {
            "id": 5,
            "name": "Chelsea",
            "location": "Fulham, London",
            "stadium": "Stamford Bridge",
            "season": "2017-18"
        }, {
            "id": 6,
            "name": "Crystal Palace",
            "location": "Selhurst, London",
            "stadium": "Selhurst Park",
            "season": "2017-18"
        }, {
            "id": 7,
            "name": "Everton",
            "location": "Liverpool",
            "stadium": "Goodison Park",
            "season": "2017-18"
        }, {
            "id": 8,
            "name": "Huddersfield Town",
            "location": "Huddersfield",
            "stadium": "John Smith's Stadium",
            "season": "2017-18"
        }, {
            "id": 9,
            "name": "Leicester City",
            "location": "Leicester",
            "stadium": "King Power Stadium",
            "season": "2017-18"
        }, {
            "id": 10,
            "name": "Liverpool",
            "location": "Liverpool",
            "stadium": "Anfield",
            "season": "2017-18"
        }, {
            "id": 11,
            "name": "Manchester City",
            "location": "Manchester, Greater Manchester",
            "stadium": "Etihad Stadium",
            "season": "2017-18"
        }, {
            "id": 12,
            "name": "Manchester United",
            "location": "Trafford, Greater Manchester",
            "stadium": "Old Trafford",
            "season": "2017-18"
        }, {
            "id": 13,
            "name": "Newcastle United",
            "location": "Newcastle upon Tyne",
            "stadium": "St James' Park",
            "season": "2017-18"
        }, {
            "id": 14,
            "name": "Southampton",
            "location": "Southampton",
            "stadium": "St Mary's Stadium",
            "season": "2017-18"
        }, {
            "id": 15,
            "name": "Stoke City",
            "location": "Stoke-on-Trent",
            "stadium": "bet365 Stadium",
            "season": "2017-18"
        }, {
            "id": 16,
            "name": "Swansea City",
            "location": "Swansea",
            "stadium": "Liberty Stadium",
            "season": "2017-18"
        }, {
            "id": 17,
            "name": "Tottenham Hotspur",
            "location": "Wembley, London",
            "stadium": "Wembley Stadium",
            "season": "2017-18"
        }, {
            "id": 18,
            "name": "Watford",
            "location": "Watford",
            "stadium": "Vicarage Road",
            "season": "2017-18"
        }, {
            "id": 19,
            "name": "West Bromwich Albion",
            "location": "West Bromwich",
            "stadium": "The Hawthorns",
            "season": "2017-18"
        }, {
            "id": 20,
            "name": "West Ham United",
            "location": "Stratford, London",
            "stadium": "London Stadium",
            "season": "2017-18"
        }]
    }

### `/team/update/{id}`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `PUT`        | Updates the given team                     |

Example:

    curl -X PUT -i http://localhost:8000/team/update/12 --data '{
        "location": "Manchester"
    }'

    {
      "status": 200,
      "message": "Team successfully updated"
    }

Example:

    curl -X PUT -i http://localhost:8000/team/update/foo --data '{
        "location": "Manchester"
    }'

    {
      "status": 400,
      "message": "Bad Request"
    }

Example:

    curl -X PUT -i http://localhost:8000/team/update/7848765 --data '{
        "location": "Manchester"
    }'

    {
      "status": 404,
      "message": "Not Found"
    }

### `/team/delete/{id}`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `DELETE`     | Deletes the given team                     |

Example:

    curl -X DELETE -i http://localhost:8000/team/delete/1

    {
      "status": 200,
      "message": "Team successfully deleted"
    }

Example:

    curl -X DELETE -i http://localhost:8000/team/delete/foo

    {
      "status": 400,
      "message": "Bad Request"
    }

Example:

    curl -X DELETE -i http://localhost:8000/team/delete/7848765

    {
      "status": 404,
      "message": "Not Found"
    }

### Database Setup

Make sure your `.env` file contains the following variables:

    DB_DRIVER=pdo_mysql
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=ddtd_demo
    DB_USERNAME=root
    DB_PASSWORD=password

### Start the Docker Services

    docker-compose up --build

### Run the Tests:

SSH the PHP container:

    sudo docker exec -it <container name> /bin/bash
    cd /data-driven-test-development-demo/

Remove the previous database schema (if any):

    php vendor/bin/doctrine orm:schema-tool:drop --force

Create the database schema:

    php vendor/bin/doctrine orm:schema-tool:create

Run the tests:

    php bin/phpunit

## Contributions

Contributions are welcome.

- Feel free to send a pull request
- Drop an email at info@programarivm.com with the subject "Data Driven Test Development Demo"
- Leave me a comment on [Twitter](https://twitter.com/programarivm)
- Say hello on [Google+](https://plus.google.com/+Programarivm)

Many thanks.
