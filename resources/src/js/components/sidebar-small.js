var sidebarSmall = {
  

    showTooltip: function(event) {
        console.log('showTooltip triggered');
        const $target = $(event.currentTarget);
        const tooltipText = $target.data('tooltip');
        console.log('Tooltip text:', tooltipText);

        if (!tooltipText) {
            console.warn('No tooltip text found for this element.');
            return;
        }

        // Create tooltip element
        const $tooltip = $('<div class="floating-tooltip"></div>').text(tooltipText);
        $('body').append($tooltip);
        console.log('Tooltip element created and appended to body:', $tooltip);

        // Use Floating UI to position the tooltip
        const reference = $target[0];
        const floating = $tooltip[0];

        if (window.FloatingUIDOM) {
            console.log('FloatingUIDOM is loaded. Computing position...');
            window.FloatingUIDOM.computePosition(reference, floating, {
                placement: 'right',
                middleware: [
                    window.FloatingUIDOM.offset(8), // Add spacing
                    window.FloatingUIDOM.shift(),  // Prevent overflow
                ]
            }).then(({ x, y }) => {
                console.log('Tooltip position computed:', { x, y });
                $tooltip.css({
                    left: `${x}px`,
                    top: `${y}px`,
                    position: 'absolute',
                    zIndex: 1000,
                    opacity: 1,
                    transform: 'translateX(10px)', // Initial animation state
                    transition: 'opacity 0.2s ease, transform 0.2s ease',
                });
            }).catch(err => {
                console.error('Floating UI error:', err);
            });
        } else {
            console.error('FloatingUIDOM is not loaded.');
        }
    },

    hideTooltip: function(event) {
        console.log('hideTooltip triggered');
        const $tooltip = $('.floating-tooltip');
        if ($tooltip.length) {
            console.log('Tooltip found. Hiding it...');
            $tooltip.css({
                opacity: 0,
                transform: 'translateX(0px)', // Reverse animation
            });
            setTimeout(() => {
                console.log('Removing tooltip element...');
                $tooltip.remove();
            }, 200); // Remove after animation
        } else {
            console.warn('No tooltip found to hide.');
        }
    },

    init: function() {
        console.log('Initializing sidebarSmall...');
        const menuItems = $('.sidebar-small-item'); // Updated to use the unique class
        console.log('Menu items found:', menuItems.length);

        menuItems.hover(
            sidebarSmall.showTooltip, // Mouse enter
            sidebarSmall.hideTooltip  // Mouse leave
        );
    },
};

// Initialize the script when the DOM is ready
$(document).ready(function() {
    console.log('Document ready. Initializing sidebarSmall...');
    sidebarSmall.init();
});