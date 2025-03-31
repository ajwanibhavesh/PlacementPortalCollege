<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Placement PDF</title>
</head>
<body>
    <h2>Upload Placement Statistics PDF</h2>
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="pdf_file" accept=".pdf" required>
        <button type="submit">Upload & Analyze</button>
    </form>
</body>
</html>
