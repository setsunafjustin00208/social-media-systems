var darkmode = {
    elements: {
        html: 'html',
        navbar: '#navbar',
        mainContent: '#main-content',
        darkmodeToggle: '#darkmode-toggle',
        chatComponent: '#chat-componet',
        chatColumn: '.chat-column',
    },
    classes: {
        lightTheme: 'theme-light',
        darkTheme: 'theme-dark',
        navbarLight: 'is-light',
        navbarDark: 'is-dark',
        mainContentLight: 'has-background-white-ter',
        mainContentDark: 'has-background-black-ter',
        chatColumnLight: 'has-background-white-bis',
        chatColumnDark: 'has-background-grey-darker',
    },
    updateNavbarClass: function(theme) {
        const $navbar = $(darkmode.elements.navbar);
        if ($navbar.length) { // Check if the navbar exists
            if (theme === darkmode.classes.darkTheme) {
                $navbar.removeClass(darkmode.classes.navbarLight).addClass(darkmode.classes.navbarDark);
            } else {
                $navbar.removeClass(darkmode.classes.navbarDark).addClass(darkmode.classes.navbarLight);
            }
        }
    },
    updateMainContentClass: function(theme) {
        const $mainContent = $(darkmode.elements.mainContent);
        if ($mainContent.length) { // Check if the main content exists
            if (theme === darkmode.classes.darkTheme) {
                $mainContent.removeClass(darkmode.classes.mainContentLight).addClass(darkmode.classes.mainContentDark);
            } else {
                $mainContent.removeClass(darkmode.classes.mainContentDark).addClass(darkmode.classes.mainContentLight);
            }
        }
    },
    updateChatColumnClass: function(theme) {
        const $chatColumnClass = $(darkmode.elements.chatColumn);
        if ($chatColumnClass.length) { // Check if the main content exists
            if (theme === darkmode.classes.darkTheme) {
                $chatColumnClass.removeClass(darkmode.classes.chatColumnLight).addClass(darkmode.classes.chatColumnDark);
            } else {
                $chatColumnClass.removeClass(darkmode.classes.chatColumnDark).addClass(darkmode.classes.chatColumnLight);
            }
        }
    },
    updateChatComponentTheme: function(theme) {
        const $chatComponent = $(darkmode.elements.chatComponent);
        if ($chatComponent.length) { // Check if the chat component exists
            if (theme === darkmode.classes.darkTheme) {
                $chatComponent.css({
                    '--text-color': '#fff',
                    '--border-color': '#444',
                    '--header-background-color': '#3a3a3a',
                    '--button-background-color': '#444',
                    '--button-active-background-color': '#555',
                    '--button-hover-background-color': '#555',
                    '--icon-color': '#ccc',
                    '--hover-background-color': '#333',
                });
            } else {
                $chatComponent.css({
                    '--text-color': '#333',
                    '--border-color': '#ddd',
                    '--header-background-color': '#f5f5f5',
                    '--button-background-color': '#eaeaea',
                    '--button-active-background-color': '#4a4a4a',
                    '--button-hover-background-color': '#d4d4d4',
                    '--icon-color': '#4a4a4a',
                    '--hover-background-color': '#f5f5f5',
                });
            }
        }
    },

    events: {
        toggle: function() {
            const $html = $(darkmode.elements.html);
            const isDarkMode = $html.hasClass(darkmode.classes.darkTheme);
    
            // Toggle between light and dark themes
            if (isDarkMode) {
                $html.removeClass(darkmode.classes.darkTheme).addClass(darkmode.classes.lightTheme);
                localStorage.setItem('theme', darkmode.classes.lightTheme);
                darkmode.updateNavbarClass(darkmode.classes.lightTheme);
                darkmode.updateMainContentClass(darkmode.classes.lightTheme);
                darkmode.updateChatComponentTheme(darkmode.classes.lightTheme);
                darkmode.updateChatColumnClass(darkmode.classes.lightTheme);
            } else {
                $html.removeClass(darkmode.classes.lightTheme).addClass(darkmode.classes.darkTheme);
                localStorage.setItem('theme', darkmode.classes.darkTheme);
                darkmode.updateNavbarClass(darkmode.classes.darkTheme);
                darkmode.updateMainContentClass(darkmode.classes.darkTheme);
                darkmode.updateChatComponentTheme(darkmode.classes.darkTheme);
                darkmode.updateChatColumnClass(darkmode.classes.darkTheme);
            }
        },
    },

    init: function() {
        // Check local storage for the theme preference
        const currentTheme = localStorage.getItem('theme') || darkmode.classes.lightTheme;
        $(darkmode.elements.html).attr('class', currentTheme);

        // Update the navbar, main content, and chat component classes based on the theme
        darkmode.updateNavbarClass(currentTheme);
        darkmode.updateMainContentClass(currentTheme);
        darkmode.updateChatComponentTheme(currentTheme);
        darkmode.updateChatColumnClass(currentTheme);
    },
};

// Initialize dark mode on page load
$(document).ready(function() {
    darkmode.init();

    // Attach the toggle function to the button click
    $(darkmode.elements.darkmodeToggle).on('click', function() {
        darkmode.events.toggle();
    });
});