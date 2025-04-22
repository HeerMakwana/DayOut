# DayOut Project Setup Instructions

## Downloading and Running the Project in XAMPP

1. **Install XAMPP:**
   - Download and install XAMPP from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).
   - Follow the installation instructions for your operating system.

2. **Download the Project:**
   - Download or clone the DayOut project repository to your local machine.

3. **Move Project to XAMPP htdocs Folder:**
   - Copy or move the entire DayOut project folder into the `htdocs` directory of your XAMPP installation.
     - For example, if XAMPP is installed in `C:\xampp`, place the project in `C:\xampp\htdocs\DayOut`.

4. **Start XAMPP Modules:**
   - Open the XAMPP Control Panel.
   - Start the **Apache** and **MySQL** modules.

5. **Access the Project in Browser:**
   - Open your web browser.
   - Navigate to [http://localhost/DayOut/landing.php](http://localhost/DayOut/landing.php) to access the project homepage.

---

## Database Connectivity with XAMPP

1. **Create the Database:**
   - Open phpMyAdmin by navigating to [http://localhost/phpmyadmin](http://localhost/phpmyadmin) in your browser.
   - Click on the "Databases" tab.
   - Create a new database named `dayout`.
   - Select the newly created `dayout` database.
   - Click on the "Import" tab.
   - Choose the `dayout.sql` file located in the project root directory.
   - Click "Go" to import the database schema and data.

2. **Configure Database Connection:**
   - Open the file `includes/db_connect.php`.
   - Update the following variables if needed:
     ```php
     $servername = "localhost"; // Usually localhost
     $username = "root";        // Your MySQL username (default is root)
     $password = "";            // Your MySQL password (default is empty)
     $dbname = "dayout";        // Database name created above
     ```
   - Save the file.

3. **Test Database Connection:**
   - Access any page that requires database connectivity (e.g., `register.php` or `login.php`).
   - If there are no connection errors, the database is connected successfully.

---

## Replacing API Key Placeholder

The project uses an API key for the GeminiAPI client in `home_content.php`.

1. **Locate the API Key:**
   - Open the file `home_content.php`.
   - Find the line:
     ```php
     $apiKey = '';
     ```

2. **Generate Your Own Gemini API Key:**
   - Visit the Gemini API provider's website at [https://developers.google.com/](https://developers.google.com/) or directly go to the Google Cloud Console Credentials page at [https://console.cloud.google.com/apis/credentials](https://console.cloud.google.com/apis/credentials).
   - Create a new project if you don't have one.
   - Enable the Gemini API or the relevant API service.
   - Navigate to the "Credentials" section and create a new API key.
   - Copy the generated API key.

3. **Replace with Your API Key:**
   - Replace the placeholder string in `home_content.php` with your actual API key, for example:
     ```php
     $apiKey = 'YOUR_ACTUAL_API_KEY_HERE';
     ```

4. **Save the File:**
   - Save the changes to `home_content.php`.

5. **Test API Integration:**
   - Use the itinerary planner form on the homepage to generate an itinerary.
   - If the API key is valid, the itinerary should be generated without errors.

---


## Additional Notes

- Ensure your XAMPP MySQL server is running before accessing the application.
- If you change the database credentials, update `includes/db_connect.php` accordingly.
- Keep your API key secure and do not expose it publicly.
- For any issues with database connection or API integration, check the PHP error logs and browser console for debugging.

---

This README provides the essential steps to download, set up the database, and configure the API key for the DayOut project. Follow these instructions carefully to get the application running smoothly.
