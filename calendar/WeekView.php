<?php
include_once 'excode/includes/db_connect.php';
include_once 'excode/includes/functions.php';

sec_session_start();
if (!(login_check($mysqli) == true))
{
    echo 'Please login first <a href="index.php"> index </a>';
    exit(0);
}

?>
<!DOCTYPE html>
<html>
    <title>WeekView</title>
        <meta charset="UTF-8">


 <link rel="stylesheet" type="text/css" href="style1.css"> 

 
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<head>

   <script>
      $(document).ready(function() {
         $(".draggable").draggable({
              revert: "invalid",
              snap: true,
              snapMode: "inner"
            });
         $(".droppable").droppable({
            accept: ".draggable",
            drop: function(event, ui) 
            {
               var dropID = ui.draggable.attr('id');
               var drop = $(this).children(".hour").text();
               var day = $(this).children("#dayvalue").val();
               var month = $(this).children("#mountvalue").val();
               var year = $(this).children("#yearvalue").val();
               var send_day = year + "-" + month + "-" + day;
               var send_time = drop + ":00:00";
               console.log(send_time);
               $.ajax({
                  url:"handlerweek.php",
                  method:"POST",
                   data:{starttime:send_time,date:send_day,event:dropID},
                  success:function(data) {
                     if (!data) {
                        alert('fail');
                     }
                  }
               });
            }
         });

         
      });
   </script>
  <script>
    $(function() {


        $('.normal').click(function() {
            $('#contactForm').fadeToggle();
            var day = $(this).find("#dayvalue").val();
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
  
  </head>

<body>
 

<?php 

if(isset($_GET['date']))
  {
    $_SESSION['date'] = date("d-m-Y",strtotime($_GET['date']));
  }
  else if(!isset($_SESSION['date']))
  {
    $_SESSION['date'] = date("d-m-Y");
  }

  if(isset($_GET['now']))
  {
    $_SESSION['date'] = date("d-m-Y",strtotime("now"));

    
  }

      $day = (isset($_SESSION['week'])) ? $_SESSION['week'] : date('d');
      $weekgetdate = $day = date('W', strtotime($_SESSION['date']));
      $week = (isset($_SESSION['week'])) ? $_SESSION['week'] : date('W', strtotime($_SESSION['date']));
      $month = date('F', strtotime($_SESSION['date']));
      $month_num = date('m', strtotime($_SESSION['date']));
      $year = (isset($_SESSION['year'])) ? $_SESSION['year'] : date("Y");
      $title = "";
      $today = date('d');
      $todayweek = date('W');
      $todaymonth = date('m');
      $todayyear = date('Y');

    if($week > 52){
      $year++;
      $week = 1;
    }
    else if($week < 1){
      $year--;
      $week = 52;
    }
?> 

<?php
if(isset($_GET['addappo']))
{
   //$conn = new mysqli($servername,$username,$password,$dbname);
    $conn = mysqli_connect("localhost", "root", "", "appo");

   $color = explode('#', $_GET['color']);
    $color = implode('', $color);

    if ($qry = "INSERT INTO `appo` (`id`, `username`, `tilte`, `date`, `starttime`, `endtime`, `detail`, `color`) 
    VALUES (NULL, '" .$_SESSION['user_id']. "', '".$title."', '".$_GET['date']."', '".$_GET['starttime']."', '".$_GET['endtime']."', '".$detail."', '".$color."')") {
      $color = explode('#', $_GET['color']);
      $color = implode('', $color);
      $conn->query($qry);
      echo $conn->error;
      $conn->close();

     header('Location: Weekview.php?date='.$_GET['date']);
   }
}
?>

<div id="all">

        <div style="position: relative;height: 30px;top: 20px;">
          
          
            <div style="  z-index: 2;position: absolute;right: 150px;" class="ul" >
                <div id="flip" class="li">
                    <a class="active" style="text-align: center;">View</a>
                </div>
                <div class="li">
                    <div id="panel">
                        <a href="calendarfn.php">Month</a>
                        <a href="WeekView.php">Week</a>
                        <a href="DayView.php">Day</a>
                        <a href="detail.php">Detail</a>
                    </div>
                </div>
            </div>
          <div style="position: relative; left: 720px;" >
          <!-- show day -->
          <?php 
          
          echo '<div class="intop">' ;
          echo '<span id="monthIndi" value="' . $month . '">' . $month . '</span> <span id="yearIndi" value="' . $year . '">' . $year . '</span>';

          //echo $month . ' ' . $year;
          echo '</div>';
          $username = ($_SESSION['username']);
          $fornow = date('d-F-Y', strtotime($_SESSION['date']));


          ?>      
      </div>
      <div style=" position: relative;left: 30px;top: -40px;">
      <?php

      echo '<div class="allbottom">
              <a title="Previous Week" class="button" href="' . $_SERVER['PHP_SELF'] . '?week=' . ($week == 1 ? 52 : $week -1) . '&year=' . ($week == 1 ? $year - 1 : $year) . '&date=' . date("Y-m-d", strtotime("-1 week", strtotime($_SESSION['date']))) . '"> &lt; </a>

              <a href="?now" style="font-size: 12px;" title="<?php  echo $fornow; ?>" class="button"> Now </a>
      
             <a title="Next Week" class="button" href="' . $_SERVER['PHP_SELF'] . '?week=' . ($week == 52 ? 1 : 1 + $week) . '&year=' . ($week == 52 ? 1 + $year : $year) . '&date=' . date("Y-m-d", strtotime("+1 week", strtotime($_SESSION['date']))) . '"> 
              &gt; </a>
            </div>';     
      ?> 
      
        </div>


  </div>

            

      <div style=" position: relative;top: 30px;">
       
   <div class="inleft">
            <p><span style="font-size: 20px"> Welcome
                    <?php echo htmlentities($_SESSION['username']); ?>!</span></p>
            <div id="contact" style="position: absolute;">ADD</div>
            <div id="contactForm">
                <form action="WeekView.php" method="post">
                    Date: <input type="date" id="date" name="date"></br>
                    Title: <input type="text" name="title"><br />
                    Time: <input type="Time" name="starttime">
                    To <input type="Time" name="endtime"><br />
                    Detail: <input type="text" name="detail"><br />
                    Color:<input type="color" name="color"><br />
                    <input type="submit" class="formBtn" name="addappo" value="Submit!">
                </form>
            </div>
        </div>
     
          

  <div class="inright" id="inright">
   

<?php
      if ($week < 10) {
         $week = '0'. $week;
      }
      echo '<div class="calendar">';
      for ($day = 0; $day <= 6; $day++) {
         $d = strtotime($year ."W". $week . $day);
         echo '<div style="float: left;">';

         if (date('l', $d) == 'Sunday') {

            $startdate = date('Y-m-d', $d);
            $conn   = mysqli_connect("localhost", "root", "", "appo");

            $sql = "SELECT * FROM `appo` WHERE `date` = '$startdate' AND `username` = '". $_SESSION['user_id'] ."'";
               $result = mysqli_query($conn, $sql);
            echo '<div class=" eachdayinweek sun">' . date('l', $d) . '<br>' . date('d M', $d) . '</b></div>';
            for ($i = 0; $i < 24; $i++) {
               echo '<div class="droppable normal eachtimeinweek"><span class="hour  ">' . $i . "</span>.00<br>";
               echo '<input type="hidden" id="mountvalue" value="' . $month_num . '">';
               echo '<input type="hidden" id="yearvalue" value="' . $year . '">';
               echo '<input type="hidden" id="dayvalue" value="' . date('d', $d) . '">';
               if (mysqli_num_rows($result) != 0) {
                  while($row = mysqli_fetch_array($result)) {
                     $events_sun[] = $row;
                  }
                  foreach ($events_sun as $anevent) {
                     $temp = explode(':', $anevent['starttime']);

                     if ($i == $anevent['starttime']) {
                        echo ' <span class=" draggable    "  id="' . $anevent['id'] . '"> 
                               <div title = "start: '.$anevent['starttime'].'&#xA;end: '.$anevent['endtime'].' &#xA;detail: '.$anevent['detail'].'   " >  
                               <span class="draggablecss" style ="background-color: #'.$anevent['color'].'; "> '  
                               .$anevent['tilte'].'</span></div></span>';
                     }
                  }
               }
               echo '</div>';
            }
         }
         
         if (date('l', $d) == 'Monday') {
            $startdate = date('Y-m-d', $d);
            $conn = mysqli_connect("localhost", "root", "", "appo");
            $sql = "SELECT * FROM `appo` WHERE `date` = '$startdate' AND `username` = '". $_SESSION['user_id'] ."'";
               $result = mysqli_query($conn, $sql);
            echo '<div class=" eachdayinweek mon" >' . date('l', $d) . '<br>' . date('d M', $d) . '</b></div></h3>';
            for ($i = 0; $i < 24; $i++) { 
               echo '<div class="droppable normal eachtimeinweek"><span class="hour  ">' . $i . "</span>.00<br>";
               echo '<input type="hidden" id="mountvalue" value="' . $month_num . '">';
               echo '<input type="hidden" id="yearvalue" value="' . $year . '">';
               echo '<input type="hidden" id="dayvalue" value="' . date('d', $d) . '">';
               if (mysqli_num_rows($result) != 0) {
                  while ($row = mysqli_fetch_array($result)) {
                     $events_mon[] = $row;
                  }
                  foreach ($events_mon as $anevent) {
                     if ($i == $anevent['starttime']) {
                        echo ' <span class=" draggable    "  id="' . $anevent['id'] . '"> 
                               <div title = "start: '.$anevent['starttime'].'&#xA;end: '.$anevent['endtime'].' &#xA;detail: '.$anevent['detail'].'   " >  
                               <span class="draggablecss" style ="background-color: #'.$anevent['color'].'; "> '  
                               .$anevent['tilte'].'</span></div></span>';
                     }
                  }
               }
               echo '</div>';
            }
         }

         if (date('l', $d) == 'Tuesday') {
            $startdate = date('Y-m-d', $d);
            $conn = mysqli_connect("localhost", "root", "", "appo");
            $sql = "SELECT * FROM `appo` WHERE `date` = '$startdate' AND `username` = '". $_SESSION['user_id'] ."'";
               $result = mysqli_query($conn, $sql);
            echo '<div class=" eachdayinweek tue ">' . date('l', $d) . '<br>' . date('d M', $d) . '</b></div></h3>';
            for ($i = 0; $i < 24; $i++) {
               echo '<div class="droppable normal eachtimeinweek"><span class="hour " s>' . $i . "</span>.00<br>";
               echo '<input type="hidden" id="mountvalue" value="' . $month_num . '">';
               echo '<input type="hidden" id="yearvalue" value="' . $year . '">';
               echo '<input type="hidden" id="dayvalue" value="' . date('d', $d) . '">';
               if (mysqli_num_rows($result) != 0) {
                  while($row = mysqli_fetch_array($result)) {
                     $events_tue[] = $row;
                  }
                  foreach ($events_tue as $anevent) {
                     if ($i == $anevent['starttime']) {
                        echo ' <span class=" draggable    "  id="' . $anevent['id'] . '"> 
                               <div title = "start: '.$anevent['starttime'].'&#xA;end: '.$anevent['endtime'].' &#xA;detail: '.$anevent['detail'].'   " >  
                               <span class="draggablecss" style ="background-color: #'.$anevent['color'].'; "> '  
                               .$anevent['tilte'].'</span></div></span>';
                     }
                  }
               }
               echo '</div>';
            }
         }

         if (date('l', $d) == 'Wednesday') {
            $startdate = date('Y-m-d', $d);
            $conn = mysqli_connect("localhost", "root", "", "appo");
            $sql = "SELECT * FROM `appo` WHERE `date` = '$startdate' AND `username` = '". $_SESSION['user_id'] ."'";
               $result = mysqli_query($conn, $sql);
            
            echo '<div class="eachdayinweek wed ">' . date('l', $d) . '<br>' . date('d M', $d) . '</b></div></h3>';
            for ($i = 0; $i < 24; $i++) {
               echo '<div class="droppable normal eachtimeinweek"><span class="hour ">' . $i . "</span>.00<br>";
               echo '<input type="hidden" id="mountvalue" value="' . $month_num . '">';
               echo '<input type="hidden" id="yearvalue" value="' . $year . '">';
               echo '<input type="hidden" id="dayvalue" value="' . date('d', $d) . '">';
               if (mysqli_num_rows($result) != 0) {
                  while($row = mysqli_fetch_array($result)) {
                     $events_wed[] = $row;
                  }
                  foreach ($events_wed as $anevent) {
                     if ($i == $anevent['starttime']) {
                        echo ' <span class=" draggable    "  id="' . $anevent['id'] . '"> 
                               <div title = "start: '.$anevent['starttime'].'&#xA;end: '.$anevent['endtime'].' &#xA;detail: '.$anevent['detail'].'   " >  
                               <span class="draggablecss" style ="background-color: #'.$anevent['color'].'; "> '  
                               .$anevent['tilte'].'</span></div></span>';
                     }
                  }
               }
               echo '</div>';
            }
         }

         if (date('l', $d) == 'Thursday') {
            $startdate = date('Y-m-d', $d);
            $conn = mysqli_connect("localhost", "root", "", "appo");
            $sql = "SELECT * FROM `appo` WHERE `date` = '$startdate' AND `username` = '". $_SESSION['user_id'] ."'";
               $result = mysqli_query($conn, $sql);
            echo '<div class=" eachdayinweek thu" >' . date('l', $d) . '<br>' . date('d M', $d) . '</b></div></h3>';
            for ($i = 0; $i < 24; $i++) { 
               echo '<div class="droppable normal eachtimeinweek"><span class="hour  ">' . $i . "</span>.00<br>";
               echo '<input type="hidden" id="mountvalue" value="' . $month_num . '">';
               echo '<input type="hidden" id="yearvalue" value="' . $year . '">';
               echo '<input type="hidden" id="dayvalue" value="' . date('d', $d) . '">';
               if (mysqli_num_rows($result) != 0) {
                  while ($row = mysqli_fetch_array($result)) {
                     $events_thu[] = $row;
                  }
                  foreach ($events_thu as $anevent) {
                     if ($i == $anevent['starttime']) {
                        echo ' <span class=" draggable    "  id="' . $anevent['id'] . '"> 
                               <div title = "start: '.$anevent['starttime'].'&#xA;end: '.$anevent['endtime'].' &#xA;detail: '.$anevent['detail'].'   " >  
                               <span class="draggablecss" style ="background-color: #'.$anevent['color'].'; "> '  
                               .$anevent['tilte'].'</span></div></span>';
                     }
                  }
               }
               echo '</div>';
            }
         }

         if (date('l', $d) == 'Friday') {
            $startdate = date('Y-m-d', $d);
            $conn = mysqli_connect("localhost", "root", "", "appo");
            $sql = "SELECT * FROM `appo` WHERE `date` = '$startdate' AND `username` = '". $_SESSION['user_id'] ."'";
               $result = mysqli_query($conn, $sql);
            echo '<div  class="eachdayinweek fri" >' . date('l', $d) . '<br>' . date('d M', $d) . '</div>';
            for ($i = 0; $i < 24; $i++) {
               echo '<div class="droppable normal eachtimeinweek">
                        <span class="hour  ">' . $i . ".00</span><br>";
               echo '<input type="hidden" id="mountvalue" value="' . $month_num . '">';
               echo '<input type="hidden" id="yearvalue" value="' . $year . '">';
               echo '<input type="hidden" id="dayvalue" value="' . date('d', $d) . '">';
               if (mysqli_num_rows($result) != 0) {
                  while($row = mysqli_fetch_array($result)) {
                     $events_fri[] = $row;
                  }
                  foreach ($events_fri as $anevent) {
                     if ($i == $anevent['starttime']) {
                        echo ' <span class=" draggable    "  id="' . $anevent['id'] . '"> 
                               <div title = "start: '.$anevent['starttime'].'&#xA;end: '.$anevent['endtime'].' &#xA;detail: '.$anevent['detail'].'   " >  
                               <span class="draggablecss" style ="background-color: #'.$anevent['color'].'; "> '  
                               .$anevent['tilte'].'</span></div></span>';
                     }
                  }
               }
               echo '</div>';
            }
         }

         if (date('l', $d) == 'Saturday') {
            $startdate = date('Y-m-d', $d);
            $conn = mysqli_connect("localhost", "root", "", "appo");
            $sql = "SELECT * FROM `appo` WHERE `date` = '$startdate' AND `username` = '". $_SESSION['user_id'] ."'";
               $result = mysqli_query($conn, $sql);
            echo '<div class=" eachdayinweek sat" >' . date('l', $d) . '<br>' . date('d M', $d) . '</b></div></h3>';
            for ($i = 0; $i < 24; $i++) { 
               echo '<div class="droppable normal eachtimeinweek"><span class="hour  ">' . $i . "</span>.00<br>";
               echo '<input type="hidden" id="mountvalue" value="' . $month_num . '">';
               echo '<input type="hidden" id="yearvalue" value="' . $year . '">';
               echo '<input type="hidden" id="dayvalue" value="' . date('d', $d) . '">';
               if (mysqli_num_rows($result) != 0) {
                  while ($row = mysqli_fetch_array($result)) {
                     $events_sat[] = $row;
                  }
                  foreach ($events_sat as $anevent) {
                     if ($i == $anevent['starttime']) {
                        echo ' <span class=" draggable    "  id="' . $anevent['id'] . '"> 
                               <div title = "start: '.$anevent['starttime'].'&#xA;end: '.$anevent['endtime'].' &#xA;detail: '.$anevent['detail'].'   " >  
                               <span class="draggablecss" style ="background-color: #'.$anevent['color'].'; "> '  
                               .$anevent['tilte'].'</span></div></span>';
                     }
                  }
               }
               echo '</div>';
            }
         }
         
         echo '</div>';
      }
      echo '</div>';
      echo '</div>';
   ?>
   
   </div> 
</body>
</html>