<?php
// register.php
include 'header.php';
include 'includes/db_connect.php';
include 'includes/functions.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $username = sanitize_input($_POST['username']);
        $email = sanitize_input($_POST['email']);
        $password = $_POST['password'];

        // Validation
        if (empty($username) || strlen($username) < 3) {
            throw new Exception("Username must be at least 3 characters long.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        if (strlen($password) < 6) {
            throw new Exception("Password must be at least 6 characters long.");
        }

        // Check if username or email already exists
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        if (!$checkStmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $checkStmt->bind_param("ss", $username, $email);
        $checkStmt->execute();
        $checkStmt->store_result();
        if ($checkStmt->num_rows > 0) {
            throw new Exception("Username or email already exists.");
        }
        $checkStmt->close();

        $hashedPassword = hash_password($password);

        if (!$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)")) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        if (!$stmt->bind_param("sss", $username, $email, $hashedPassword)) {
            throw new Exception("Bind param failed: " . $stmt->error);
        }

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $success = display_success("Registration successful. Please login.");
        $stmt->close();
    } catch (Exception $e) {
        $error = display_error("Registration error: " . $e->getMessage());
    }
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
