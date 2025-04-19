<?php
// contact_us_new.php
include 'header.php';
include 'includes/db_connect.php';
include 'includes/functions.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $message = sanitize_input($_POST['message']);

    if (add_contact_message($conn, $name, $email, $message)) {
        $success = display_success("Message sent successfully.");
    } else {
        $error = display_error("Error: Could not send message.");
    }
}
?>

<style>
    .contact-info {
        margin-top: 20px;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .map-container {
        margin-top: 20px;
    }
</style>

<div class="contact-form-container">
    <h2 class="contact-form-title" style="color: black;">Contact Us</h2>

    <?php if ($error): ?>
        <?php echo $error; ?>
    <?php endif; ?>

    <?php if ($success): ?>
        <?php echo $success; ?>
    <?php endif; ?>

    <form method="post" class="contact-form">
        <label for="name">Name:</label>
        <input type="text" name="name" required class="form-input">

        <label for="email">Email:</label>
        <input type="email" name="email" required class="form-input">

        <label for="message">Message:</label>
        <textarea name="message" required class="form-textarea"></textarea>

        <input type="submit" value="Send Message" class="submit-btn" >
    </form>
</div>

<div class="contact-info animate-slide-up">
    <h2 style="color: black;">Our Locations</h2>
    <p><strong>Headquarters:</strong> 123 Travel Street, New York, USA</p>
    <p><strong>Phone:</strong> +1 234 567 890</p>
    <p><strong>Email:</strong> support@dayout.com</p>
    <p><strong>Hours:</strong> Mon - Fri: 9:00 AM - 6:00 PM</p>

    <h2>Find Us on the Map</h2>
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3770.7927659956595!2d72.89735127520528!3d19.07284698213106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c627a20bcaa9%3A0xb2fd3bcfeac0052a!2sK.%20J.%20Somaiya%20College%20of%20Engineering!5e0!3m2!1sen!2sin!4v1744652425874!5m2!1sen!2sin" 
            width="100%" 
            height="300" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
</div>

<?php
include 'footer.php';
?>
