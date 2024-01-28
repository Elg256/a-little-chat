<?php
global $file;
$file = "messages.txt";

global $allowedTags;
$allowedTags = ["br", "h1", "h2", "ul", "ol", "li", "strong", "em", "p", "a", "img", "video"];

global $maxMessageLength;
$maxMessageLength = 1000;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $message = $_POST["message"];
    $pseudo = $_POST["pseudo"];
    if ($pseudo == "") {
        $pseudo = "Anonyme";
    } else {
        setcookie("pseudo", $pseudo, time() + (60 * 60 * 24 * 30), "/"); // 30 days
    }

    if (!file_exists($file)) {
        touch($file);
    }

    if (!empty($message) && strlen($message) <= $maxMessageLength) {
        // Add the message to the file
        $messageToSave = nl2br(strip_tags($message, $allowedTags));
        $pseudoToSave = nl2br(strip_tags($pseudo, $allowedTags));
        file_put_contents($file,  date("Y-m-d H:i") . " : " . $pseudo . " : " . $messageToSave . PHP_EOL, FILE_APPEND);
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

        if (count($messageParts) > 1) {
            $pseudo = $messageParts[0];
            array_shift($messageParts);
        } else {
            $pseudo = "Anonyme";
        }
        // Recreate the message
        $messageToDisplay = implode(" : ", $messageParts);
        if ($date > $lastMessageTime) {
            $newMessages[] = "<div class='sent-message'><span class='date'>$date</span> <span class='pseudo'>$pseudo</span><p>" . $messageToDisplay . "</p></div>";
        }
    }
    echo implode("", $newMessages);
}
?>