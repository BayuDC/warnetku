# Warnetku

Warnetku is a web app for managing computer, operator, rental price and
rental transaction in an internet cafe(it's called warnet in my country).
This app is made to ease the work of internet cafe operators. For example,
determine the price to be paid by the customer.

![Web Status](https://img.shields.io/website.svg?url=https://warnetku.herokuapp.com&style=for-the-badge)

## ✨ Demo

Web url: https://warnetku.herokuapp.com  
You can use the account below for login access

| Username | Password | Role   |
| -------- | -------- | ------ |
| admin1   | admin1   | Owner  |
| admin2   | admin2   | Worker |

## 📑 Documentation

-   ### Computer
    Operator can manage computer here (CRUD). Operator can also see
    a list of computers along with their type and status. There are two
    types of computers: _Gaming_ and _Office_. Computer status can be
    _Used by ..._ or _Idle_.
-   ### Price
    Operator can manage rental price based on computer type (CRUD).
-   ### Operator
    Operator can see a list of all operators, but can't perform add,
    update and delete operations. Only operator with _Owner_ role can
    do that thing.
-   ### Transaction
    Operator cam add rental transaction at here. Operator can see other
    operator transaction but can't update and delete it. Each operator
    can only update and delete their own transaction.
-   ### Daily Report
    just like it name, operators can see daily reports here.

## 🧪 Database Structure

![Database](https://cdn.discordapp.com/attachments/946013429200723989/951855735157960754/drawSQL-export-2022-03-11_21_53.png)

## 🛠️ Development

```
# Clone the project
$ git clone https://github.com/BayuDC/warnetku.git
$ cd warnetku

# Install dependencies
$ composer install

# Create env file
$ cp .env.example .env

# Set all required variables
$ nano .env
# or using your favorite text editor

# Generate encryption key
$ php artisan key:generate

# Database migration
$ php aritsan migrate
# with seed
$ php artisan migrate --seed

$ Run dev server
$ php artisan serve
```

## 📝 Todo

-   Refactor, there are so many inefficient and repetitive code
