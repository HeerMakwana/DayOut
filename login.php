<?php
// login.php
include 'header.php';
include 'includes/db_connect.php';
include 'includes/functions.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (verify_password($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: home.php");
            exit();
        } else {
            $error = display_error("Incorrect password.");
        }
    } else {
        $error = display_error("User not found.");
    }

    $stmt->close();
}
?>

<div style="background-color: #fff; padding: 30px; margin: 20px auto; max-width: 500px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h2 style="color: rgb(143, 181, 248); text-align: center; margin-bottom: 20px;">Login</h2>

    <?php if ($error): ?>
        <p style="color: red; text-align: center;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="username" style="display: block; margin-bottom: 5px;">Username:</label>
        <input type="text" name="username" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">

        <label for="password" style="display: block; margin-bottom: 5px;">Password:</label>
        <input type="password" name="password" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">

        <input type="submit" value="Login" style="background-color: rgb(255, 174, 201); color: #fff; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; width: 100%; transition: background-color 0.3s ease;">
    </form>
    <p style="text-align: center; margin-top:20px;">Don't have an account? <a href="register.php">Register</a></p>
</div>

<?php
include 'footer.php';
?>