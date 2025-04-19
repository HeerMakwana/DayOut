<?php
// functions.php

// Function to sanitize user inputs
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to check if user is logged in
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

// Function to hash passwords
function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Function to verify passwords
function verify_password($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

// Function to display error messages
function display_error($message) {
    return "<div style='color: red; margin: 10px 0;'>$message</div>";
}

// Function to display success messages
function display_success($message) {
    return "<div style='color: green; margin: 10px 0;'>$message</div>";
}

// Function to get user details by ID
function get_user_details($conn, $user_id) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }

    $stmt->close();
}

// Function to get user itineraries
function get_user_itineraries($conn, $user_id) {
    $stmt = $conn->prepare("SELECT * FROM itineraries WHERE user_id = ? ORDER BY saved_at DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }

    $stmt->close();
}

// Function to save itinerary to database
function save_itinerary($conn, $user_id, $location, $start_date, $end_date, $itinerary) {
    $stmt = $conn->prepare("INSERT INTO itineraries (user_id, location, start_date, end_date, itinerary_text) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $location, $start_date, $end_date, $itinerary);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }

    $stmt->close();
}

// Function to get contact messages from the database
function get_contact_messages($conn) {
    $stmt = $conn->prepare("SELECT * FROM contact_messages ORDER BY timestamp DESC");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }

    $stmt->close();
}

//Function to add contact message to database.
function add_contact_message($conn, $name, $email, $message) {
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }

    $stmt->close();
}

?>