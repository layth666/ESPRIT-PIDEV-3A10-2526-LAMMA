// Simple Word Predictor - Working Version
console.log('Word predictor loading...');

// Dictionary of words to suggest
const suggestionsList = {
    'bon': 'bonjour',
    'comm': 'comment', 
    'merc': 'merci',
    'sym': 'symfony',
    'doc': 'doctrine',
    'cont': 'controller',
    'ent': 'entity',
    'repo': 'repository',
    'art': 'article',
    'blo': 'blog',
    'ti': 'titre',
    'con': 'contenu'
};

// Get the last word typed
function getCurrentWord(text) {
    let words = text.split(' ');
    return words[words.length - 1];
}

// Find suggestion for a word
function getSuggestion(word) {
    if (word.length < 2) return null;
    
    let lowerWord = word.toLowerCase();
    
    for (let [prefix, suggestion] of Object.entries(suggestionsList)) {
        if (lowerWord.startsWith(prefix)) {
            return suggestion;
        }
    }
    return null;
}

// Insert suggestion into textarea
function insertSuggestion(textarea, suggestion) {
    let text = textarea.value;
    let words = text.split(' ');
    words.pop(); // Remove the incomplete word
    words.push(suggestion);
    textarea.value = words.join(' ') + ' ';
    
    // Hide suggestion box
    let box = document.getElementById('suggestionBox');
    if (box) box.style.display = 'none';
    
    textarea.focus();
}

// Show suggestion box
function showSuggestion(textarea, suggestion) {
    let box = document.getElementById('suggestionBox');
    
    if (!box) {
        box = document.createElement('div');
        box.id = 'suggestionBox';
        box.style.cssText = `
            position: absolute;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 8px 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            font-size: 13px;
            cursor: pointer;
            z-index: 9999;
            color: #f09000;
        `;
        document.body.appendChild(box);
    }
    
    // Position the box
    let rect = textarea.getBoundingClientRect();
    box.style.top = (rect.bottom + window.scrollY) + 'px';
    box.style.left = rect.left + 'px';
    box.innerHTML = '💡 Press Tab: <strong>' + suggestion + '</strong>';
    box.style.display = 'block';
    
    // Remove old event listener
    box.onclick = null;
    box.onclick = function() {
        insertSuggestion(textarea, suggestion);
    };
}

// Hide suggestion box
function hideSuggestion() {
    let box = document.getElementById('suggestionBox');
    if (box) box.style.display = 'none';
}

// Initialize predictor on a textarea
function setupPredictor(textarea) {
    if (!textarea) return;
    if (textarea.hasAttribute('data-predict-setup')) return;
    
    textarea.setAttribute('data-predict-setup', 'true');
    console.log('Setting up predictor for textarea');
    
    let typingTimer;
    
    textarea.addEventListener('input', function() {
        clearTimeout(typingTimer);
        
        typingTimer = setTimeout(() => {
            let text = this.value;
            let currentWord = getCurrentWord(text);
            let suggestion = getSuggestion(currentWord);
            
            if (suggestion) {
                showSuggestion(this, suggestion);
            } else {
                hideSuggestion();
            }
        }, 400);
    });
    
    textarea.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            let box = document.getElementById('suggestionBox');
            if (box && box.style.display === 'block') {
                e.preventDefault();
                let text = this.value;
                let currentWord = getCurrentWord(text);
                let suggestion = getSuggestion(currentWord);
                if (suggestion) {
                    insertSuggestion(this, suggestion);
                }
            }
        }
        
        if (e.key === 'Escape') {
            hideSuggestion();
        }
    });
    
    textarea.addEventListener('blur', () => {
        setTimeout(hideSuggestion, 200);
    });
}

// Setup all textareas when page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, looking for textareas...');
    
    let textareas = document.querySelectorAll('textarea');
    console.log('Found ' + textareas.length + ' textarea(s)');
    
    for (let textarea of textareas) {
        setupPredictor(textarea);
    }
});