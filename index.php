<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="chat-container" class="container">
        <div id="chat-messages">
            <?php
            $file = "messages.txt";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $message = $_POST["message"];

                if (!file_exists($file)) {
                    touch($file);
                }

                if (!empty($message)) {
                    // Ajouter le message au fichier
                    file_put_contents($file,  date("Y-m-d H:i") . " : " . $message . PHP_EOL, FILE_APPEND);
                }
                // Rediriger vers la page d'origine après l'ajout du message
                header("Location: index.php");
                exit(); // Assurer que le script s'arrête ici pour éviter toute exécution supplémentaire
            }

            // Afficher les messages après la soumission du formulaire ou lors du chargement initial
            if (file_exists($file)) {
                $fileContent = file_get_contents($file);
                // Vous pouvez également appliquer nl2br ici si nécessaire
                $messages = explode(PHP_EOL, $fileContent);

                // Remove the last element of the array (empty element)
                array_pop($messages);
                foreach ($messages as $message) {
                    $liste = explode(" : ", $message);
                    $date = $liste[0];
                    // Remove the date from the array
                    array_shift($liste);

                    // Rebuild the message
                    $message = implode(" : ", $liste);

                    // Add a <br> every 39 characters
                    $message = wordwrap($message, 39, "<br>", true);

                    echo "<div class='sent-message'>";
                    echo "<span class='date'>" . $date . "</span>";
                    echo "<p>" . $message . "</p>";
                    echo "</div>";
                }
            }
            ?>

        </div>
        <form action="index.php" method="post">
            <input type="text" name="message" placeholder="Type your message" autofocus >
            <button type="submit">Send</button>
        </form>
    </div>

    <div class="container">
        <form action="index.php" method="post">
            <button type="submit" id="ReloadButton">Reload</button>
        </form>
    </div>

	<script>
	
	document.addEventListener('DOMContentLoaded', function() {
            // Récupérer l'élément input
            var messageInput = document.getElementById('messageInput');

            // Mettre le focus à la fin du texte
            messageInput.focus();
            messageInput.setSelectionRange(messageInput.value.length, messageInput.value.length);
        });
	

        // Rediriger automatiquement vers le bas de la page après le chargement
        window.onload = function() {
            window.scrollTo(0, document.body.scrollHeight);
        };
		
	
    </script>
</body>
</html>
