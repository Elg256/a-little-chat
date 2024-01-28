<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/ico" href="logo_chat.png" />
    <title>Group Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="chat-container" class="container">
        <div id="chat-messages">
            <?php include 'getMessages.php'; ?>

        </div>
        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
            <input type="text" name="message" placeholder="Type your message" autofocus id="messageInput" >
            <input type="text" name="pseudo" placeholder="Entrez votre pseudo" id="pseudoInput" value="<?php echo isset($_COOKIE['pseudo']) ? htmlspecialchars($_COOKIE['pseudo']) : ''; ?>">
            <button type="submit">Send</button>
        </form>
    </div>

	<div class="container">
	
	
    <!-- Utilisez une balise label pour styliser le bouton -->
    <input type="checkbox" id="menu-checkbox">
    <label for="menu-checkbox" class="menu-label">Menu</label>

    <div class="dropdown">
        <div class="dropdown-content">
			<a href="http://stfrancois.alwaysdata.net/index.php#">Tous le monde</a>
            <a href="http://stfrancoisterminal.alwaysdata.net/index.php#">Terminal</a>
            <a href="http://stfrancois-premiere.alwaysdata.net/index.php">Première</a>
            <a href="http://stfrancois-seconde.alwaysdata.net/index.php">Seconde</a>
            <!-- Ajoutez plus de liens au besoin -->
        </div>
    </div>
	
	
</div>

	<script src="script.js"></script>
</body>
</html>
