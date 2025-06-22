<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "instagram_spam_detection";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

if (isset($_POST['image'])) {
    $imagePath = $_POST['image'];

    // Path fix: make absolute from relative
    $localPath = __DIR__ . '/' . $imagePath;

    if (!file_exists($localPath)) {
        echo "❌ Image not found: $localPath";
        exit;
    }

    // Run Tesseract
    $outputFile = tempnam(sys_get_temp_dir(), 'ocr_output');
    $cmd = "tesseract " . escapeshellarg($localPath) . " " . escapeshellarg($outputFile) . " -l eng";
    shell_exec($cmd);

    $extractedText = file_get_contents($outputFile . ".txt");
    unlink($outputFile . ".txt");

    $spamKeywords = ["win", "free", "offer", "click", "buy now", "subscribe", "cash", "limited", "prize"];
    $textLower = strtolower($extractedText);
    $isSpam = false;

    foreach ($spamKeywords as $keyword) {
        if (strpos($textLower, $keyword) !== false) {
            $isSpam = true;
            break;
        }
    }

    // Update DB (optional if you're storing spam status)
    $stmt = $conn->prepare("UPDATE posts SET spam_status = ? WHERE image = ?");
    $status = $isSpam ? 'SPAM' : 'CLEAN';
    $stmt->bind_param("ss", $status, $imagePath);
    $stmt->execute();

    echo $isSpam ? "⚠️ SPAM DETECTED in images!" : "✅ Image is clean.";
    echo $isSpam 
    ? "<div style='padding: 15px; background-color: #f44336; color: white; font-weight: bold;'>⚠️ SPAM DETECTED in image!</div>" 
    : "<div style='padding: 15px; background-color: #4CAF50; color: white; font-weight: bold;'>✅ Image is clean.</div>";
} else {
    echo "❗ No image received.";
}
?>
