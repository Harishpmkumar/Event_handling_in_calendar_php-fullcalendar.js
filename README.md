# Event Handling in Calendar using PHP & Full-Calendar.js

This project demonstrates an event handling calendar application using PHP and FullCalendar.js. The application allows users to create, edit, and delete events in a calendar, and also view detailed information about events.

## Table of Contents

- [Features](#features)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Technologies](#technologies)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Contributing](#contributing)
- [License](#license)

## Features

- Display a calendar with events using FullCalendar.js.
- Add new events through a modal form.
- Edit existing events through a modal form.
- Delete events.
- View event details in a modal.
- Persist events in a MySQL database using PHP scripts.

## Usage

- **View Calendar**: Access the web application through your browser. You should see a calendar displaying any existing events.
- **Add Event**: Click the "Add Event" button to open the modal form. Fill in the event details and submit the form.
- **Edit Event**: Click on an event in the calendar to open the event details modal. Click the "Edit" button to open the edit form.
- **Delete Event**: Click on an event in the calendar to open the event details modal. Click the "Delete" button to remove the event.
- **View Event Details**: Click on an event in the calendar to view its details in a modal.

## Project Structure

- `index.html`: The main HTML file containing the calendar and modal forms.
- `script.js`: JavaScript file for handling calendar events and interactions.
- `style.css`: CSS file for styling the calendar and modals.
- `config.php`: PHP file containing database connection settings.
- `fetch_events.php`: PHP script for fetching events from the database.
- `add_event.php`: PHP script for adding new events to the database.
- `edit_event.php`: PHP script for editing existing events in the database.
- `delete_event.php`: PHP script for deleting events from the database.
- `README.md`: This README file.

## Technologies

- **FullCalendar.js**: JavaScript library for creating interactive calendars.
- **Bootstrap**: CSS framework for responsive web design and styling.
- **PHP**: Server-side scripting language for handling database operations.
- **MySQL**: Database server for storing event data.
- **jQuery**: JavaScript library for DOM manipulation and AJAX requests.

<h2>How to run the project</h2>

## Prerequisites

<ul>
  <li>Xampp</li>
  
  <li>HTML</li>
  
  <li>CSS</li>
  
  <li>JS</li>
  
  <li>Full-Calendar.js</li>
  
  <li>Bootstrap5</li>
  
  <li>Jquery</li>
  
  <li>PHP</li>
  
  <li>MySQL</li>
  
  <li>phpmyadmin</li>
</ul>

## Installation

<b>Step 1 : Download and unzip this project repository in your <i>"xampp → htdocs"</i> folder.</b>

<b>Step 2 : Start Apache and MySQL in Xampp control panel. 

![Screenshot 2024-02-04 125411](https://github.com/Harishpmkumar/Portfolio_PHP_project/assets/94518989/ae1aabcd-7346-4831-b2fb-13ee331d6e77)

<b>Step 3 : Type <i>“localhost/phpmyadmin”</i> in your browser, it will open the phpmyadmin panel.</b>

![Screenshot 2024-02-04 130333](https://github.com/Harishpmkumar/Portfolio_PHP_project/assets/94518989/f4f6c1db-f6db-461a-aa03-371825f25b90)

<b>Step 4 : Create a username, password for phpmyadmin access and create a database and table (create a table with name “crud“ and fields of id(primary key, int), email(varchar), password(varchar). If you dont know to create then refer this link. </b>
<ul>
<li><b>Create username and password - </b><a href="https://www.webserver.com.my/kb/creating-user-accounts-in-phpmyadmin/">Click !</a></li>

<li><b>Create database and table - </b><a href="https://www.geeksforgeeks.org/how-to-create-a-new-database-in-phpmyadmin/">Click !</a></li>
</ul>

Note:- Make sure your table structure looks like below

![Screenshot_2024-04-13_14-56-10](https://github.com/Harishpmkumar/Event_handling_in_calendar_php-fullcalendar.js/assets/94518989/1d932eb0-bbf5-44db-8d31-5515808f0cc5)


<b>Step 5 : Open the project folder in your code editor. I prefer vscode for code editing.</b>

![Screenshot (5)](https://github.com/Harishpmkumar/php_ajax_crud_project/assets/94518989/390676a4-844e-4e69-89cf-8ed9a9aac42d)


<b>Step 6 : Open <i>“config.php”</i> file and change your username, password and database in the file.</b>

 ![Screenshot (6)](https://github.com/Harishpmkumar/php_ajax_crud_project/assets/94518989/fbfde0ea-b9ad-4404-a580-1dd2dae9706e)


🎊🥂🎉  All the configuration is over  🎊🥂🎉

<b>Step 7 : Go to your browser, then type <i>“[localhost/php-event-handling](http://localhost/php-event-handling/index.php)”</i>.</b>




