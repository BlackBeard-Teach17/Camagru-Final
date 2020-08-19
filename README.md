# Camagru
Is a simple web application that was developed using the technologies listed below.  The aim of camagru is to introduce the user to the fundamentals of web development through creating a simple instagram like web application.

## Technologies:
*PHP 7.0
*HTML
*CSS
*Vanilla Javascript
*AJAX
*Database:
    *MySQL
*Web server:
    *MAMP/WAMP/LAMP

## Installation Notes:
- Download PHP version 7.0(If you don't already have php installed but it should be installed with MAMP/LAMP/XAMP)
- Download and install the lastest version of LAMP(Linux)/XAMP(Windows)/MAMP(Mac Os)
- Clone the repo to in the  "HTDocs" folder located under the "XAMMP" folder on your C: drive. The file path is "C:\Bitnami\wamp{VERSION}\apache2\htdocs".
    i. Check if your servers are running(the apache server and mysql database engine).
- Run the Create Script(under Camagru\Configs\setup.php)
- Configure the mail function in the php.ini file (C:\Bitnami\wamp{VERSION}\php\php.ini-development or php.ini) for other operating systems this will be found in the installed      path (MAC OS is normally under Applications/Bitnami/LAMP{VERSION}/php/php.ini-development or php.ini).
   i.
    

## Project Features:
 *User login and registration
 *Password validation(checks in place to reject basic passwords like password or 123456)
 *Email verification( By sending confirmation email to users email)
 *Password Hashing(Storing encrypted passwords in the database)
 *Password Reset(Ability to change password by sending the reset link by email)
 * Ability to modify user details once logged in.
 *Logged in users can view, comment on and like images on the site. 
 *Logged in users can upload and edit photos(Images can be uploaded from local storage or taken via webcam)
 *User notifications for likes and comments.
