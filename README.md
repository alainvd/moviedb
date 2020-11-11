# Media Database [![Build Status](https://travis-ci.org/codeeu/codeweek.svg?branch=master)](https://travis-ci.org/codeeu/codeweek)

## Installation

### Prerequisites

* To run this project, you must have PHP 7 installed.
* You should setup a host on your web server for your local domain. For this you could also configure Laravel Homestead or Valet. 
* If you want use Redis as your cache driver you need to install the Redis Server. You can either use homebrew on a Mac or compile from source (https://redis.io/topics/quickstart). 

### Step 1

Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies.

```bash
git clone https://github.com/alainvd/moviedb.git
cd moviedb && composer install && npm install
```

### Step 2

1. Create `.env` based on `.env.example` file, and add your database credentials.
2. Modify the path to the certs in the .env file
3. Comment the CAS_MASQUERADE user if you want to test against the EU Login Server. Please note that in order to do this, you have to setup your local domain as moviedb.test.europa.eu


### Step 3


Create the database named moviedb (default name in the .env file)

```bash
php artisan key:generate
chmod -R 777 storage
php artisan migrate:fresh --seed
npm run dev
```

### Step 4

1. Next, boot up a server and visit your site. If using a tool like Laravel Valet, of course the URL will default to `http://moviedb.test`.
