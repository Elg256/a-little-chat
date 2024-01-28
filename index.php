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
            <?php include 'getMessages.php'; ?>

        </div>
        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
            <input type="text" name="message" placeholder="Type your message" autofocus id="messageInput" >
            <button type="submit">Send</button>
        </form>
    </div>

    <div class="container">
        <form action="index.php" method="post">
            <button type="submit" id="ReloadButton">Reload</button>
        </form>
    </div>

	<script src="script.js"></script>
</body>
</html>
