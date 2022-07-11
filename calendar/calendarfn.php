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
include_once 'excode/includes/db_connect.php';
include_once 'excode/includes/functions.php';

sec_session_start();
if (!(login_check($mysqli) == true))
{
    echo 'Please login first <a href="excode/index.php"> index </a>';
    exit(0);
}


?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- <script>
$(function(){
  /* เพิ่มฟังก์ชันที่จะเรียก Ajax เมื่อมีการคลิกลิงค์ที่อยู่ภายใต้ div ที่มี id="sidebar" */
  $('#panel').delegate('a', 'click', function(e){
    e.preventDefault();
    var link = this.href;
       
    /* ดึงเนื้อหาจากลิงค์ด้วย Ajax เมื่อผู้ใช้กดลิงค์ */
    $.get(link, function(res){
      /* อัพเดทเนื้อหาที่ได้จาก Ajax ไปที่ div ที่มี id="content" */
      $('#all').html(res);
      /* หลังจากอัพเดทเนื้อหาเสร็จ เปลี่ยน URL ของเบราว์เซอร์ */
      window.history.replaceState(null, null, link);
    });
  });
});
    </script> -->

    <script>
    $(function() {


        $('.normal').click(function() {
            $('#contactForm').fadeToggle();
            var day = $(this).find(".dayIndi").text();
            if (day.length == 1) {
                day = "0" + day;
            }
            $('#date').val($("#yearvalue").attr('value') + "-" + $("#mountvalue").attr('value') + "-" + day);
            console.log(day + "-" + $("#mountvalue").attr('value') + "-" + $("#yearvalue").attr('value'));
        });

        $('#contact').click(function() {
            $('#contactForm').fadeToggle();
            $('#date').val("");
        });


        $(document).mouseup(function(e) {
            var container = $("#contactForm");

            if (!container.is(e.target) &&
                container.has(e.target).length === 0) {
                container.fadeOut();
            }
        });

    });
    </script>
    <script>
    $(document).ready(function() {
        $("#flip").click(function() {
            $("#panel").slideToggle("slow");
        });
    });
    </script>
    <script type="text/javascript">
          year_month = <?php echo '"' . date('Y-m',strtotime($_SESSION['date'])) . '"' ?>
    </script>
    <!-- drag/drop -->
    <script>
        $(document).ready(function(){

                $(".draggable").draggable({
                  revert:"invalid",
                  snap: true,
                  snapMode: "inner"
                });

                $(".droppable").droppable({
                  accept: ".draggable",
                  drop: function(event, ui)
                  {
                    var dropped = ui.draggable;
                          var id = dropped.attr('id');
                          var date_i = $(this).find('span.dayIndi').text();

                    date_temp = year_month + '-' + date_i;
                    console.log(date_temp + " THIS ID: " + id);


                    var post_data = {
                      event_id: id,
                      date: date_temp
                    };
                    $.post("handler.php", post_data, function(data, status) 
                    {
                      // if (data.success == true) 
                      // {
                      //  //update success
                      // } 
                      // else
                      // {
                      //  //update failed
                      // }
                      location.reload();
                    });

                    
                  }
                  //
                });

                console.log(year_month);

              });

      </script>
    <title>Calendar Mount</title>
    <meta charset="UTF-8">
</head>

<body>
    <div style="width: 1435px;" id="all">
      <div style="position: relative;height: 30px;top: 20px;">
          
          <div class="allbottom">
                <a class="button" href="?prev">
                    &lt;
                </a> <!-- //ใส่ให้ตัวอักษรเด้งขึนมา  -->
                <a class="button" href="?now">
                    NOW
                </a> <!-- //ใส่ให้ตัวอักษรเด้งขึนมา  -->
                <a class="button" href="?next">
                    &gt;
                </a> <!-- //ใส่ให้ตัวอักษรเด้งขึนมา  -->
            </div>
            
            <div style="  z-index: 2;position: absolute;right: 150px;" class="ul" >
                <div id="flip" class="li">
                    <a class="active" style="text-align: center;">View</a>
                </div>
                <div class="li">
                    <div id="panel">
                        <a href="calendarfn.php">Month</a>
                        <a href="WeekView.php">Week</a>
                        <a href="dayview.php">Day</a>
                        <a href="detail.php">Detail</a>
                    </div>
                </div>
            </div>
          </div>

      <div style="position: relative;top: 30px;">
       
        <div class="inleft">
            <p><span style="font-size: 20px"> Welcome
                    <?php echo htmlentities($_SESSION['username']); ?>!</span></p>
            <div id="contact" style="position: absolute;">ADD</div>
            <div id="contactForm">
                <form action="calendarfn.php" method="post">
                    Date: <input type="date" id="date" name="date"></br>
                    Title: <input type="text" name="title"><br />
                    Time: <input type="Time" name="starttime">
                    To <input type="Time" name="endtime"><br />
                    Detail: <input type="text" name="detail"><br />
                    Color:<input type="color" name="color"><br />
                    <input type="submit" class="formBtn" name="add_btn" value="Submit!">
                </form>
            </div>
        </div>

    <?php 
  if (isset($_POST['date'], $_POST['title'], $_POST['starttime'],$_POST['endtime'], $_POST['detail'],$_POST['color'], $_POST['add_btn']))
  {
    $conn   = mysqli_connect("localhost", "root", "", "appo");
    $title  = $_POST['title'];
    $detail = $_POST['detail'];
    $date   = $_POST['date'];
    $time   = $_POST['starttime'];
    $timeend = $_POST['endtime'];
    $color = explode('#', $_POST['color']);
    $color = implode('', $color);
      //$qry = "INSERT INTO appo (id, user, title, detail, date, time, timeend, color) VALUES (NULL, '" . $_SESSION['user_id'] . "', '" . $title . "', '" . $detail . "', '" . $date . "', '" . $time . "', '" . $time_end . "', '" . $color . "')";
      $qry = "INSERT INTO appo (username, tilte, date, starttime, endtime, detail, color ) VALUES ('" . $_SESSION['user_id'] . "','" . $title . "','" . $date . "','" . $time . "','" . $timeend . "','" . $detail . "',
      '". $color . "')";
  $conn->query($qry);
  echo $conn->error;
  $conn->close();

       
  }

              $today = date('d');            //Gets today’s date 
              $todaymonth = date('m');          //Gets today’s month 
              $todayyear = date('Y');            //Gets today’s year  
              $servername = "localhost"; 
              $password = "";
              $dbname = "appo"; 
              $username = "root";




  ?>
        

        <div class="inright" id="inright">
           
            <div class="calendar">
                <div class="days sun">Sunday</div>
                <div class="days mon">Monday</div>
                <div class="days tue">Tuesday</div>
                <div class="days wed">Wednesday</div>
                <div class="days thu">Thursday</div>
                <div class="days fri">Friday</div>
                <div class="days sat">Saturday</div>
                <?php


            if(isset($_GET['next']))
            {
              
              $_SESSION['date'] = date("d-m-Y",strtotime("+1 month",strtotime($_SESSION['date'])));
            }
            else if(isset($_GET['prev']))
            {
              $_SESSION['date'] = date("d-m-Y",strtotime("-1 month",strtotime($_SESSION['date'])));
            }
            else if (isset($_GET[ 'now' ]))
            {
                $_SESSION[ 'date' ] = date("d-m-Y", strtotime("now"));
            }

           
              if (!isset($_SESSION['date'])) 
              {
                $_SESSION['date'] = date("d-m-y");

              }
            
              if(isset($_SESSION['date'])){
                  $date = $_SESSION['date'];

                  $day = date('d', strtotime($date));      //Gets day of apx`pointment (1‐31) 
                    $month = date('m', strtotime($date));      //Gets month of appointment (1‐12) 
                    $year = date('Y', strtotime($date));      //Gets year of appointment (e.g. 2016) 
                    $firstday = date('w', strtotime('01-' . $month . '-' . $year));  //Gets the day of the week for the 1st of  
                               //the month. (e.g. 0 for Sun, 1 for Mon) 
                    $days = date('t', strtotime($date));      //Gets number of days in month 
                  }else{
                    $date = date('Y-m-d');

                    $day = date('d', strtotime($date));      //Gets day of apx`pointment (1‐31) 
                    $month = date('m', strtotime($date));      //Gets month of appointment (1‐12) 
                    $year = date('Y', strtotime($date));      //Gets year of appointment (e.g. 2016) 
                    $firstday = date('w', strtotime('01-' . $month . '-' . $year));  //Gets the day of the week for the 1st of  
                               //the month. (e.g. 0 for Sun, 1 for Mon) 
                    $days = date('t', strtotime($date));      //Gets number of days in month 
                  }

            


                 for($i=1; $i<=$firstday; $i++) 
                 { 
                    echo '<div class=" date blankday"></div>'; 
                 } 

                 for($i=1; $i<=$days; $i++) 
                 { 

                    echo '<div value="'.$i.'" class="droppable normal date'; 
                       if ($today == $i && $todaymonth==$month && $todayyear == $year) 
                       { 
                          echo ' today'; 
                       } 
                       echo '"><span class="dayIndi">' . $i . '</span><br>'; 
                       //select DB


                          $id = $_SESSION['user_id'];
                           $app_date = date($year.'-'.$month.'-'.$i);
                           $mysqli = new mysqli("localhost", "root", "", "appo"); //connent to DB
                           $sql = "SELECT * FROM appo WHERE date = '$app_date' AND username = '".$id."' ";

                           
                           if($result = $mysqli->query($sql))
                          {
                              while($row = $result->fetch_assoc())
                              {
                                $start = date('H:i', strtotime($row['starttime']));
                                $end = date('H:i', strtotime($row['endtime']));
                                $detail= $row['detail'];
                                $color = $row['color'];
                                //echo $color;
                                                                
                                //echo '<div title = "start: '.$start.'&#xA;end: '.$end.'">'.$row['detail'].'</div>';
                        
                                  if (date('d',strtotime($row['date']))== $i ) 
                                  {
                                     
                                    echo '<span class="draggable" id="' . $row['id'] . '"> <div title = "start: '.$start.'&#xA;end: '.$end.' &#xA;detail: '.$detail.'   " >  <span class="draggablecss" style ="background-color: #'.$color.'; "> '  .$row['tilte'].'</span></div></span>';

                                  }
                                

                              }
                          }


                          $mysqli->close();

                       echo  '</div>'; 
                 } 


                 $daysleft = 7-(($days + $firstday)%7); 
                 if($daysleft<7) 
                 { 
                    for($i=1; $i<=$daysleft; $i++) 
                    { 
                       echo '<div class=" date blankday"></div>'; 
                    } 
                 } 

                  

              ?>
                <div class="showdate">
                    <?php 
                    //echo  $month1 . ' ' . $year; 
                   $m1 = date('F', strtotime($_SESSION['date']));
                    echo '<span id="mountvalue" value="' . $month . '">' . $m1 . '</span> <span id="yearvalue" value="' . $year . '">' . $year . '</span>';
                    ?>
                </div>
                <div style="position:absolute;top: 800px;">
                    If you are done, please
                    <a href="excode/includes/logout.php">log out</a>
                </div>
            </div>
        </div>
      </div>
    </div>
</body>

</html>