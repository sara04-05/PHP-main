<?php include_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sign Up</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  
<style>
		
* {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
}

body {
    margin: 0;
    background-image: url(pics/bg.png);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    font-family: Arial, sans-serif;
}

.section2 {
    display: flex;
    justify-content: center;   
    align-items: center;
    min-height: 100vh;
    padding: 2rem;
}

.SignUp {
    background: rgba(255, 255, 255, 0.1); 
    backdrop-filter: blur(15px);           
    -webkit-backdrop-filter: blur(15px);   
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 1.2rem 2rem;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
}

.logo {
    display: block;
    margin: 0 auto 1.5rem;
    max-width: 130px;
    border-radius: 50%;
}

.Sign {
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    color: #fff;
    margin-bottom: 0.5rem;
}

.brand {
    color: #1db954;
}

.detail {
    text-align: center;
    color: #ddd;
    margin-bottom: 2rem;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

.forma {
    display: flex;
    flex-direction: column;
    gap: 1oopx;
}

label {
    font-size: 0.95rem;
    margin-bottom: 0.3rem;
    color: #fff;
    text-align: center;
}

input[type="email"],
input[type="password"],
input[type='username'] {
    padding: 0.75rem;
    border-radius: 6px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background-color: rgba(0, 0, 0, 0.4);
    color: #f1f1f1;
    font-size: 1rem;
    outline: none;
}
input[type='name'],
input[type='surname'] { 
    padding: 14px;
    border-radius: 6px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background-color: rgba(0, 0, 0, 0.4);
    color: #f1f1f1;
    font-size: 0.9rem;
    outline: none;
    width: 100%;
}

input[type="text"] {
    padding: 0.75rem;
    border-radius: 6px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background-color: rgba(0, 0, 0, 0.4);
    color: #f1f1f1;
    font-size: 1rem;
    outline: none;
}

input::placeholder {
    color: #bbb;
}

#email_error,
#password_error {
    display: none;
    color: red;
    font-size: 12px;
    text-align: left;
    margin-top: 4px;
}

button {
    padding: 0.75rem;
    background-color: #0c7230ff;
    color: white;
    font-size: 1rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0c723080;
}

a {
    color: #ffffffff;
    text-align: center;
}
p {
    color: #ffffffff;
    text-align: center;
    font-size: 0.9rem;  }

.name-row {
    display: flex;
    gap: 8px;
    width: 100%;
    margin-bottom: 5px;
}

.name-col {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

input[type="email"]:focus,
input[type="password"]:focus,
input[type='username']:focus,
input[type='name']:focus,
input[type='surname']:focus {
    background-color: rgba(0, 0, 0, 0.4) !important;
}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    -webkit-box-shadow: 0 0 0 30px rgba(0, 0, 0, 0.4) inset !important;
    -webkit-text-fill-color: #f1f1f1 !important;
    transition: background-color 5000s ease-in-out 0s;
}


</style>


</head>
<body>
  <section class="section2">
    <div class="SignUp">
      <form class="forma" onsubmit="return validation()" action="register.php" method="post">
        <label for="username">Username</label>
        <input id="username" name="username" placeholder="username" required type="username">

        <div class="name-row">
            <div class="name-col">
                <label for="name">Name</label>
                <input id="name" name="name" placeholder="yourname" required type="name">
            </div>
            <div class="name-col">
                <label for="surname">Surname</label>
                <input id="surname" name="surname" placeholder="yoursurname" required type="surname">
            </div>
        </div>

        <label for="email">Email Address</label>
        <input id="email" name="email" type="email" placeholder="you@example.com" required>
        <p id="email_error" style="color: red; font-size: 12px; text-align: left; display: none;">Please enter a valid email address</p>

    <label for="password">Password</label>
    <input id="password" name="password" type="password" placeholder="password" required>
    <p id="password_error" style="color: red; font-size: 12px; text-align: left; display: none;">Password must be at least 8 characters and contain only letters and numbers</p>

        <button type="submit" name="submit">Continue</button>
      </form>
      <p>Log in to <a href="login.php">LetterDash</a></p>
    </div>
  </section>


<script>
    function validation() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var emailError = document.getElementById('email_error');
        var passwordError = document.getElementById('password_error');
        
        var valid_email_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var valid_password_regex = /^[A-Za-z0-9]{8,}$/;
        
        var isValid = true;

        if (!valid_email_regex.test(email)) {
            emailError.style.display = "block";
            document.getElementById('email').style.borderColor = "#ff3333";
            isValid = false;
        } else {
            emailError.style.display = "none";
            document.getElementById('email').style.borderColor = "rgba(255, 255, 255, 0.2)";
        }

        if (!valid_password_regex.test(password)) {
            passwordError.style.display = "block";
            document.getElementById('password').style.borderColor = "#ff3333";
            isValid = false;
        } else {
            passwordError.style.display = "none";
            document.getElementById('password').style.borderColor = "rgba(255, 255, 255, 0.2)";
        }

        return isValid;
    }
</script>
</body>
</html>