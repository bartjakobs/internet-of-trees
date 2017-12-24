The Internet of Trees is a small REST API for registering christmas trees. 
Using the IoT, all trees can be registered in one centralized tree database.

# API Endpoints

## Users
| Method | URL                    | Data                                           | Description          |
| ------ | --------------------- | ---------------------------------------------- | -------------------- |
| POST   | /api/auth/register     | email, name, password                          | Registers a new user | 
| POST   | /api/auth/gettoken     | email, password                                | Returns a token      |
| GET    | /api/auth/user         | token                                          | Shows user info      |

Data: 
* __email__ is an e-mail adress for the user, used for logging in.
* __name__ is the users name. 
* __password__ is the users password.
* __token__ is the token, received from */api/auth/gettoken*.

## Trees

| Method | URL                    | Data                                           | Description          |
| ------ | ---------------------- | ---------------------------------------------- | -------------------- |
| GET    | /api/trees             | token                                          | Lists user trees     | 
| GET    | /api/trees/{id}        | token                                          | Shows tree info      |
| POST   | /api/trees             | token, name, location, decorations, ison       | Registers a new tree |
| POST   | /api/trees/{id}        | token,(name),(location),(decorations),(ison    | Modifies tree        |
| DELETE | /api/trees/{id}        | token,                                         | Deletes tree         |

Data: 
* __token__ is the token, received from */api/auth/gettoken*.
* __name__ is a name for a christmas tree.
* __location__ is the trees location. 
* __decorations__ is the number of decorations (integer).
* __ison__ is the current state of the christmas lights (boolean)


## Public API

| Method | URL                    | Data                                           | Description          |
| ------ | ---------------------- | ---------------------------------------------- | -------------------- |
| GET    | /api/public/statistics |                                                | Shows statistics     | 


# API Console

The Internet of TREES has some beautiful endpoints, all of which can be tried and experimented with in the API console, 
running on /console


# Installing

While installing the Internet of Trees on another server kind of defeats the purpose of having one centralized tree database, it's possible to install this on your own server.

Download the code from git, copy the .env.example to .env and add database information.
 ```bash
 composer install         # Install using composer
 php artisan key:generate # Generate application key
 php artisan jwt:secret   # Generate JWT secret
 php artisan migrate      # Migrate the database
 php artisan db:seed      # Seed the database
```