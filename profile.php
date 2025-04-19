<?php
// profile.php
include 'header.php';
include 'includes/db_connect.php';
include 'includes/functions.php';
check_login();

$user = get_user_details($conn, $_SESSION['user_id']);
?>

<div class="profile-container" style=" background: linear-gradient(135deg, var(--lilac) 0%, var(--pink) 100%);
    color: white;
    padding: 60px 20px;
    text-align: center;
    border-radius: 20px;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;">
    <h2 class="profile-title" style="color: black;">Profile</h2>

    <?php if ($user): ?>
        <p class="profile-detail"><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p class="profile-detail"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p class="profile-detail"><strong>Member Since:</strong> <?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
    <?php else: ?>
        <p class="profile-detail">User details not found.</p>
    <?php endif; ?>

    <div class="profile-action">
        <a href="past_itineraries.php" class="profile-button">View Past Itineraries</a>
    </div>
</div>

<?php
include 'footer.php';
?>
