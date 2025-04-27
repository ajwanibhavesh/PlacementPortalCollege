<?php
$output = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $interview_time = $_POST["interview_time"];
    $interviewer = $_POST["interviewer"];
    $candidate = isset($_POST["candidate"]) ? $_POST["candidate"] : "";


    $datetime = date('Y-m-d H:i:s', strtotime($interview_time));
    $date = date('Y-m-d', strtotime($datetime));
    $time = date('H:i:s', strtotime($datetime));

    $command = escapeshellcmd("python C:\\xampp\\htdocs\\PlacementPortalCollege\\ml_api\\predict_conflict.py \"$date\" \"$time\" \"$interviewer\"");
    $output = trim(shell_exec($command));

    if (strpos($output, "Interview Scheduled Successfully") !== false) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Interview Conflict Checker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 6px;
            font-weight: bold;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Check Interview Conflict</h2>
        <form method="post">
            <label for="candidate">Candidate Name:</label>
            <input type="text" name="candidate" required>

            <label for="interview_time">Interview Date & Time:</label>
            <input type="datetime-local" name="interview_time" required>

            <label for="interviewer">Interviewer Name:</label>
            <input type="text" name="interviewer" required>

            <button type="submit">Check Conflict</button>
        </form>

        <?php if (!empty($output)): ?>
            <div class="result <?= $success ? 'success' : 'error' ?>">
                <?= htmlspecialchars($output) ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
