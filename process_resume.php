require 'vendor/autoload.php';
    use Smalot\PdfParser\Parser;
    
    if (isset($_GET['file'])) {
        $file_path = 'uploads/' . $_GET['file'];
        if (file_exists($file_path)) {
            $parser = new Parser();
            $pdf = $parser->parseFile($file_path);
            $text = $pdf->getText();
            
            $api_key = 'YOUR_GEMINI_API_KEY';
            $url = 'https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateText?key=' . $api_key;
            $data = json_encode(["prompt" => "Format the following resume text into structured JSON: " . $text]);
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            $formatted_data = json_decode($response, true);
            file_put_contents('uploads/formatted_resume.json', json_encode($formatted_data, JSON_PRETTY_PRINT));
            
            header("Location: display_resume.php");
            exit();
        } else {
            echo "File not found.";
        }
    }
    ?>
    