var chatComponent = {
    elements: {
        chatColumn: '.chat-column',
        hideChatButton: '.hide-chat-button',
        showChatButton: '.show-chat-button',
    },

    processes: {
        // Load the initial visibility state from cookies
        loadChatVisibility: function() {
            const isChatVisible = globalUtils.getCookie('isChatVisible') === 'true' || globalUtils.getCookie('isChatVisible') === null;

            if (!isChatVisible) {
                $(chatComponent.elements.chatColumn).hide();
                $(chatComponent.elements.showChatButton).show();
            } else {
                $(chatComponent.elements.chatColumn).show();
                $(chatComponent.elements.showChatButton).hide();
            }
        },

        // Save the visibility state to cookies
        saveChatVisibility: function(isVisible) {
            globalUtils.setCookie('isChatVisible', isVisible, 7); // Save state in a cookie for 7 days
        }
    },

    events: {
        // Handle the "Hide Chat" button click
        onHideChatButtonClick: function() {
            $(chatComponent.elements.hideChatButton).on('click', function() {
                $(chatComponent.elements.chatColumn).hide();
                $(chatComponent.elements.showChatButton).show();
                chatComponent.processes.saveChatVisibility(false);
            });
        },

        // Handle the "Show Chat" button click
        onShowChatButtonClick: function() {
            $(chatComponent.elements.showChatButton).on('click', function() {
                $(chatComponent.elements.chatColumn).show();
                $(chatComponent.elements.showChatButton).hide();
                chatComponent.processes.saveChatVisibility(true);
            });
        },

        init: function() {
            chatComponent.events.onHideChatButtonClick();
            chatComponent.events.onShowChatButtonClick();
        }
    },

    init: function() {
        chatComponent.processes.loadChatVisibility(); // Load the initial visibility state
        chatComponent.events.init(); // Initialize event listeners
    }
};

// Initialize the chat component on page load
$(document).ready(function() {
    chatComponent.init();
});