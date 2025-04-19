
<?php
// home_content.php
require_once 'vendor/autoload.php';

use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

$apiKey = 'AIzaSyD_4VuSPIDP97NMTTJKNjMEunT53-0Ff0I'; 
$location = '';
$startDate = '';
$endDate = '';
$adults = '';
$children = '';
$budget = '';
$tripType = '';
$specialRequests = '';
$itinerary = '';
$error = '';
$success = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = sanitize_input($_POST['location']);
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $adults = sanitize_input($_POST['adults']);
    $children = sanitize_input($_POST['children']);
    $budget = sanitize_input($_POST['budget']);
    $tripType = sanitize_input($_POST['trip_type']);
    $specialRequests = sanitize_input($_POST['special_requests']);

    $prompt = "Create an itinerary for $location from $startDate to $endDate for $adults adults and $children children with an average budget of $budget INR. The trip type is $tripType. Special requests: $specialRequests.";

    try {
        $client = new Client($apiKey);
        $response = $client->generativeModel("gemini-1.5-pro")->generateContent(
            new TextPart($prompt)
        );
        $itinerary = $response->text();

        if (isset($_POST['save'])) {
            if (save_itinerary($conn, $_SESSION['user_id'], $location, $startDate, $endDate, $itinerary)) {
                $success = "Itinerary saved successfully!";
            } else {
                $error = "Error: Could not save itinerary.";
            }
        }

    } catch (Exception $e) {
        $error = display_error("Error: " . $e->getMessage());
    }
}
?>

<div class="itinerary-container" style="border-radius: 10px;">
    <h2 class="itinerary-title">Plan Your DayOut</h2>

    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($success) && $success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="post" class="itinerary-form">
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" required class="form-input">
        </div>

        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" required class="form-input">
        </div>

        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" required class="form-input">
        </div>

        <div class="form-group">
            <label for="adults">Number of Adults:</label>
            <input type="number" name="adults" min="1" value="1" required class="form-input">
        </div>

        <div class="form-group">
            <label for="children">Number of Children:</label>
            <input type="number" name="children" min="0" value="0" required class="form-input">
        </div>

        <div class="form-group">
            <label for="budget">Average Budget (INR):</label>
            <input type="number" name="budget" min="0" value="0" required class="form-input">
        </div>

        <div class="form-group">
            <label for="trip_type">Kind of Trip:</label>
            <select name="trip_type" required class="form-input">
                <option value="leisure">Leisure</option>
                <option value="adventure">Adventure</option>
                <option value="cultural">Cultural</option>
                <option value="business">Business</option>
            </select>
        </div>

        <div class="form-group">
            <label for="special_requests">Special Requests:</label>
            <textarea name="special_requests" class="form-textarea"></textarea>
        </div>

        <button type="submit" class="submit-btn">Generate Itinerary</button>
    </form>

    <?php if ($itinerary): ?>
        <div class="itinerary-results">
            <h2 class="itinerary-title">Your Itinerary</h2>
            <div class="itinerary-content"><?php echo nl2br(htmlspecialchars($itinerary)); ?></div>
            
            <form method="post" class="itinerary-actions">
                <input type="hidden" name="location" value="<?php echo htmlspecialchars($location); ?>">
                <input type="hidden" name="start_date" value="<?php echo htmlspecialchars($startDate); ?>">
                <input type="hidden" name="end_date" value="<?php echo htmlspecialchars($endDate); ?>">
                <input type="hidden" name="adults" value="<?php echo htmlspecialchars($adults); ?>">
                <input type="hidden" name="children" value="<?php echo htmlspecialchars($children); ?>">
                <input type="hidden" name="budget" value="<?php echo htmlspecialchars($budget); ?>">
                <input type="hidden" name="trip_type" value="<?php echo htmlspecialchars($tripType); ?>">
                <input type="hidden" name="special_requests" value="<?php echo htmlspecialchars($specialRequests); ?>">
                
                <button type="submit" name="regenerate" class="action-btn regenerate-btn">Regenerate Itinerary</button>
                <button type="submit" name="save" class="action-btn save-btn">Save Itinerary</button>
            </form>
        </div>
    <?php endif; ?>
</div>