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

function fetchMessages() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "getMessages.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var chatMessages = document.getElementById('chat-messages');
            var isScrolledToBottom = chatMessages.scrollHeight - chatMessages.clientHeight <= chatMessages.scrollTop + 1;
            chatMessages.innerHTML = xhr.responseText;
            // Scroll to the bottom only if already scrolled to the bottom before new messages arrived
            if (isScrolledToBottom) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }
    };
    xhr.send();
}

setInterval(fetchMessages, 5000);