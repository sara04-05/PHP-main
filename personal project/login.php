<?php
$images = [
    "pics/brain.png",
    "pics/dolphin.png",
    "pics/elephant.png",
    "pics/monkey.png",
    "pics/octo.png",
    "pics/raven.png",
];

$randomImage = $images[array_rand($images)];

include_once('config.php'); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    font-family: Arial, sans-serif;
}

.section2 {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 2rem;
}

.login {
    padding: 1.2rem 2rem;
    background: rgba(255, 255, 255, 0.1); 
    backdrop-filter: blur(15px);           
    -webkit-backdrop-filter: blur(15px);   
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
}

.logo {
    display: block;
    width: 200px;
    height: 140px;
    margin: 0 auto 0.5rem; 
    border-radius: 50%;
    object-fit: cover; 
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
input[type="password"] {
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
    visibility: hidden;
    color: red;
    font-size: 10px;
    margin: 0;
    padding: 0;
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

</style>

<script>
function validation() {
 var email=document.getElementById('email').value;
 valid_email_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

 var password = document.getElementById('password').value;
 valid_password_regex= /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

    if (!(email.match(valid_email_regex)) || !(password.match(valid_password_regex))) {
         if (!(email.match(valid_email_regex))) {
            document.getElementById('email_error').style.visibility="visible";
            document.getElementById('email').style.borderColor="red";
        }else{
            document.getElementById('email_error').style.visibility="hidden";
            document.getElementById('email').style.borderColor="black";
        }
         if (!(password.match(valid_password_regex))) {
            document.getElementById('password_error').style.visibility="visible";
            document.getElementById('password').style.borderColor="red";
        }else{
            document.getElementById('password_error').style.visibility="hidden";
            document.getElementById('password').style.borderColor="black";
        }

         return false;
        }else{
            document.getElementById('email_error').style.visibility="hidden";
            document.getElementById('email').style.borderColor="black";
            document.getElementById('password_error').style.visibility="hidden";
            document.getElementById('password').style.borderColor="black";
            return true;    
        }}
</script>
</head>
<body>

<section class="section2">
    <div class="login">
        <div class="intro">
            <div class="img"><img src="<?php echo $randomImage; ?>" alt="Random Image" class="logo"></div>

            <!-- Single form with proper name attributes and submit button -->
            <form class="forma" onsubmit="return validation()" action="loginlogic.php" method="post">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="your@email.com" required>
                <span id="email_error">Please enter a valid email</span>

                <label for="password" style="margin-top:0.75rem;">Password</label>
                <input type="password" id="password" name="password" placeholder="yourpassword" required>
                <span id="password_error">Please enter a valid password</span>

                <button type="submit" name="submit" style="margin-top:0.75rem;">Continue</button>
            </form>

        </div><br>
        
        <p>Don't have an account? Sign up to <a href="signupp.php">LetterDash</a></p>
    </div>
</section>
</body>
</html>
