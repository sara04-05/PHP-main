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

.SignUp {
    background: rgba(255, 255, 255, 0.1); 
    backdrop-filter: blur(15px);           
    -webkit-backdrop-filter: blur(15px);   
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 3rem 2rem;
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
input[type="password"]
{
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
    padding: 10px;
    border-radius: 6px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background-color: rgba(0, 0, 0, 0.4);
    color: #f1f1f1;
    font-size: 1rem;
    outline: none;
}

.name-row {
  display: flex;
  gap: 3px; 
}

.name-row input {
  flex: 1; 
  width: 100%; 
  border-radius: 6px;
  border: 1px solid rgba(255, 255, 255, 0.2);
  background-color: rgba(0, 0, 0, 0.4);
  color: #f1f1f1;
  font-size: 0.9rem;
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

p{
color: #000000ff;

}
</style>


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
                <p class="detail">Please enter your email address to continue</p>
        <div class="name-row">
                  <form class="forma" onsubmit="return validation()">
                    <label for="name">Name</label>
                    <input type="name" id="name" placeholder="yourname" required>
                    <span id="email_error">Please enter a valid name</span>

                    
                </form><br>
                
                  <form class="forma" onsubmit="return validation()">
                    <label for="surname">Surname</label>
                    <input type="surname" id="surname" placeholder="yoursurname" required>
                    <span id="email_error">Please enter a valid surname</span>

                    
                </form><br>
                </div>

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

        </div>
    </section>
</body>
</html>