<?php
    // display_resume.php
    $json_file = 'uploads/formatted_resume.json';
    if (file_exists($json_file)) {
        $resume_data = json_decode(file_get_contents($json_file), true);
        echo "<h1>Formatted Resume</h1>";
        echo "<p><strong>Name:</strong> " . $resume_data['name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $resume_data['email'] . "</p>";
        echo "<p><strong>Phone:</strong> " . $resume_data['phone'] . "</p>";
        echo "<h2>Skills</h2><ul>";
        foreach ($resume_data['skills'] as $skill) {
            echo "<li>$skill</li>";
        }
        echo "</ul><h2>Experience</h2><p>" . $resume_data['experience'] . "</p>";
        echo "<h2>Education</h2><p>" . $resume_data['education'] . "</p>";
    } else {
        echo "No formatted resume found.";
    }
    ?>