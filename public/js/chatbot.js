document.addEventListener('DOMContentLoaded', () => {
    const bubble = document.getElementById('chatbot-bubble');
    const windowEl = document.getElementById('chatbot-window');
    const closeBtn = document.getElementById('chatbot-close');
    const sendBtn = document.getElementById('chatbot-send');
    const input = document.getElementById('chatbot-input');
    const messagesContainer = document.getElementById('chatbot-messages');

    if (!bubble || !windowEl) return;

    // Toggle Window
    bubble.addEventListener('click', () => {
        windowEl.style.display = windowEl.style.display === 'none' ? 'flex' : 'none';
        input.focus();
    });

    closeBtn.addEventListener('click', () => {
        windowEl.style.display = 'none';
    });

    // Send Logic
    const sendMessage = async () => {
        const text = input.value.trim();
        if (!text) return;

        // User Message UI
        appendMessage('user', text);
        input.value = '';

        // Typing Indicator
        const typingEl = appendMessage('scout', '<i class="fas fa-ellipsis-h fa-pulse"></i> Scout réfléchit...');
        
        try {
            const response = await fetch('/api/chatbot/ask', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: text })
            });

            const data = await response.json();
            typingEl.remove();

            if (data.response) {
                appendMessage('scout', data.response);
            } else {
                appendMessage('scout', "Oups, j'ai rencontré un problème technique.");
            }
        } catch (err) {
            typingEl.remove();
            appendMessage('scout', "Désolé, je n'arrive pas à me connecter au serveur.");
        }
    };

    const appendMessage = (sender, text) => {
        const msg = document.createElement('div');
        msg.style.padding = '10px 15px';
        msg.style.borderRadius = '12px';
        msg.style.fontSize = '0.85rem';
        msg.style.maxWidth = '85%';
        msg.style.lineHeight = '1.4';

        if (sender === 'user') {
            msg.style.background = 'rgba(255,255,255,0.1)';
            msg.style.color = 'white';
            msg.style.alignSelf = 'flex-end';
            msg.style.borderBottomRightRadius = '2px';
        } else {
            msg.style.background = 'rgba(59, 130, 246, 0.1)';
            msg.style.color = '#93c5fd';
            msg.style.alignSelf = 'flex-start';
            msg.style.borderBottomLeftRadius = '2px';
        }

        msg.innerHTML = text;
        messagesContainer.appendChild(msg);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        return msg;
    };

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage();
    });
});
