<?php
$message = "";
$suggestions = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidate = $_POST['candidate'];
    $interviewer = $_POST['interviewer'];
    $proposed_time = $_POST['proposed_time'];

    $dt = DateTime::createFromFormat('Y-m-d H:i:s', $proposed_time);

    if (!$dt) {
        $message = "<p style='color:red;'>Invalid date format. Use yyyy-mm-dd HH:MM:SS</p>";
    } else {
        $formatted_time = $dt->format('Y-m-d H:i:s');
        $safe_interviewer = escapeshellarg($interviewer);
        $safe_time = escapeshellarg($formatted_time);
        $safe_candidate = escapeshellarg($candidate);

        // Execute Python script to check for conflict and get suggestions
        $output = shell_exec("python ml_api/check_conflict.py $safe_interviewer $safe_time $safe_candidate");

        $result = json_decode($output, true);

        if ($result === null) {
            $message = "<p style='color:red;'>Error: Could not read Python output. Check script path or syntax.</p>";
        } elseif ($result["conflict"]) {
            $message = "<p style='color:red;'>Conflict with existing slot: " . $result["existing_slot"] . "</p>";
            $suggestions = $result["suggestions"];
        } else {
            $message = "<p style='color:green;'>Interview scheduled successfully at $formatted_time.</p>";

            $start_time = $formatted_time;
            $end_time = DateTime::createFromFormat('Y-m-d H:i:s', $start_time)->modify('+30 minutes')->format('Y-m-d H:i:s');
            $csvLine = "$interviewer,$candidate,$start_time,$end_time\n";
            file_put_contents("ml_api/historical_interviews.csv", $csvLine, FILE_APPEND);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Interview Scheduling</title>
    <link rel="stylesheet" href="ml_api/style.css">
</head>
<body>
<div class="container">
    <h2>Interview Scheduling</h2>
    <form method="post">
        <label>Candidate Name</label>
        <input type="text" name="candidate" required>

        <label>Interviewer Name</label>
        <input type="text" name="interviewer" required>

        <label>Proposed Time (yyyy-mm-dd HH:MM:SS)</label>
        <input type="text" name="proposed_time" required>

        <button type="submit">Schedule Interview</button>
    </form>

    <div class="message">
        <?php echo $message; ?>
    </div>

    <?php if (!empty($suggestions)): ?>
        <div class="suggestions">
            <h4>Suggested Available Time Slots:</h4>
            <ul>
                <?php foreach ($suggestions as $slot): ?>
                    <li><?php echo $slot['start'] . " to " . $slot['end']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
<?php
$message = "";
$suggestions = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidate = $_POST['candidate'];
    $interviewer = $_POST['interviewer'];
    $proposed_time = $_POST['proposed_time'];

    // Create DateTime object from the proposed time
    $dt = DateTime::createFromFormat('Y-m-d H:i:s', $proposed_time);

    if (!$dt) {
        $message = "<p style='color:red;'>Invalid date format. Use yyyy-mm-dd HH:MM:SS</p>";
    } else {
        $formatted_time = $dt->format('Y-m-d H:i:s');
        $safe_interviewer = escapeshellarg($interviewer);
        $safe_time = escapeshellarg($formatted_time);
        $safe_candidate = escapeshellarg($candidate);

        // Call Python script to check for conflicts
        $output = shell_exec("python ml_api/check_conflict.py $safe_interviewer $safe_time $safe_candidate");

        $result = json_decode($output, true);

        if ($result === null) {
            $message = "<p style='color:red;'>Error: Could not read Python output. Check script path or syntax.</p>";
        } elseif ($result["conflict"]) {
            $message = "<p style='color:red;'>Conflict with existing slot: " . $result["existing_slot"][0] . " to " . $result["existing_slot"][1] . "</p>";
            $suggestions = $result["suggestions"];
        } else {
            $message = "<p style='color:green;'>Interview scheduled successfully at $formatted_time.</p>";

            // Save the scheduled interview to the historical file
            $start_time = $formatted_time;
            $end_time = DateTime::createFromFormat('Y-m-d H:i:s', $start_time)->modify('+30 minutes')->format('Y-m-d H:i:s');
            $csvLine = "$interviewer,$candidate,$start_time,$end_time\n";
            file_put_contents("ml_api/historical_interviews.csv", $csvLine, FILE_APPEND);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Interview Scheduling</title>
    <link rel="stylesheet" href="ml_api/style.css">
</head>
<body>
<div class="container">
    <h2>Interview Scheduling</h2>
    <form method="post">
        <label>Candidate Name</label>
        <input type="text" name="candidate" required>

        <label>Interviewer Name</label>
        <input type="text" name="interviewer" required>

        <label>Proposed Time (yyyy-mm-dd HH:MM:SS)</label>
        <input type="text" name="proposed_time" required>

        <button type="submit">Schedule Interview</button>
    </form>

    <div class="message">
        <?php echo $message; ?>
    </div>

    <?php if (!empty($suggestions)): ?>
        <div class="suggestions">
            <h4>Suggested Available Time Slots:</h4>
            <ul>
                <?php foreach ($suggestions as $slot): ?>
                    <li><?php echo $slot['start'] . " to " . $slot['end']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
