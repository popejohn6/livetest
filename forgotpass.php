<?php
include 'config/dbconfig.php';
echo $obj->connect();
 session_start();
 if(isset($_SESSION['aid']))
 {
	 if($_SESSION['aid'] != "")
	 {
	 header("location:index.php");
	 }
 }
   if(isset($_REQUEST['submit']))
   {
    $ar = $_REQUEST['email'];
   
     $tmp= $obj->selectwhere("user","email='$ar'");
   
  $row = mysql_fetch_array($tmp);
  
  if($row)
  {
      
       $msg= 'Password send to your email address';
	   $headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: support@livetest.com" . "\r\n";
$message = '<html>
<body>

<div style=" background-color:black;color:white;text-align:center;padding:5px;">
<h1>Password notification</h1>
</div>
<div style=" width:350px;float:left;padding:10px;">
<h2>Hello,'.$row["fname"].'</h2>
<p>Somebody recently asked to get your password.</p>
<p> Your password is : <b>'.$row["password"].' </b></p>
</div>
<div style=" background-color:black;color:white;clear:both; text-align:center;padding:5px;">
Thank you
</div>
</body>
</html>
';

mail($ar, 'Password Notification', $message,$headers);
  }
  else
  {
      $msg= "Sorry, this email address is not associated";
  }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Image-less CSS3 Glowing Form Implementation</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>
		$(function(){
		  var $form_inputs =   $('form input');
		  var $rainbow_and_border = $('.rain, .border');
		  /* Used to provide loping animations in fallback mode */
		  $form_inputs.bind('focus', function(){
		  	$rainbow_and_border.addClass('end').removeClass('unfocus start');
		  });
		  $form_inputs.bind('blur', function(){
		  	$rainbow_and_border.addClass('unfocus start').removeClass('end');
		  });
		  $form_inputs.first().delay(800).queue(function() {
			$(this).focus();
		  });
		});
	</script>
	<style>

body {
    background: #e9e9e9 none repeat scroll 0 0;
    color: #666666;
    font-family: "RobotoDraft","Roboto",sans-serif;
    font-size: 14px;
}
.pen-title {
    letter-spacing: 2px;
    padding: 50px 0;
    text-align: center;
}
.pen-title h1 {
    font-size: 48px;
    font-weight: 300;
    margin: 0 0 20px;
}
.pen-title span {
    font-size: 12px;
}
.pen-title span .fa {
    color: #ed2553;
}
.pen-title span a {
    color: #ed2553;
    font-weight: 600;
    text-decoration: none;
}
.rerun {
    margin: 0 0 30px;
    text-align: center;
}
.rerun a {
    background: #ed2553 none repeat scroll 0 0;
    border-radius: 3px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    color: #ffffff;
    cursor: pointer;
    display: inline-block;
    padding: 10px 20px;
    text-decoration: none;
    transition: all 0.3s ease 0s;
}
.rerun a:hover {
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}
#codepen, #portfolio {
    background: #363636 none repeat scroll 0 0;
    border-radius: 100%;
    bottom: 30px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    color: #ffffff;
    height: 56px;
    position: fixed;
    right: 30px;
    text-align: center;
    transition: all 0.3s ease 0s;
    width: 56px;
}
#codepen i, #portfolio i {
    line-height: 56px;
}
#codepen:hover, #portfolio:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
}
#portfolio {
    animation: 1s ease 0s normal none 1 running buttonFadeInUp;
    background: #ed2553 none repeat scroll 0 0;
    bottom: 96px;
    height: 44px;
    right: 36px;
    width: 44px;
}
#portfolio i {
    line-height: 44px;
}
.container {
    margin: 0 auto 100px;
    max-width: 460px;
    position: relative;
    width: 100%;
}
.container.active .card:first-child {
    background: #f2f2f2 none repeat scroll 0 0;
    margin: 0 15px;
}
.container.active .card:nth-child(2) {
    background: #fafafa none repeat scroll 0 0;
    margin: 0 10px;
}
.container.active .card.alt {
    border-radius: 5px;
    height: auto;
    min-width: 100%;
    overflow: hidden;
    padding: 60px 0 40px;
    right: 0;
    top: 20px;
    width: 100%;
}
.container.active .card.alt .toggle {
    box-shadow: none;
    position: absolute;
    right: -70px;
    top: 40px;
    transform: scale(10);
    transition: transform 0.3s ease 0s, -webkit-transform 0.3s ease 0s;
}
.container.active .card.alt .toggle::before {
    content: "";
}
.container.active .card.alt .title, .container.active .card.alt .input-container, .container.active .card.alt .button-container {
    left: 0;
    opacity: 1;
    transition: all 0.3s ease 0s;
    visibility: visible;
}
.container.active .card.alt .title {
    transition-delay: 0.3s;
}
.container.active .card.alt .input-container {
    transition-delay: 0.4s;
}
.container.active .card.alt .input-container:nth-child(2) {
    transition-delay: 0.5s;
}
.container.active .card.alt .input-container:nth-child(3) {
    transition-delay: 0.6s;
}
.container.active .card.alt .button-container {
    transition-delay: 0.7s;
}
.card {
    background: #ffffff none repeat scroll 0 0;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    box-sizing: border-box;
    padding: 60px 0 40px;
    position: relative;
    transition: all 0.3s ease 0s;
}
.card:first-child {
    background: #fafafa none repeat scroll 0 0;
    border-radius: 5px 5px 0 0;
    height: 10px;
    margin: 0 10px;
    padding: 0;
}
.card .title {
    border-left: 5px solid #ed2553;
    color: #ed2553;
    font-size: 32px;
    font-weight: 600;
    margin: 0 0 35px;
    padding: 10px 0 10px 50px;
    position: relative;
    text-transform: uppercase;
    z-index: 1;
}
.card .input-container {
    margin: 0 60px 50px;
    position: relative;
}
.card .input-container input {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: 0 none;
    color: #212121;
    font-size: 24px;
    font-weight: 400;
    height: 60px;
    outline: medium none;
    position: relative;
    width: 100%;
    z-index: 1;
}
.card .input-container input:focus ~ label {
    color: #9d9d9d;
    transform: translate(-12%, -50%) scale(0.75);
}
.card .input-container input:focus ~ .bar::before, .card .input-container input:focus ~ .bar::after {
    width: 50%;
}
.card .input-container input:valid ~ label {
    color: #9d9d9d;
    transform: translate(-12%, -50%) scale(0.75);
}
.card .input-container label {
    color: #757575;
    font-size: 24px;
    font-weight: 300;
    left: 0;
    line-height: 60px;
    position: absolute;
    top: 0;
    transition: all 0.2s ease 0s;
}
.card .input-container .bar {
    background: #757575 none repeat scroll 0 0;
    bottom: 0;
    height: 1px;
    left: 0;
    position: absolute;
    width: 100%;
}
.card .input-container .bar::before, .card .input-container .bar::after {
    background: #ed2553 none repeat scroll 0 0;
    content: "";
    height: 2px;
    position: absolute;
    transition: all 0.2s ease 0s;
    width: 0;
}
.card .input-container .bar::before {
    left: 50%;
}
.card .input-container .bar::after {
    right: 50%;
}
.card .button-container {
    margin: 0 60px;
    text-align: center;
}
.card .button-container button {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 center;
    border: 2px solid #e3e3e3;
    cursor: pointer;
    display: inline-block;
    font-size: 24px;
    font-weight: 600;
    line-height: 1;
    outline: 0 none;
    overflow: hidden;
    padding: 20px 0;
    position: relative;
    text-transform: uppercase;
    transition: all 0.3s ease 0s;
    width: 240px;
}
.card .button-container button span {
    color: #ddd;
    position: relative;
    transition: all 0.3s ease 0s;
    z-index: 1;
}
.card .button-container button::before {
    background: #ed2553 none repeat scroll 0 0;
    border-radius: 100%;
    content: "";
    display: block;
    height: 30px;
    left: 50%;
    margin: -15px 0 0 -15px;
    opacity: 0;
    position: absolute;
    top: 50%;
    transition: all 0.3s ease 0s;
    width: 30px;
}
.card .button-container button:hover, .card .button-container button:active, .card .button-container button:focus {
    border-color: #ed2553;
}
.card .button-container button:hover span, .card .button-container button:active span, .card .button-container button:focus span {
    color: #ed2553;
}
.card .button-container button:active span, .card .button-container button:focus span {
    color: #ffffff;
}
.card .button-container button:active::before, .card .button-container button:focus::before {
    opacity: 1;
    transform: scale(10);
}
.card .footer {
    color: #d3d3d3;
    font-size: 24px;
    font-weight: 300;
    margin: 40px 0 0;
    text-align: center;
}
.card .footer a {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s ease 0s;
}
.card .footer a:hover {
    color: #bababa;
}
.card.alt {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border-radius: 100%;
    box-shadow: none;
    height: 140px;
    padding: 0;
    position: absolute;
    right: -70px;
    top: 40px;
    transition: all 0.3s ease 0s;
    width: 140px;
    z-index: 10;
}
.card.alt .toggle {
    background: #ed2553 none repeat scroll 0 0;
    border-radius: 100%;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    color: #ffffff;
    cursor: pointer;
    font-size: 58px;
    height: 140px;
    line-height: 140px;
    position: relative;
    text-align: center;
    width: 140px;
}
.card.alt .toggle::before {
    content: "";
    display: inline-block;
    font-family: FontAwesome;
    font-feature-settings: normal;
    font-kerning: auto;
    font-language-override: normal;
    font-size: inherit;
    font-size-adjust: none;
    font-stretch: normal;
    font-style: normal;
    font-synthesis: weight style;
    font-variant: normal;
    font-weight: normal;
    line-height: 1;
    text-rendering: auto;
    transform: translate(0px, 0px);
}
.card.alt .title, .card.alt .input-container, .card.alt .button-container {
    left: 100px;
    opacity: 0;
    visibility: hidden;
}
.card.alt .title {
    border-color: #ffffff;
    color: #ffffff;
    position: relative;
}
.card.alt .title .close {
    color: #ffffff;
    cursor: pointer;
    display: inline;
    font-size: 58px;
    font-weight: 400;
    position: absolute;
    right: 60px;
    top: 0;
}
.card.alt .title .close::before {
    content: "×";
}
.card.alt .input-container input {
    color: #ffffff;
}
.card.alt .input-container input:focus ~ label {
    color: #ffffff;
}
.card.alt .input-container input:focus ~ .bar::before, .card.alt .input-container input:focus ~ .bar::after {
    background: #ffffff none repeat scroll 0 0;
}
.card.alt .input-container input:valid ~ label {
    color: #ffffff;
}
.card.alt .input-container label {
    color: rgba(255, 255, 255, 0.8);
}
.card.alt .input-container .bar {
    background: rgba(255, 255, 255, 0.8) none repeat scroll 0 0;
}
.card.alt .button-container button {
    background: #ffffff none repeat scroll 0 0;
    border-color: #ffffff;
    width: 100%;
}
.card.alt .button-container button span {
    color: #ed2553;
}
.card.alt .button-container button:hover {
    background: rgba(255, 255, 255, 0.9) none repeat scroll 0 0;
}
.card.alt .button-container button:active::before, .card.alt .button-container button:focus::before {
    display: none;
}
@keyframes buttonFadeInUp {
0% {
    bottom: 30px;
    opacity: 0;
}
}

</style>
	
	</head>
	<body >
	 <div class="pen-title">
  <h1>Forgot Password?</h1>
</div>
		<div class="rerun"></div>
<div class="container">
  <div class="card"></div>
  <div class="card">
				 <form role="form" method="post" action="">
					<?php 
						if(isset($msg))
						{
							echo "<h4 class='title'>".$msg."</h4>";
						}
						else{
							?>
							<h1 class="title"></h1>
							<?php
						}
					?>
					<div class="input-container">
						<input id="Username" required="required" value="<?php if(isset($_COOKIE["emailuser"])){ echo $_COOKIE["emailuser"];} ?>"name="email" type="email"/>
						<label for="Username">Email</label>
						<div class="bar"></div>
					  </div>				
					  <div class="button-container">
						<button type="submit" name="submit" value="LOG IN"><span> Verify Email</span></button>
     
					                
					                  
									   
									    </div>
                                    <div class="footer">    <a href="login.php"> Back </a></div>
				</form>
			</div>
		</div>
	</body>
</html>