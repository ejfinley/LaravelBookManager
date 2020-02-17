# LaravelBookManager
This is basic CRUD application for handling books. 
This application is currently hosted on AWS at (ec2-18-225-6-7.us-east-2.compute.amazonaws.com "BookManager")

##Features
    1. Display a list of books
      ..1. This is the landing page for the application
      ..2. Books Can be sorted by Title our Author by clicking on the table header links. 
      ..3. The table is paginated into groups of five. You can change pages using th selecter to the bottom right of the table.
    2. Add a book to the list.
      ..1. Click "Add a Book" from the header
      ..2. Enter a string for both title and name
      ..3. Click "Add"
      ..4. The User is redirected to see all books
      ..5. The new book was Added
      ..6. The user sees a success book was added message
    3. Delete a book from the list
      ..1. From the list view
      ..2. Click the red trashcan button in a books entry
      ..3. The book is deleted from the list. 
      ..4. A success message is shown
    4. Change an authors name
      ..1. From the list view
      ..2. Click the blue Edit button in a books entry
      ..3. You are navigated to an edit page
      ..4. Input a new author
      ..5. You are redirected to list veiw and see the updated book.
      ..6. A success message is shown
    6. Search for a book by title or author
      ..1. Type a string into the search bar in the right of the navbar
      ..2. You are navigated to list veiw displaying only books whose title our author contain your search string.
    7. Export the the following in CSV and XML containing Title, Author, or both,
        1. Click the Export Data link in the header
        2. Select the format of the report and what data you want exported.
        3. The output is downloaded for the user.
        
##Running The project locally on Linux
    1. Install Php 
        ..1. In the command line run
        `yum install php72 php72-mysqlnd php72-imap php72-pecl-memcache php72-pecl-apcu php72-gd php72-mbstring -y`
    2. Install Git 
        ..1. In the command line run
        `yum install git -y`
    3. Clone this repository into your desired folder
        ..1. In the command line run
        `git clone https://github.com/ejfinley/LaravelBookManager.git`
    4. cd into the ___/LaravelBookManager/BookManager Directory. This is dependant on where you saved the project locally. 
    5. Install composer
        ..1. In the command line run
        `yum install wget -y`
        `wget https://getcomposer.org/composer.phar`
    6. Install the laravel packages
         ..1. In the command line run
        `php composer.phar install`
    7. Set up Mysql Server
        ..1. Download MySQL Workbench here (https://dev.mysql.com/downloads/workbench/)
        ..2. Select defaults for the installer
        ..3. Press the plus sign by MySQL Connections to create a new connection
        ..4. Create a user and password
        ..5. In the schemas box right click to create a new schema
        ..6. Name the schema bookmanager
        ..7. Create a schema named bookmanager_test for dusk testing.
    8. Create your .env files.  In the command line from /BookManager run
        ..1. Run `mv .env.example .env`
        ..2. update .env changing these feilds
            `DB_CONNECTION=mysql
             DB_HOST=127.0.0.1
             DB_PORT=3306
             DB_DATABASE=bookmanager
             DB_USERNAME=<YOUR DB USERNAME>
             DB_PASSWORD=<YOUR DB USERNAME>`
        ..3. Run `mv .env .env.dusk.local`
        ..4. Update .env.dusk.local with 
            `APP_URL=http://localhost:8000
             DB_CONNECTION=mysql
             DB_HOST=127.0.0.1
             DB_PORT=3306
             DB_DATABASE=bookmanager_test
             DB_USERNAME=<YOUR DB USERNAME>
             DB_PASSWORD=<YOUR DB USERNAME>`
    8. Migrate And seed the database  In the command line from /BookManager run
        ..1. php artisan migrate
        ..2. php artisan db:seed
    9. Run the appliplication.  In the command line from /BookManager run
        ..1. php artisan serve
        ..2. In a browser navigate to http://localhost:8000 

##Testing approach
    ###phpunit
    These test focus on testing the http endpoints. The test are stored in Bookmanager/app/tests/feature/BooksTest
    These test are run on an in memory sqlite database with faker data. 
    To run these test navigate to /BookManager in the command line and run  `./vendor/bin/phpunit`
    ###Dusk 
    These are the end to end test. They validate the functionality of the website and are stored in /app/tests/browser
    To run them first make sure you are not running the website. This could could cause damage to you database.
    Run `php artisan serve --env=dusk.local` from BookManager. This starts our website pointing at the test database. 
    Run `php artisan dusk` to run the test suite.  
    