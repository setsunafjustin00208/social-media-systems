var login = {
    elements: {
        emailInput: '#email-address',
        passwordInput: '#password',
        loginButton: '#login-button',
        errorMessage: '#error-message',
        rememberMeCheckbox: '#remember-me',
        emailIconRight: '#email-icon-right',
        passwordIconRight: '#password-icon-right',
    },

    processes: {
        loginProcess: function() {
            var self = login;
            var email = $(self.elements.emailInput).val();
            var password = $(self.elements.passwordInput).val();
            var rememberMe = $(self.elements.rememberMeCheckbox).is(':checked');
            var loginButton = $(self.elements.loginButton);
            var errorMessageElement = $(self.elements.errorMessage);

            var loginUrl = base_url + 'account/login-account';

            // Disable the button and clear previous error messages
            $(loginButton).prop('disabled', true).addClass('is-loading');
            $(errorMessageElement).text('');

            // Perform AJAX request
            $.ajax({
                url: loginUrl,
                type: 'POST',
                data: {
                    email: email,
                    password: password,
                    rememberMe: rememberMe
                },
                success: function(response) {
                    self.processes.handleLoginSuccess(response);
                },
                error: function(xhr) {
                    self.processes.handleLoginError(xhr);
                },
                complete: function() {
                    $(loginButton).prop('disabled', false).removeClass('is-loading');
                }
            });
        },

        handleLoginSuccess: function(response) {
            var self = login;
            var errorMessageElement = $(self.elements.errorMessage);

            // Save credentials if "Remember Me" is checked
            self.processes.rememberMe(response.userData.email, response.userData.password);

            // Display success message
            $(errorMessageElement).removeClass('is-danger').addClass('is-success');
            $(errorMessageElement).html('<span class="icon is-small has-text-success"><i class="fas fa-check-circle"></i></span> ' + response.message);

            // Redirect after a short delay
            setTimeout(function() {
                window.location.href = base_url + 'roleplay/home';
            }, 1000);
        },

        handleLoginError: function(xhr) {
            var self = login;
            var errorMessageElement = $(self.elements.errorMessage);

            // Extract error message from the server response
            var response = xhr.responseJSON || {};
            var errorMessage = response.message || 'Login failed. Please try again.';

            // Display error message
            $(errorMessageElement).removeClass('is-success').addClass('is-danger');
            $(errorMessageElement).html('<span class="icon is-small has-text-danger"><i class="fas fa-exclamation-triangle"></i></span> ' + errorMessage);
        },

        rememberMe: function(email, password) {
            var self = login;
            var rememberMe = $(self.elements.rememberMeCheckbox).is(':checked');

            if (rememberMe) {
                localStorage.setItem('rememberedEmail', email);
                localStorage.setItem('rememberedPassword', password);
                localStorage.setItem('rememberMe', rememberMe);
            } else {
                localStorage.removeItem('rememberedEmail');
                localStorage.removeItem('rememberedPassword');
                localStorage.removeItem('rememberMe');
            }
        },

        displayError: function(inputElement, message) {
            // Create or reuse an error tooltip element
            let tooltip = $(inputElement).next('.floating-error-tooltip');
            if (tooltip.length === 0) {
                tooltip = $('<div class="floating-error-tooltip"></div>');
                $(inputElement).after(tooltip);
            }
        
            // Set the error message with the icon
            tooltip.html(`
                <span class="icon is-large tooltip-icon">
                    <i class="fas fa-xmark fa-lg"></i>
                </span>
                <span class="tooltip-message">${message}</span>
            `);
            // Use Floating UI to position the tooltip
            const reference = inputElement[0];
            const floating = tooltip[0];
        
            if (window.FloatingUIDOM) {
                window.FloatingUIDOM.computePosition(reference, floating, {
                    placement: 'right',
                    middleware: [
                        window.FloatingUIDOM.offset(8), // Add some spacing
                        window.FloatingUIDOM.shift(),  // Prevent overflow
                        window.FloatingUIDOM.flip()    // Flip if there's no space
                    ]
                }).then(({ x, y }) => {
                    Object.assign(floating.style, {
                        left: `${x}px`,
                        top: `${y}px`,
                        position: 'absolute',
                        zIndex: 1000
                    });
                }).catch(err => {
                    console.error('Floating UI error:', err);
                });
            } else {
                console.error('FloatingUIDOM is not loaded.');
            }
        
            // Show the tooltip
            tooltip.addClass('is-visible');
        },
        
        hideError: function(inputElement) {
            const tooltip = $(inputElement).next('.floating-error-tooltip');
            if (tooltip.length > 0) {
                tooltip.removeClass('is-visible');
            }
        }
    },

    onload: {
        getRememberedCredentials: function() {
            var self = login;
            var rememberedEmail = localStorage.getItem('rememberedEmail');
            var rememberedPassword = localStorage.getItem('rememberedPassword');

            if (rememberedEmail) {
                $(self.elements.emailInput).val(rememberedEmail);
            }
            if (rememberedPassword) {
                $(self.elements.passwordInput).val(rememberedPassword);
            }

            if (localStorage.getItem('rememberMe') === 'true') {
                $(self.elements.rememberMeCheckbox).prop('checked', true);
            } else {
                $(self.elements.rememberMeCheckbox).prop('checked', false);
            }
        }
    },

    events: {
        onLoginButtonClick: function() {
            var self = login;
            $(self.elements.loginButton).on('click', function(event) {
                event.preventDefault();
                self.processes.loginProcess();
            });
        },

        onCheckTextInputBlur: function() {
            var self = login;
        
            var emailInput = $(self.elements.emailInput);
            var passwordInput = $(self.elements.passwordInput);
            var emailIconRight = $(self.elements.emailIconRight);
            var passwordIconRight = $(self.elements.passwordIconRight);
            var loginButton = $(self.elements.loginButton);
        
            // Function to check if both inputs are valid
            function validateForm() {
                const isEmailValid = $(emailInput).val().trim() !== '';
                const isPasswordValid = $(passwordInput).val().trim() !== '';
                if (isEmailValid && isPasswordValid) {
                    loginButton.prop('disabled', false); // Enable the button
                } else {
                    loginButton.prop('disabled', true); // Disable the button
                }
            }
        
            // Validate email input on blur
            $(emailInput).on('blur', function() {
                if ($(emailInput).val().trim() === '') {
                    $(emailInput).addClass('is-danger');
                    $(emailIconRight).addClass('fa-square-xmark');
                    self.processes.displayError(emailInput, 'Required.');
                } else {
                    $(emailInput).removeClass('is-danger');
                    $(emailIconRight).removeClass('fa-square-xmark');
                    self.processes.hideError(emailInput);
                }
                validateForm(); // Check form validity
            });
        
            // Validate password input on blur
            $(passwordInput).on('blur', function() {
                if ($(passwordInput).val().trim() === '') {
                    $(passwordInput).addClass('is-danger');
                    $(passwordIconRight).addClass('fa-square-xmark');
                    self.processes.displayError(passwordInput, 'Required.');
                } else {
                    $(passwordInput).removeClass('is-danger');
                    $(passwordIconRight).removeClass('fa-square-xmark');
                    self.processes.hideError(passwordInput);
                }
                validateForm(); // Check form validity
            });
        
            // Initial validation check
            validateForm();
        },

        init: function() {
            var self = login;
            self.events.onLoginButtonClick();
            self.events.onCheckTextInputBlur();
        }
    },

    init: function() {
        var self = login;
        self.events.init();
        self.onload.getRememberedCredentials();
    }
};

document.addEventListener('DOMContentLoaded', function() {
    login.init();
});