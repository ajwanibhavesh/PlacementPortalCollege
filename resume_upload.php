<?php
    // resume_upload.php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['resume'])) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_name = basename($_FILES['resume']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['resume']['tmp_name'], $target_file)) {
            header("Location: process_resume.php?file=" . urlencode($file_name));
            exit();
        } else {
            echo "Error uploading file.";
        }
    }
    ?>
    
    <form action="resume_upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="resume" required>
        <button type="submit">Upload Resume</button>
    </form>
    
    <?php