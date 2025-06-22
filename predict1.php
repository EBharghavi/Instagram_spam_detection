<?php
// Include DB connection
include 'db.php';

$tesseractPath = 'C:\\Program Files\\Tesseract-OCR\\tesseract.exe';
// Step 1: Run OCR using Tesseract
$imagePath = 'images/post.jpg';

$outputFile = 'output';

// Execute Tesseract OCR command
exec("tesseract $imagePath $outputFile");

// Step 2: Read extracted text
$extractedText = file_get_contents($outputFile . '.txt');

// Step 3: Load spam words from CSV
$spamWords = [];
if (($handle = fopen("spam_data.csv", "r")) !== false) {
    // Skip the header row
    fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== false) {
        $spamWords[] = strtolower(trim($data[0]));  // Assuming spam word is in column 0
    }
    fclose($handle);
}

// Step 4: Check for spam
$isSpam = false;
foreach ($spamWords as $word) {
    if (stripos($extractedText, $word) !== false) {
        $isSpam = true;
        break;
    }
}

// Prepare result message
$message = $isSpam ? "⚠️ This post is SPAM!" : "✅ This post is NOT spam.";

// Insert result into the database
$imageName = 'post1.jpg'; // or dynamically get it if needed
$result = $isSpam ? 'spam' : 'not spam';
$sql = "INSERT INTO image_scan_results (image_name, result) VALUES ('$imageName', '$result')";
$conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spam Detection Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('home.php'); /* Use home.php as background */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .result-container {
            background: rgba(248, 247, 247, 0.74); /* Semi-transparent white */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 300px;
            text-align: center;
        }
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            color: #333;
            font-weight: bold;
            background-color: <?php echo $isSpam ? '#f44336' : '#4CAF50'; ?>; /* Red for spam, green for clean */
            color: white;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #0095f6;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h2>Spam Check Result</h2>
        <div class="message"><?php echo $message; ?></div>
        <a href="home.php">OK</a>
    </div>
</body>
</html> 