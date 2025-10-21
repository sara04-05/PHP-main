
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      <section class="section2">
        <div class="SignUp">
            <div class="intro">
               <p class="Sign">Log In to <br><p class="brand" >Sara's Digital Library</p></p><br>
                <p class="detail">Please enter your email address to continue</p>

                <form class="forma" onsubmit="return validation()">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" placeholder="your@email.com" required>
                    <span id="email_error">Please enter a valid email</span>

                    
                </form><br>
                
                <form class="forma" onsubmit="return validation()" id="password-container">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="yourpassword" required>
                    <span id="password_error">Please enter a valid password</span>

                    <button type="submit">Continue</button>
                </form>
            </div><br>

            <p>Don't have an account? <a href="account.html">Sign up to Sara's Digital Library</a></p>
        </div>
    </section>
</body>
</html>