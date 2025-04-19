<?php
// register.php
include 'header.php';
include 'includes/db_connect.php';
include 'includes/functions.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];
    $hashedPassword = hash_password($password);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        $success = display_success("Registration successful. Please login.");
    } else {
        $error = display_error("Error: " . $stmt->error);
    }

    $stmt->close();
}
?>

<div style="background-color: #fff; padding: 30px; margin: 20px auto; max-width: 500px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h2 style="color: rgb(143, 181, 248); text-align: center; margin-bottom: 20px;">Register</h2>

    <?php if ($error): ?>
        <p style="color: red; text-align: center;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color: green; text-align: center;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="username" style="display: block; margin-bottom: 5px;">Username:</label>
        <input type="text" name="username" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">

        <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
        <input type="email" name="email" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">

        <label for="password" style="display: block; margin-bottom: 5px;">Password:</label>
        <input type="password" name="password" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">

        <input type="submit" value="Register" style="background-color: rgb(255, 174, 201); color: #fff; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; width: 100%; transition: background-color 0.3s ease;">
    </form>
    <p style="text-align: center; margin-top:20px;">Already have an account? <a href="login.php">Login</a></p>
</div>

<?php
include 'footer.php';
?>