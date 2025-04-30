var sidebarSmall = {
    init: function() {
        const menuItems = $('.menu-list a[data-tooltip]');
        menuItems.on('mouseenter', sidebarSmall.showTooltip);
        menuItems.on('mouseleave', sidebarSmall.hideTooltip);
    },

    showTooltip: function(event) {
        const $target = $(event.currentTarget);
        const tooltipText = $target.data('tooltip');
        if (!tooltipText) return;

        // Create tooltip element
        const $tooltip = $('<div class="floating-tooltip"></div>').text(tooltipText);
        $('body').append($tooltip);

        // Use Floating UI to position the tooltip
        const reference = $target[0];
        const floating = $tooltip[0];

        if (window.FloatingUIDOM) {
            window.FloatingUIDOM.computePosition(reference, floating, {
                placement: 'right',
                middleware: [
                    window.FloatingUIDOM.offset(8), // Add spacing
                    window.FloatingUIDOM.shift(),  // Prevent overflow
                ]
            }).then(({ x, y }) => {
                $tooltip.css({
                    left: `${x}px`,
                    top: `${y}px`,
                    position: 'absolute',
                    zIndex: 1000,
                    opacity: 1,
                    transform: 'translateX(10px)', // Initial animation state
                    transition: 'opacity 0.2s ease, transform 0.2s ease',
                });
            });
        }
    },

    hideTooltip: function(event) {
        const $tooltip = $('.floating-tooltip');
        if ($tooltip.length) {
            $tooltip.css({
                opacity: 0,
                transform: 'translateX(0px)', // Reverse animation
            });
            setTimeout(() => $tooltip.remove(), 200); // Remove after animation
        }
    }
};

// Initialize the script when the DOM is ready
$(document).ready(function() {
    sidebarSmall.init();

    console.log('Sidebar small initialized');
});