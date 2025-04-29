var darkmode = {
    elements: {
        html: 'html',
        navbar: '#navbar',
        mainContent: '#main-content',
        darkmodeToggle: '#darkmode-toggle'
    },
    classes: {
        lightTheme: 'theme-light',
        darkTheme: 'theme-dark',
        navbarLight: 'is-link',
        navbarDark: 'is-dark',
        mainContentLight: 'has-background-white-ter',
        mainContentDark: 'has-background-black-ter',
    },
    init: function() {
        // Check local storage for the theme preference
        const currentTheme = localStorage.getItem('theme') || darkmode.classes.lightTheme;
        $(darkmode.elements.html).attr('class', currentTheme);

        // Update the navbar and main content classes based on the theme
        darkmode.updateNavbarClass(currentTheme);
        darkmode.updateMainContentClass(currentTheme);
    },
    toggle: function() {
        const $html = $(darkmode.elements.html);
        const isDarkMode = $html.hasClass(darkmode.classes.darkTheme);

        // Toggle between light and dark themes
        if (isDarkMode) {
            $html.removeClass(darkmode.classes.darkTheme).addClass(darkmode.classes.lightTheme);
            localStorage.setItem('theme', darkmode.classes.lightTheme);
            darkmode.updateNavbarClass(darkmode.classes.lightTheme);
            darkmode.updateMainContentClass(darkmode.classes.lightTheme);
        } else {
            $html.removeClass(darkmode.classes.lightTheme).addClass(darkmode.classes.darkTheme);
            localStorage.setItem('theme', darkmode.classes.darkTheme);
            darkmode.updateNavbarClass(darkmode.classes.darkTheme);
            darkmode.updateMainContentClass(darkmode.classes.darkTheme);
        }
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
    }
};

// Initialize dark mode on page load
document.addEventListener('DOMContentLoaded', function() {
    darkmode.init();

    // Attach the toggle function to the button click
    document.querySelector(darkmode.elements.darkmodeToggle).addEventListener('click', function() {
        darkmode.toggle();
    });
});