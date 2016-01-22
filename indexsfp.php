<!DOCTYPE html>
<html>
<head>
    <title>Single Parent Fun</title>
    <link type="text/css" rel="stylesheet" href="stylesheet.css">
    
</head>

<body>
    
    <div class="containerlogo">
    <img class="logo" src="Images/landing-page-02.png">
    </div> 
    
    <div class="sticker-03">
    <img src="Images/sticker-03.png"> 
    </div>

 <div class="containerhead">
         <div class="h1">
              <h1 class="heading1">For the Better!</h1>
         </div>
       <div class="h2">
            <h2 class="heading2">Single Parent Fun wants your help!</h2>
    </div>
</div>    
<div class="container1">
    <p class="paragraph1">We will be in contact for you to help us build the all new Single Parent Fun Website</p>
    </div>
    
    
<div class="email">
<p class="paragraph2">Insert your e-mail address and we will keep you updated!</p>
</div>

<div class="form">   
    <form method="post" id="emailForm" action="">
                        <input type="email" name="email" id="emailField" placeholder="Enter Email Address" autofocus>
                        <button type="submit" class="goButton" id="registerGoButton">
                            Go 
                        </button>
                    </form>
             </div>
    
    <?php 
            $error = 0; // 0 = form not submitted yet, 1 = email registered, 2 = invalid address, 3 = email already registered
    if(!isset($_POST[email])){
        $error = 0;
    } else {
            if($_POST[email] != "" && $_POST[email] != null && filter_var($_POST[email], FILTER_VALIDATE_EMAIL)){
                
                $connection = mysqli_connect("localhost","griffinc_spf",")O*$,bP9Ty~%#","griffinc_spf"); 
                
                $address = mysqli_real_escape_string($connection, $_POST[email]);
                if (!$connection) { 
                    die('Could not connect: ' . mysqli_connect_error()); 
                }
                //mysql_select_db("alphataire_emailAddresses", $connection);
                
                
                $query = "SELECT email FROM emails WHERE email='".$address."'";
                $result = mysqli_query($connection, $query);
                $result = mysqli_num_rows($result);
                
                if ($result > 0){
                    $error = 3;
                } else {
                    $error = 1;
                    $sql="INSERT INTO emails (email) VALUES ('$address')";
                if (!mysqli_query($connection,$sql)) { 
                    die('Error: ' . mysql_error()); 
                } else {
                    $subject = "Thanks for your interest in Alphataire!";
                    $message = "Hi there!" . "\r\n" . "\r\n" . "We've received your email registration, and will be updating you as we get closer to the launch of Alphataire!";
                    $message = wordwrap($message, 70, "\r\n");
                    
                    $headers = "From: Alphataire <info@alphataire.co.uk>";
                    
                    mail($address, $subject, $message, $headers); 
                }
                }
                mysqli_close($connection); 
            } else {
                $error = 2;   
            }
    }

        if($error == 1){?>
            <script type="text/javascript">
                
                var goBtn = document.getElementById('registerGoButton');
                
                goBtn.innerHTML = "&#x2713;";
                goBtn.type = "button";
                goBtn.style.paddingLeft = "33.5px";
                goBtn.style.paddingRight = "33.5px";
                
                var emailField = document.getElementById('emailField')
                emailField.value = "Thank you. We'll keep you updated!";
                emailField.readOnly = true;
                function goBack(){
                    window.location.href='./';
                };

                var info = document.getElementById('registerInfo');
                info.style.display = "none";
                
                var share = document.getElementById('shareLinks');
                
                window.onload = function() {
                    share.className += " dropped";
                    goBtn.onclick=goBack;
                }

            </script>
            
        <?php } else if($error == 2 || $error == 3){?>
        
        <script type="text/javascript">
            emailField.className += "error";
            emailField.focus();
        </script>
        
        <?php }
            
        if($error == 2) { ?>
            <script type = "text/javascript">
                emailField.placeholder = "Please enter a valid email address.";
            </script>
       <?php }

        if($error == 3) { ?>
            <script type = "text/javascript">
            emailField.placeholder = "You've already registered!";
            </script>
        <?php } ?>
</body>
</html>
