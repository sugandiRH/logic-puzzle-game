<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="wrapper">
        <form action="register_process.php" onsubmit="return registerValidation()" method="POST">
            <h1>Welcome Buddy</h1>

            <?php 
                if(isset($_SESSION['reg_error'])){
                    echo "
                    <div class='alert-box'>
                        <span class='close-btn' onclick='this.parentElement.style.display=\"none\";'>&times;</span>
                        <p>".$_SESSION['reg_error']."</p>
                    </div>";
                    unset($_SESSION['reg_error']);
                }
            ?>


            <div class="input-box">
                <input type="text" placeholder="User Name" required name="username">
                <i class='bx bxs-user'></i>
                <p class="error_msg" id= "name_error"></p>
            </div>
            <div class="input-box">
                <input type="number" placeholder="Age" required name="age">
                <i class='bx bxs-calendar' ></i>
                <p class="error_msg" id= "age_error"></p>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Enter Password" required name="password" id="passwordInput">
                <i class='bx bxs-lock-alt' role="button" tabindex="0" aria-label="Toggle password visibility" onclick="togglePassword()" style="cursor:pointer;"></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Confirm Password" required name="confirm_password">
                <i class='bx bxs-lock-alt'></i>
                <p class="error_msg" id= "pw_error"></p>
            </div>

            <button type="submit" class="btn">Register</button>
            <div class="login-link">
                <p>Already have an account? <a href="../loging_page/loginPG.html">Sign In</a> </p>
            </div>

        </form>
    </div>

    <script>
        function registerValidation() {
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
            const username = document.querySelector('input[name="username"]').value;
            const age = document.querySelector('input[name="age"]').value;

            if (username.length < 3 || username.length > 20) {
                document.getElementById('name_error').innerText = "Username must be between 3 and 20 characters.";
                return false;
            }

            if (age < 4 || age > 12) {
                document.getElementById('age_error').innerText = "Age should be 4-12.";
                return false;
            }
            
            let pwCondition = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
            if (!pwCondition.test(password)) {
                document.getElementById('pw_error').innerText = "Password must be at least 8 characters long and include letters, numbers, and special characters.";
                return false;
            }

            if (password !== confirmPassword) {
                document.getElementById('pw_error').innerText = "Passwords do not match!";
                return false;
            }
            return true;
        }

        function togglePassword() {
            const input = document.getElementById('passwordInput');
            if (!input) return;
            input.type = (input.type === 'password') ? 'text' : 'password';
        }

    </script>
</body>
</html>