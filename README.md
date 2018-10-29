## Data Driven Test Development Demo

<p align="center">
	<img src="https://github.com/programarivm/data-driven-test-development-demo/blob/master/resources/premier-league-logo.png" />
</p>

This is a simple demo that shows how to build a JWT-authenticated REST API from scratch by following a data-driven test development methodology. Let's run a few CRUD operations on the UK Premier League.

For further information please visit this post: [A Data-Driven Test Development (DDTD) Approach with PHPUnit](https://programarivm.com/data-driven-test-development-demo-ddtd-approach-with-phpunit/).

### Start the Docker Services

    docker-compose up --build

### Install the Dependencies

    docker exec -it --user 1000:1000 ddtd_demo_php_fpm composer install

### Bootstrap the Testing Database

Copy and paste the following into your `.env` file:

    DB_DRIVER=pdo_mysql
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=ddtd_demo
    DB_USERNAME=root
    DB_PASSWORD=password
    DATABASE_URL=mysql://root:password@mysql:3306/ddtd_demo

Then run:

    docker exec -it --user 1000:1000 ddtd_demo_php_fpm php bin/console database:bootstrap

### Run the Tests

Copy and paste the following code into your `phpunit.xml.dist` file:

```
<?xml version="1.0" encoding="UTF-8"?>
<phpunit
    backupGlobals="false"
    colors="true"
    bootstrap="vendor/autoload.php"
>
    <php>
        <env name="KERNEL_CLASS" value="App\Kernel" />
        <env name="APP_ENV" value="test"/>
        <env name="DATABASE_URL" value="mysql://root:password@mysql:3306/ddtd_demo"/>
        <env name="JWT_SECRET" value="example_secret_for_testing_only"/>
    </php>
    <testsuites>
        <testsuite name="auth">
            <directory>tests/auth</directory>
        </testsuite>
        <testsuite name="team/create">
            <directory>tests/team/create</directory>
        </testsuite>
        <testsuite name="team/update/{id}">
            <directory>tests/team/update/{id}</directory>
        </testsuite>
        <testsuite name="team/{season}">
            <directory>tests/team/{season}</directory>
        </testsuite>
        <testsuite name="team/delete/{id}">
            <directory>tests/team/delete/{id}</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

Then run:

    docker exec -it --user 1000:1000 ddtd_demo_php_fpm php bin/phpunit

## API Endpoints

### `/auth`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `PUT`        | Gets a new access token                    |

Example:

    curl -X POST -i http://localhost:8080/auth --data '{
        "username": "bob",
        "password": "password"
    }'

    {
        "status": 200,
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTMyMjg2NTIzfQ.Kz1WPilwEqbWevpGGDbVv3smAuzjhsjXtL7lbG4aQXk"
    }

### `/team/create`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `POST`       | Creates a new team                         |

Example:

    curl -X POST -i http://localhost:8080/team/create --data '{
        "name": "Arsenal",
        "location": "Holloway, London",
        "stadium": "Emirates Stadium",
        "season": "2017-18"
    }'

    {
      "status": 401,
      "message": "Unauthorized"
    }

Example:

    curl -X POST -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTMyMjg2NTIzfQ.Kz1WPilwEqbWevpGGDbVv3smAuzjhsjXtL7lbG4aQXk' -i http://localhost:8080/team/create --data '{
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

    curl -X GET -i http://localhost:8080/team/2017-18

    {
        "status": 401,
        "message": "Unauthorized"
    }

Example:

    curl -X GET -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTMyMjg2NTIzfQ.Kz1WPilwEqbWevpGGDbVv3smAuzjhsjXtL7lbG4aQXk' -i http://localhost:8080/team/2017-18

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

    curl -X PUT -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTMyMjkzMDQxfQ.qqocS5aazMf8ebXigjmA0JKhEnlrJs4idGE-8MZjMUU' -i http://localhost:8080/team/update/12 --data '{
        "location": "Manchester"
    }'

    {
      "status": 200,
      "message": "Team successfully updated"
    }

Example:

    curl -X PUT -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTMyMjkzMDQxfQ.qqocS5aazMf8ebXigjmA0JKhEnlrJs4idGE-8MZjMUU' -i http://localhost:8080/team/update/foo --data '{
        "location": "Manchester"
    }'

    {
      "status": 400,
      "message": "Bad Request"
    }

Example:

    curl -X PUT -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTMyMjkzMDQxfQ.qqocS5aazMf8ebXigjmA0JKhEnlrJs4idGE-8MZjMUU' -i http://localhost:8080/team/update/7848765 --data '{
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

    curl -X DELETE -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTMyMjkzMDQxfQ.qqocS5aazMf8ebXigjmA0JKhEnlrJs4idGE-8MZjMUU' -i http://localhost:8080/team/delete/1

    {
      "status": 200,
      "message": "Team successfully deleted"
    }

Example:

    curl -X DELETE -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTMyMjkzMDQxfQ.qqocS5aazMf8ebXigjmA0JKhEnlrJs4idGE-8MZjMUU' -i http://localhost:8080/team/delete/foo

    {
      "status": 400,
      "message": "Bad Request"
    }

Example:

    curl -X DELETE -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTMyMjkzMDQxfQ.qqocS5aazMf8ebXigjmA0JKhEnlrJs4idGE-8MZjMUU' -i http://localhost:8080/team/delete/7848765

    {
      "status": 404,
      "message": "Not Found"
    }

## Contributions

Contributions are welcome.

- Feel free to send a pull request
- Drop an email at info@programarivm.com with the subject "Data Driven Test Development Demo"
- Leave me a comment on [Twitter](https://twitter.com/programarivm)
- Say hello on [Google+](https://plus.google.com/+Programarivm)

Many thanks.
