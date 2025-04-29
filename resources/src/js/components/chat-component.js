var chatComponent = {
    init: function() {
        // Listen for tab change events
        $('#chat-component').on('tabChange', function(event, tab) {
            console.log('Tab changed to:', tab);
            // You can add additional logic here if needed
        });
    }
};

// Initialize the chat component on page load
$(document).ready(function() {
    chatComponent.init();
});