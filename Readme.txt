1 - Steps to create and initialize the database

First you need to have an instance of MySQL installed and running on your machine to initialize the database otherwise the application will not work.

If you do not have an instance of MySQL installed and configured on the machine, access the link (https://www.mysql.com/downloads/) and configure your MySQL server.

After installing MySQL oriento you install MySQL Workbench which is a graphical environment where it will be easier to administer your databases and run your MySQL scripts (program link: https://www.mysql.com/products/workbench/).

And after installing everything set up a database connection in the program (if you do not know how to do, it has a good tutorial here on YouTube taught, Link: https://www.youtube.com/watch?v=POcHaIwmAhw).

Well, assuming you've already installed everything that is required to incializar the database, then we'll run our database creation script.

Look at the root a file called "Creation script. sql" and open it in your MySQL instance Workbrench and run it.

---------------------------------------------------------------------------------------------------------------------------

2 - Steps to prepare the source code to build/run properly 

This application was made with the laralvel framework, so I assume you already have everything installed necessary to execute it.

If you do not, please go to the Framework documentation page and make sure that you have all the minimum prerequisites to run it (framework Link: https://laravel.com/)

Well, considering that all the minimum prerequisites are already satisfied so now we can start configuring our application for it to run normally in your local environment.

First you'll open the source folder, within it has several files, but only one of them that will really interest us, which is the .env file.

Open it and look for the following lines:


DB_CONNECTION = MySQL
DB_HOST = localhost
DB_PORT = 3306
DB_DATABASE = crossover
DB_USERNAME = root
DB_PASSWORD = root


You have to configure each of these variants according to the setting of your environment, example:


DB_CONNECTION = MySQL
DB_HOST = HERE_YOU_WILL_PUT_YOUR_HOST_NAME
DB_PORT = 3306 Here you will put your database connection PORT
DB_DATABASE = Crossover-> If you don't change the creation scripit it will be same
DB_USERNAME = YOUR_DATABASE_USERNAME
DB_PASSWORD = YOUR_DATABASE_PASSWORD

* Warning: It is only to modify the indicated lines *

After doing this, you can save the file can close it.

Open your command prompt and navigate to the source folder where you find the file we just changed (that is, to the folder /source ) then you will enter the following command:

php artisan serve

Done this, and all goes well, the message will appear:

Laravel Development Server started: <http://127.0.0.1:8000>

* Information: Depending on the environment you are this http://127.0.0.1:8000 address can be http://localhost:8000 you must open your browser and enter the address indicated at the command prompt. *

If you followed all the steps correctly, the application will be functioning normally.

Check the \wink folder that has a video presentation of the application running