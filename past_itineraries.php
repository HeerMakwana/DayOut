<?php
// past_itineraries.php
include 'header.php';
include 'includes/db_connect.php';
include 'includes/functions.php';
check_login();

$itineraries = get_user_itineraries($conn, $_SESSION['user_id']);
?>

<section class="about-hero" style="background: linear-gradient(135deg, var(--lilac) 0%, var(--pink) 100%);
    color: white;
    padding: 60px 20px;
    text-align: center;
    border-radius: 20px;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;">
    <div class="container">
        <h2 class="section-title" style="color: black;">Past Itineraries</h2>
        <?php if (empty($itineraries)): ?>
            <p style="text-align: center;">No past itineraries found.</p>
        <?php else: ?>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($itineraries as $itinerary): ?>
                    <li style="margin: 30px 30px 50px; border: 1px solid #ddd; padding: 25px; border-radius: 5px; background-color: rgba(97, 96, 96, 0.09);">
                        <strong style="display: block; margin-bottom: 5px; color: black; border-radius: 15px; padding: 2px,2px, 5px, 5px;"><?php echo $itinerary['location']; ?></strong>
                        <span style="display: block; margin-bottom: 10px;"><?php echo $itinerary['start_date']; ?> - <?php echo $itinerary['end_date']; ?></span>
                        <p style="white-space: pre-wrap;"><?php echo $itinerary['itinerary_text']; ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>


<?php
include 'footer.php';
?>