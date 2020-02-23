# Concert Tickets API Application

## About Concert Tickets

Concert Tickets is an API application developed in PHP using [Laravel framework](). After the build you will be able to view, create, edit, delete bookings of music events in South Wales.

Each endpoint is secured with a token using Larvel Passport giving access only to the relevant user except registration, login & view all events services.


## Build steps

1.  Download the repository and access the project's directory on terminal.
2.  Open .env and insert your MySQL connection details (DB_HOST,DB_PORT,DB_USERNAME)
3.  Run the following commands on terminal:

> composer install

> php artisan db:create

> php artisan migrate

> php artisan db:seed

> php artisan passport:install

> php artisan serve


## Endpoints

First of all create a user using the "Register" endpoint.
A postman collection is included to test the endpoints:

    POST '/api/login'
    POST '/api/register'
    GET '/api/events'
    GET '/api/all_bookings'
    POST '/api/new_booking'
    PUT '/api/booking/{id}'
    DELETE '/api/booking/delete/{id}'
#### Payloads:
> example endpoint -> ['field_name|datatype']

> login -> ['email|string', 'password|string']

> register -> ['name|string', 'email"string', 'password|string']

> new_booking ->['events_id|integer', 'delivery_address|string', 'ticket_quantity|integer']

> booking/{id} -> ['delivery_address|string']


#### Authetication:
A token is returned on Registration & Login services' responses.
Add the 'Authorisation' field in headers and in the value field preceed the token value with Bearer OR if using Postman select 'Bearer Token' in Authorisation option

## Author

If you have any problems/questions contact Danish Nadeem via [danishcj@gmail.com](mailto:danishcj@gmail.com).

