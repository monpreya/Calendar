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
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="styles/main.css" />
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
        <style type="text/css">

             body{
               background: url("../img/regisback.jpg");
                background-repeat: no-repeat;
                background-size:cover;
                
            }

        </style>

       
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Register with us</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <ul>
            <li>Forename must not be blank, must not contain spaces, and must have at least 3 alphabet characters</li>
            <li>Must not be blank, must not contain spaces, and must have at least 3 alphabet characters</li>
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Age it is a 18+ website, so the age must be between 18 and 110</li>
            <li>Passwords must be at least 8 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one upper case letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
        <form method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>"><br>
               <div style=" position: relative;
                        width: 650px; 
                        margin: 0px auto;
                        padding: 10px; line-height: 1.5px;
                        border-radius: 5px;
                        border: 1px solid #ccc;
                        background-color: #6BABFE ;
                        box-shadow: 7px 7px 7px #999;">

                <div  style="line-height: 20px;font-size: 20px;color: white;">
                    Forename: <input type='text' name ='forename' id='forename'/>
                    Surname: <input type='text' name ='surname' id='surname' /><br><br>
                    Username: <input type='text' name='username' id='username' />
                    Email: <input type="text" name="email" id="email" /><br><br>
                    Age: <input type="text" name ='age' id='age' /><br><br>
                    Password: <input type="password"
                                     name="password" 
                                     id="password"/><br><br>
                    Confirm password: <input type="password" 
                                             name="confirmpwd" 
                                             id="confirmpwd" /><br><br>

                </div> 

                <div style="text-align: center;">
                    <input type="button" 
                       value="Register" style="width:100px;height:50px;font-size: 20px;" 
                       onclick="return regformhash(this.form,
                                   this.form.forename,
                                   this.form.surname,
                                   this.form.username,
                                   this.form.email,
                                   this.form.age,
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
                </div>


           </div>
          
                
               
           
                   
        </form>
        <br><p style="position: relative; background-color: #FBFE6B ; ">
            <span style="position: absolute; text-align: right;right: 150px;">Return to the <a href="index.php">login page</a></span>.</p></br>
    </body>
</html>
