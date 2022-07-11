<?php
include_once 'excode/includes/db_connect.php';
  include_once 'excode/includes/functions.php';

sec_session_start();
if (!(login_check($mysqli) == true))
{
		header('Location: excode/index.php');
   		exit();
}

?>
<!DOCTYPE html>
<html>
		<head>
				<title>Daily Calendar</title>
				<meta charset="UTF-8">
        <link rel="stylesheet" href="style1.css" />
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
    $(document).ready(function() {
      $(".draggable").draggable({
        revert: "invalid",
        snap: true,
        snapMode: "inner"
      });

      $(".droppable").droppable({
        accept: ".draggable", 
        drop: function(event, ui) {
          var dropID = ui.draggable.attr('id');
          var drop = $(this).children(".hour").text();
          var day = $(this).children("#dayvalue").val();
                  var month = $(this).children("#mountvalue").val();
                  var year = $(this).children("#yearvalue").val();
                  var send_day = year + "-" + month + "-" + day;
          var send = drop;
          console.log(send);
          $.ajax({
            url:"handlerday.php",
            method:"POST",
                      data:{starttime:send,date:send_day,event:dropID},
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

    <style>


div.date, div.days{ 
  width: 13%;  
    float: left; 
    margin: 1px;
  color: #121313;
  border: 1px solid #F8F7E9; 
  z-index: 0;
padding: 10px; 

} 

div.date{ 
   height: 120px;
   color: black;

} 

</style>

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

	if(isset($_GET['next']))
	{
		$_SESSION['date'] = date("d-m-Y",strtotime("+1 month",strtotime($_SESSION['date'])));
	}
	else if(isset($_GET['prev']))
	{
		$_SESSION['date'] = date("d-m-Y",strtotime("-1 month",strtotime($_SESSION['date'])));
	}
	else if(isset($_GET['now']))
	{
		$_SESSION['date'] = date("d-m-Y",strtotime("now"));
	}

	

	 $day = date('d', strtotime($_SESSION['date']));      //Gets day of appointment (1‐31) 
	 $month = date('m', strtotime($_SESSION['date']));      //Gets month of appointment (1‐12) 
	 $year = date('Y', strtotime($_SESSION['date']));      //Gets year of appointment (e.g. 2016) 
	 $firstday = date('w', strtotime('01-' . $month . '-' . $year));  //Gets the day of the week for the 1st of  
								 //the month. (e.g. 0 for Sun, 1 for Mon) 
	 $days = date('t', strtotime($_SESSION['date']));      //Gets number of days in month 

	 $today = date('d');            //Gets today’s date 
	 $todaymonth = date('m');          //Gets today’s month 
	 $todayyear = date('Y');            //Gets today’s year
	 if(isset($_GET['title'])){
    $title = $_GET['title']; //get appointment title
  }  

   $today = date('d');            //Gets today’s date 
   $todaymonth = date('m');          //Gets today’s month 
   $todayyear = date('Y');            //Gets today’s year 

   if(isset($_GET['detail'])){
    $detail = $_GET['detail'];
  }
  else{
    $detail = '';
  }

  if(isset($_GET['$starttime'])){
    $start_time = $_GET['starttime'];    
  }
   
  if(isset($_GET['$endtime'])){
    $end_time = $_GET['endtime'];  
  }
  if(isset($_GET['$color'])){
    $color = $_GET['color'];
  }
?>

<?php
 $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "appo";

if(isset($_GET['addappo']))
{
   $conn = new mysqli($servername,$username,$password,$dbname);
   $color = explode('#', $_GET['color']);
    $color = implode('', $color);
    if ($qry = "INSERT INTO `appo` (`id`, `username`, `tilte`, `date`, `starttime`, `endtime`, `detail`, `color`) 
    VALUES (NULL, '" .$_SESSION['user_id']. "', '".$title."', '".$_GET['date']."', '".$_GET['starttime']."', '".$_GET['endtime']."', '".$detail."', '".$color."')") {
      $color = explode('#', $_GET['color']);
      $color = implode('', $color);
      $conn->query($qry);
      echo $conn->error;
      $conn->close();

    header('Location: dayview.php?date='.$_GET['date']);
   }
}
  $fornow = date('d-F-Y', strtotime($_SESSION['date']));
?>



    <div style="width: 1435px;" id="all">
      <div style="position: relative;height: 30px;top: 20px;">
          
          <div class="allbottom">
                <a title="Previous Month" class="button" href="?prev">
                    &lt;
                </a> <!-- //ใส่ให้ตัวอักษรเด้งขึนมา  -->
                <a class="button"title="<?php echo $fornow; ?>" href="?now">
                    NOW
                </a> <!-- //ใส่ให้ตัวอักษรเด้งขึนมา  -->
                <a class="button" title="Next Month" href="?next">
                    &gt;
                </a> <!-- //ใส่ให้ตัวอักษรเด้งขึนมา  -->
          </div>
            
            <div style="  z-index: 4;position: absolute;top: 0px; right: 150px;" class="ul" >
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

  <?php 
          $d1 = date('d', strtotime($_SESSION['date']));
          $m1 = date('F', strtotime($_SESSION['date']));
          echo '<div style="left:500px;" class="intop">' ;
          //echo $d1 . ', ' . $m1 . ' ' . $year. '</br>' . 'Day ' . $day ;
          echo '<span id = dayvalue" value = "'.$day .'">'.$d1.'</span>
                <span id="mountvalue" value="' . $month . '">' . $m1 . '</span> 
                <span id="yearvalue" value="' . $year . '">' . $year . '</span>';

          echo '</div>';

      ?>
        </div>



		 <div style="position: relative;top: 50px;">
       
        <div class="inleftday" style="left: 20px;">

		

            <p><span style="font-size: 20px"> Welcome
                    <?php echo htmlentities($_SESSION['username']); ?>!</span></p>
            <div id="contact" style="position: relative;">ADD</div>
            <div id="contactForm">
                <form  action="calendarfn.php" method="post">
                    Date: <input type="date" id="date" name="date"></br>
                    Title: <input type="text" name="title"><br />
                    Time: <input type="Time" name="starttime">
                    To <input type="Time" name="endtime"><br />
                    Detail: <input type="text" name="detail"><br />
                    Color:<input type="color" name="color"><br />
                    <input type="submit" class="formBtn" name="addappo" value="Submit!">
                </form>
            </div>
        
    			 <div class="calendarinday">
                    <div class="days sun">Sun</div>
                    <div class="days mon">Mon</div>
                    <div class="days tue">Tus</div>
                    <div class="days wed">Wed</div>
                    <div class="days thu">Thu</div>
                    <div class="days fri">Fri</div>
                    <div class="days sat">Sat</div>

    					<?php
    						for($i=1; $i<=$firstday; $i++) 
    						 { 
    								echo '<div class="date blankday"></div>'; 
    						 } 

    							for($i=1; $i<=$days; $i++) 
    						 { 
    								echo '<div class="date  '; 
    								if ($today == $i && $todaymonth==$month && $todayyear == $year) 
    								{ 
    									echo 'today'; 
    								} 
    									echo '"> <a href="?date=' . date("d-m-Y",strtotime(date($i."-m-Y",strtotime($_SESSION['date'])))) . '"><span class="dayvalue">' . $i . '</span></a> <br>'; 
    					//echo '"><span class="dayvalue">' . $i . '</span><br>'; 

    								
    								echo  '</div>'; 
    						 }

    						$daysleft = 7-(($days + $firstday)%7); 
    						 if($daysleft<7) 
    						 { 
    								for($i=1; $i<=$daysleft; $i++) 
    								{ 
    									 echo '<div class="date blankday"></div>'; 
    								} 
    						 } 

    					?>
    			</div>
     </div>

		


		   <div class="inrightday" id="inright">

			 <div class="calendar2">  
							<?php
							$servername = "localhost";
						    $username = "root";
						    $password = "";
						    $dbname = "appo";


							$con = mysqli_connect($servername,$username,$password,$dbname);
							$app_date = date($year.'-'.$month.'-'.$day);
							$sql = "SELECT * FROM `appo` WHERE `date` = '$app_date' AND username = '" . $_SESSION['user_id'] . "'" or die("Error:" . mysqli_error()); 
							$result = mysqli_query($con, $sql); 



								if(mysqli_num_rows($result) != 0)
								{
									while ($row = mysqli_fetch_array($result)) 
									{
										$row['starttime'] = date('H:i', strtotime($row['starttime']));
										$row['endtime'] = date('H:i', strtotime($row['endtime']));
										$row['detail'] =($row['detail']); 
										$row['color'] = ($row['color']);
										$events[] = $row;
									}
								}

							for ($i = 0; $i < 24; $i++) 
							{ 

								echo '<div style="position:relative;" class="droppable normal eachtime  "> <span class="hour" style="float: left;">' .$i . '.00</span>' ;
								 echo '<input type="hidden" id="mountvalue" value="' . $month . '">';
               echo '<input type="hidden" id="yearvalue" value="' . $year . '">';
               echo '<input type="hidden" id="dayvalue" value="' . $day . '">';
									
									if(isset($events))
									{
										foreach ($events as $anevent) 
										{
											if ($i == $anevent['starttime']) 
											{
												
												echo ' <span class=" draggable    "  id="' . $anevent['id'] . '"> 
													   <div title = "start: '.$anevent['starttime'].'&#xA;end: '.$anevent['endtime'].' &#xA;detail: '.$anevent['detail'].'   " >  
												  	   <span style class="draggablecss" ="background-color: #'.$anevent['color'].'; "> '  
												  	   .$anevent['tilte'].'</span></div></span>';

												
											}
										}
									}	 
								echo '</div>';

							}


								
					?>
			</div>
			

		  </div>
    </div>
  </div>



</body>
</html>