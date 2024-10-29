$(document).ready(function() {
    $('#registerForm').submit(function(event) {
        event.preventDefault();
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();

        if (password !== confirmPassword) {
            $('#registerMessage').html("The passwords aren't the same!");
            return;
        }

        $.ajax({
            url: 'server.php',
            method: 'POST',
            data: {
                action: 'register',
                username: username,
                email: email,
                password: password
            },
            success: function(response) {
                $('#registerMessage').html(response);
                if (response === 'Registration successful!') {
                    window.location.href = 'index.html';
                }
            }
        });
    });

    $('#loginForm').submit(function(event) {
        event.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: 'server.php',
            method: 'POST',
            data: {
                action: 'login',
                email: email,
                password: password
            },
            success: function(response) {
                $('#loginMessage').html(response);
                if (response === 'Login successful!') {
                    window.location.href = 'profile.html';
                }
            }
        });
    });
});
