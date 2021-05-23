### APP Setup

#### Introduction
This APP can be used to get estimate of an order to be placed and can as well be used to place and make payment for an order to ship items.
This APP is available for testing via this link [https://super-freighters-app.herokuapp.com](https://super-freighters-app.herokuapp.com)

#### Cloning project
Use the git command below to clone this project

````
$ cd ~
$ git clone git@github.com:Pharoouzy/super-freighters.git
````

#### Quick Start
To load in all php dependencies

````
$ cd super-freighters
$ composer install
````

Copy the .env.example file to .env and update the following accordingly

````
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=XXX
DB_USERNAME=XXX
DB_PASSWORD=XXX

MAIL_MAILER=XXXXXXXX
MAIL_HOST=XXXXXXXX
MAIL_PORT=XXXXXXXX
MAIL_USERNAME=XXXXXXXX
MAIL_PASSWORD=XXXXXXXX
MAIL_ENCRYPTION=XXXXXXXX
MAIL_FROM_ADDRESS=XXXXXXXX
MAIL_FROM_NAME=XXXXXXXX
````

---
Replace the Xs with your actual value in the .env file.

---
Update your Paystack API Credentials in the .env file as shown below
````
PAYSTACK_ENV=XXXXXXXX
PAYSTACK_INITIALIZE_URL=XXXXXXXX
PAYSTACK_VERIFY_URL=XXXXXXXX
PAYSTACK_TEST_SECRET_KEY=XXXXXXXX
PAYSTACK_TEST_PUBLIC_KEY=XXXXXXXX
PAYSTACK_LIVE_SECRET_KEY=XXXXXXXX
PAYSTACK_LIVE_PUBLIC_KEY=XXXXXXXX
````

Proceed to generating you unique application key with the following command

````
$ php artisan key:generate
````

When all this has been done, you then proceed to run the command below for database migration and seed
````
$ php artisan migrate --seed
````
Alternatively, you can make use of the Database dump file located at:
````super-freighters/database/db-dump.sql```` to load the database

Start the application by running the command below:

````
$ php artisan serve
````

Use the command below to run unit test:

````
$ php artisan test
````

### Miscellaneous
There is also a backoffice UI for managing Countries, Modes, APP Settings (For setting up the payment environment and also the Customs Tax value), and Orders.

- #### Countries page can be accessed here [https://super-freighters-app.herokuapp.com/countries](https://super-freighters-app.herokuapp.com/countries)
  
- #### Mode of Transport page can be accessed here [https://super-freighters-app.herokuapp.com/modes](https://super-freighters-app.herokuapp.com/modes)

- #### APP Settings page can be accessed here [https://super-freighters-app.herokuapp.com/settings](https://super-freighters-app.herokuapp.com/settings)

- #### Orders page can be accessed here [https://super-freighters-app.herokuapp.com/orders](https://super-freighters-app.herokuapp.com/orders)
