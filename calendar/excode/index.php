<?php
/**
 * Copyright (C) 2013 peredur.net
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <link rel="stylesheet" href="styles/main.css" />
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			<script>
			$(document).ready(function(){

		  	/*  $("input").mouseenter (function(){
		    	$(this).css("background-color", "#D1F1F2");
		  	  });

			  $("input").mouseleave(function(){
     			$(this).css("background-color", "#ffffff");
  			  });
  			  */

  			  $("input").focus(function(){
   				$(this).css("background-color", "#D1F1F2");
  			  });

  			  $("input").blur(function(){
   				$(this).css("background-color", "#ffffff");
  			  });
			
			  
		  	});
		
			</script>
        <style>

			body{
			   background: url("../img/download.jpg");
			    background-repeat: no-repeat;
			    background-size:cover;
			    
			}
		</style>
    </head>

    <body>
    	<div style="	position: relative;
    					width: 650px; top: 150px;
    					margin: 0px auto;
    					padding: 10px; line-height: 1.5px;
					    border-radius: 5px;
					    border: 1px solid #ccc;
					    background-color: #BABEF9;
					    box-shadow: 7px 7px 7px #999;">
	    
				<p><center><span style="font-size: 40px;line-height: 80pt">LOGIN</span></center></p></br>
			    <div style="position: relative;text-align: center;">
			        
			       
			        		<?php
					        if (isset($_GET['error'])) {
					            echo '<p class="error">Error Logging In!</p>';
					        } 
			       		 ?> 
			        	<form action="includes/process_login.php" method="post" name="login_form"> 	
				        
			              
   
			               
			               	
			               		<p> Email: <input type="text" name="email"  /></p></br>
				           		<p> Password: <input type="password" name="password" id="password"/></p></br>
			        
				            <br><span style="line-height: 80px;"> <input type="button" 
				                   value="Login"style="width:100px;height:50px;font-size: 20px;" 
				                   onclick="formhash(this.form, this.form.password);" /></span></br>
			        	</form>
			        <p>If you don't have a login, please <a href="register.php">register</a></p>
			        
			        <p>You are currently logged <?php echo $logged ?>.</p>
		   		 </div>

		   </div>

    </body>
</html>
