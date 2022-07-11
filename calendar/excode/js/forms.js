/* 
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

function formhash(form, password) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");

    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent. 
    password.value = "";

    // Finally submit the form. 
    form.submit();
}

function regformhash(form,fore,sure, uid, email,age, password, conf) {
    // Check each field has a value
    if ( fore.value == '' || sure.value == '' ||uid.value == ''  || email.value == '' /*||age.value == '' */|| password.value == '' || conf.value == '') 
    {
        alert('You must provide all the requested details. Please try again');
        return false;
    }
    //check num of char
    if (forename.value.length < 3) {
        alert('Forename must be at least 3 characters long. Please try again');
        form.forename.focus();
        return false;
    }
    if (surname.value.length < 3) {
        alert('Surname must be at least 3 characters long. Please try again');
        form.surname.focus();
        return false;
    }

    if (username.value.length < 5) {
        alert('Username must be at least 5 characters long. Please try again');
        form.username.focus();
        return false;
    }
    // Check the username forename surname
    re = /^\w+$/; 

    if(!re.test(form.forename.value)) { 
        alert("Forename must contain only letters, numbers and underscores. Please try again"); 
        form.forename.focus();
        return false; 
    }
    if(!re.test(form.surname.value)) { 
        alert("surname must contain only letters, numbers and underscores. Please try again"); 
        form.surname.focus();
        return false; 
    }

    if(!re.test(form.username.value)) { 
        alert("Username must contain only letters, numbers and underscores. Please try again"); 
        form.username.focus();
        return false; 
    }

    re = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/;
    
    if  (!re.test(form.email.value))
            {
                alert("Email must be of the form abc@def.gh");
                from.email.focus();
                return false;
            }

    re = /(?=.*[0-9])/; 

    if (!re.test(form.age.value)) 
            {
                alert("The age must be numbers. ");
                from.age.focus(); 
                return false;

             }
    if (age.value < 18 && age.value > 110)
            {
                alert (" The age must be between 18 and 110!!!");
                from.age.focus();
                return false;
            }
    
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user

    if (password.value.length < 8) {
        alert('Passwords must be at least 8 characters long.  Please try again');
        form.password.focus();
        return false;
    }
    
     // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/; 
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
    
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
        
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");

    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";

    // Finally submit the form. 
    form.submit();
    return true;
}
