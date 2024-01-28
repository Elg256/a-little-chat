<?php
global $file;
$file = "messages.txt";

global $allowedTags;
$allowedTags = ["br", "h1", "h2", "ul", "ol", "li", "strong", "em", "p", "a", "img"];

global $maxMessageLength;
$maxMessageLength = 1000;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $message = $_POST["message"];

    if (!file_exists($file)) {
        touch($file);
    }

    if (!empty($message) && strlen($message) <= $maxMessageLength) {
        // Add the message to the file
        $messageToSave = nl2br(strip_tags($message, $allowedTags));
        file_put_contents($file,  date("Y-m-d H:i") . " : " . $messageToSave . PHP_EOL, FILE_APPEND);
    }

    // Redirect to the index page
    header("Location: index.php");
}

// Display the messages
if (file_exists($file)) {
    $lastMessageTime = isset($_GET['lastMessageTime']) ? $_GET['lastMessageTime'] : null;
    $fileContent = file_get_contents($file);
    $messages = explode(PHP_EOL, $fileContent);

    // Remove the last element of the array (empty element)
    array_pop($messages);
    $newMessages = [];
    foreach ($messages as $message) {
        $messageParts = explode(" : ", $message);
        $date = $messageParts[0];

        array_shift($messageParts);
        // Recreate the message
        $messageToDisplay = implode(" : ", $messageParts);
        if ($date > $lastMessageTime) {
            $newMessages[] = "<div class='sent-message'><span class='date'>$date</span><p>" . $messageToDisplay . "</p></div>";
        }
    }
    echo implode("", $newMessages);
}
?>