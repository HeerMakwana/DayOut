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

<?php
include 'footer.php';
?>
