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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>

            <?php if (login_check($mysqli) == true) : ?>
            <p><span style="font-size: 50px"> Welcome <?php echo htmlentities($_SESSION['username']); ?>!</span></p>

                <form action="../calendarfn.php" method="get">
                    
                    Date: <input type="date" name="date"></br><br />
                    Title: <input type="text" name="title"><br /><br />
                    Time: <input type="Time" name="starttime"> To <input type="Time" name="endtime"><br/><br />
                    Detail: <input type="text" name="detail"><br /></br>
                    <input type="submit" value="Submit!">

                </form>
                <p>If you are done, please <a href="includes/logout.php">log out</a></p> 
                <?php else : ?>
                <p>
                    <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
        

            </p>
        <?php endif; ?>
    </body>
</html>
