Hackers Poulette
Hackers Poulette is a web application designed to allow users to register with their email, generate a password, and submit additional information along with an optional image upload. This README provides an overview of the project structure, installation instructions, and usage guide.

Project Structure
index.php: The main PHP file containing the form and server-side logic for user registration, password generation, and database interaction.
pds_captcha.php: PHP script for generating CAPTCHA images.
email-pwd.php: PHP script for sending emails with generated passwords.
image.php: PHP script for generating random images (for demonstration purposes).
vendor/: Directory containing Composer dependencies, including the PHPMailer library.
script.js: JavaScript file for client-side validation (not currently implemented in the project).
style.css: CSS file for styling the HTML elements.
Installation
To run the project locally, follow these steps:

Clone the repository to your local machine:

bash
Copy code
git clone https://github.com/your-username/hackers-poulette.git
Ensure you have PHP installed on your system. You may also need to install Composer for managing dependencies.

Navigate to the project directory and run Composer to install dependencies:

bash
Copy code
cd hackers-poulette
composer install
Set up a local web server (e.g., Apache or Nginx) to serve the PHP files. You can use tools like XAMPP or WAMP for a quick setup.

Configure your local environment variables, such as the database connection details and SMTP server settings, in the appropriate PHP files.

Access the project in your web browser by visiting http://localhost/hackers-poulette (or the appropriate URL based on your local server configuration).

Usage
Open the project in a web browser.
Fill out the registration form with your email and other details.
If prompted, complete the CAPTCHA challenge.
If required, enter the generated password received via email.
Submit the form to register your information in the database.
Optionally, upload an image of your choice.
View the confirmation message and any uploaded images.
Live Demo
You can view the live demo of this project here.