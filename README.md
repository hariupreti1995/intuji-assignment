# Evento - Intuji Assessment
![alt text](https://github.com/hariupreti1995/intuji-assignment/blob/main/src/images/logo.png?raw=true)
## Assessment description
An event management system that allows visitors to create and change event information, resulting in an event on Google Calendar.

## Git flow
The main branch will be updated to test the assessment.

## Setup requirement
To set up this project on your local machine, you must first clone the main branch of this repository. You also need to have PHP 8.1 set up on your device, as well as mysql setup and related packages installed for PHP and MySQL support.

## Environment setup
You will locate the .env.example file in the root directory; please create a file named .env from it and modify required information based on your configuration.

## Database and table migration
Once you obtained the updated code from the repository, you'll notice a builddb.php file in the root directory which is the script for creating the database and table, so all you have to do is run the following command to create the database and table. Please be aware that this process will drop and establish a new database named evento, if you currently have a database with the same name, please change it from the .env file and hit the below command in the root directory.
```php
    php builddb.php
```

## Google OAuth 2.0
Once the aforementioned procedures have been accomplished, it is time to configure Google-Calendar-API from the Google Console. You must establish a project in Google Console, select the Google Calendar API service, and setup the project for a web application, ensuring that "Authorized JavaScript origins" and "Authorized redirect URIs" are enabled. Once the application is created, update the client_id and client_secret values in your env file.


## Google service account
Also, build a service account under the same project that will supply you with a json file containing some information that we will require when connecting to the Google Calendar integration within our application.

Thank you for your time!