var login = {

    elements: {
        emailInput: '#email-address',
        passwordInput: '#password',
        loginButton: '#login-button',
        errorMessage: '#error-message',
        rememberMeCheckbox: '#remember-me'
    },

    processes : {

        loginProcess: function() { 
            var self = login;
            var email = $(self.elements.emailInput).val();
            var password = $(self.elements.passwordInput).val();
            var rememberMe = $(self.elements.rememberMeCheckbox).is(':checked');
            var loginUrl = base_url + 'account/login-account'; // Define the login URL

            $.ajax({ 
                url: loginUrl, 
                type: 'POST',
                data: {
                    email: email,
                    password: password,
                    rememberMe: rememberMe
                },
                success: function(response) {
                    // Handle successful login response
                    console.log('Login successful:', response);
                    self.processes.rememberMe(response.userData.email, response.userData.password); // Call rememberMe function

                    if ($(self.elements.errorMessage).hasClass('is-danger')) {
                        $(self.elements.errorMessage).removeClass('is-danger');
                    }
                    $(self.elements.errorMessage).addClass('is-success');
                    $(self.elements.errorMessage).text(response.message); // Clear any previous error message
                    setTimeout(function() {
                        // Redirect to the desired page after a successful login
                        window.location.href = base_url + 'roleplay/home'; // Change this to your desired URL
                    }
                    , 1000); // Redirect after 2 seconds
                },
                error: function(xhr, status, error,) {
                    // Extract the error message from the server response
                    var response = xhr.responseJSON || {}; // Parse JSON response if available
                    var errorMessage = response.message || 'Login failed. Please try again.';

                    // Display the error message in the error message element
                    if ($(self.elements.errorMessage).hasClass('is-success')) {
                        $(self.elements.errorMessage).removeClass('is-success');
                    }
                    $(self.elements.errorMessage).addClass('is-danger');
                    $(self.elements.errorMessage).text(errorMessage);
                }
            });

        },

        rememberMe: function(email, password) { 
            var self = login;
            var rememberMe = $(self.elements.rememberMeCheckbox).is(':checked');

            if (rememberMe) {
                // Logic to handle "Remember Me" functionality
                // Store email and password in local storage or cookies
                localStorage.setItem('rememberedEmail', email); 
                localStorage.setItem('rememberedPassword', password); // Uncomment if you want to remember the password too
                localStorage.setItem('rememberMe', rememberMe);
        
            } else {
                // Logic to clear "Remember Me" data
                localStorage.removeItem('rememberedEmail');
                localStorage.removeItem('rememberedPassword');
                localStorage.removeItem('rememberMe');
            }
        },
    },

    onload : {

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
                var loginbutton = self.elements.loginButton;
                $(loginbutton).on('click', function(event) {
                    event.preventDefault(); // Prevent the default form submission
                    self.processes.loginProcess();
                });
        },

        init: function() {
            var self = login;
            self.events.onLoginButtonClick();
        }

    },

    init: function() {
        var self = login;
        self.events.init();
        self.onload.getRememberedCredentials(); // Call the function to get remembered credentials
        // Additional initialization code can go here
    }
};

document.addEventListener('DOMContentLoaded', function() {
    login.init();
});