# maradock

A PHP web application focusing on a student's dashboard and commonly associated features in a web application. Created for an individual assignment.

## About The Project

This is an individual assignment for subject IMS566. 

Maradock is a comprehensive student dashboard that helps students manage their academic journey effectively. The application includes features such as assignment tracking, GPA calculation, and dynamic user interface elements.

### Built With

*   PHP
*   MySQL
*   HTML5
*   CSS3
*   JavaScript
*   Bootstrap 5
*   Font Awesome

## Features

*   Dynamic dark/light mode
*   Assignment management system
*   GPA calculator
*   Interactive UI elements
*   Responsive design
*   Animated sections
*   User authentication system

## Getting Started

To get a local copy up and running, follow these steps:

### Prerequisites

*   PHP 7.4 or higher
*   MySQL 5.7 or higher
*   Apache/Nginx web server
*   Web browser (Chrome, Firefox, Safari, etc.)

### Installation

1.  Ensure that the web server is running.
2.  Open phpMyAdmin and create a new database named `"unitest"`. Any other name should be fine, but for simplicity's sake, we are using the same name.
3.  Choose the newly created database. The database should be empty by default. In the options above (the one containing Structure, SQL, Export, Import, etc.), click on `Import`.
4.  Click on `Browse`, and navigate to the `maradock` folder.
5.  Choose `unitest.sql`. (Ensure that before importing, the SQL file is available and is not empty. Use any IDE to view the SQL file.)
6.  Scroll down and click `Import`.
7. After the import is successful, you should see all the tables and data in the new database in phpMyAdmin.

### Steps if the database import failed

The web application is heavily reliant on the database, therefore, if any error occurred during the importing process, please proceed with these necessary steps:

*   If the current database used for import is empty, proceed with the empty database. Else:
    *   Create a new database.
    *   Set up the database using the following SQL commands:
     
        ```sql
           -- Create users table
           CREATE TABLE users (
               id INT PRIMARY KEY AUTO_INCREMENT,
               username VARCHAR(50) UNIQUE NOT NULL,
               password VARCHAR(255) NOT NULL,
               email VARCHAR(100) UNIQUE NOT NULL,
               created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
           );

           -- Create assignments table
           CREATE TABLE assignments (
               id INT PRIMARY KEY AUTO_INCREMENT,
               user_id INT,
               title VARCHAR(100) NOT NULL,
               description TEXT,
               due_date DATE,
               priority VARCHAR(20),
               status VARCHAR(20),
               created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
               FOREIGN KEY (user_id) REFERENCES users(id)
           );

           -- Create grades table
           CREATE TABLE grades (
               id INT PRIMARY KEY AUTO_INCREMENT,
               user_id INT,
               course_name VARCHAR(100),
               credit_hours INT,
               grade VARCHAR(2),
               semester VARCHAR(50),
               FOREIGN KEY (user_id) REFERENCES users(id)
           );
        ```

3. Configure database connection.
    * Navigate to `config/db_connection.php`.
    * Update the database credentials:
      ```php
        $servername = "localhost"; 
        $username = "your username";
        $password = "your password";
        $dbname = "unitest";
      ```

## License

Distributed under the MIT License. See `LICENSE` for more information.

## Contact

Arfan Haziq - arfanhaziq33@gmail.com

Project Link: [https://github.com/puromed/maradock](https://github.com/puromed/maradock)

## Acknowledgements

*   [Bootstrap](https://getbootstrap.com)
*   [Font Awesome](https://fontawesome.com)
*   [ApexChartJS](https://apexcharts.com/)
