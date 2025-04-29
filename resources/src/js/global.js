var globalUtils = {
    // Initialize the global utilities

    // Function to set a cookie
    setCookie: function(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Convert days to milliseconds
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    },

    // Function to get a cookie
    getCookie: function(name) {
        const nameEQ = name + "=";
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i].trim();
            if (cookie.indexOf(nameEQ) === 0) {
                return cookie.substring(nameEQ.length, cookie.length);
            }
        }
        return null;
    },

    // Function to delete a cookie
    deleteCookie: function(name) {
        document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    },

    init: function() {
        console.log("Global utilities initialized.");
    },
};

// Initialize global utilities on page load
$(document).ready(function() {
    globalUtils.init();
});