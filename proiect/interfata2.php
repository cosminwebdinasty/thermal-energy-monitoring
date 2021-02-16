<?php
	
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'proiect';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	$data1 = '';
	$data2 = '';

	$sql = "SELECT * FROM `datesenzor` ";
    $result = mysqli_query($mysqli, $sql);

	while ($row = mysqli_fetch_array($result)) {

		$data1 = $data1 . '"'. $row['temperatura'].'",';
		$data2 = $data2 . '"'. $row['temperatura'] .'",';
		
	}   

	$data1 = trim($data1,",");
	$data2 = trim($data2,",");
?>

<?php
require('db.php');
include("redirectare.php");
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<title>Interfata</title>
<link rel="stylesheet" href="style.css" /> 

<style type="text/css">
body {
	background-color: #f6f6ff;
	font-family: Calibri, Myriad;
}


#main {
	width: 780px;
	padding: 20px;
	margin: auto;
}

table.timecard {
	margin: auto;
	width: 500px;
	border-collapse: collapse;
	border: 1px solid #fff; /*for older IE*/
	border-style: hidden;
}

table.timecard caption {
	background-color: #f79646;
	color: #fff;
	font-size: x-large;
	font-weight: bold;
	letter-spacing: .3em;
}

table.timecard thead th {
	padding: 8px;
	background-color: #fde9d9;
	font-size: large;
}

table.timecard thead th#thDay {
	width: 40%;	
}

table.timecard thead th#thRegular, table.timecard thead th#thOvertime, table.timecard thead th#thTotal {
	width: 20%;
}

table.timecard th, table.timecard td {
	padding: 3px;
	border-width: 1px;
	border-style: solid;
	border-color: #f79646 #ccc;
}

table.timecard td {
	text-align: right;
}

table.timecard tbody th {
	text-align: left;
	font-weight: normal;
}

table.timecard tfoot {
	font-weight: bold;
	font-size: large;
	background-color: #687886;
	color: #fff;
}

table.timecard tr.even {
	background-color: #fde9d9;
}
</style>

<style>

input[type=button], input[type=submit], input[type=reset] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  position:absolute;
    transition: .5s ease;
    top: 34%;
    left: 78%;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
 float: right;
  display: block;
}
</style>
<style type="text/css">			
			body{
				font-family: Arial;
			    margin: 80px 100px 10px 100px;
			    padding: 0;
			    color: white;
			    text-align: center;
			    background: #555652;
			}
			

			.container {
				color: #E8E9EB;
				background: #222;
				border: #555652 1px solid;
				padding: 10px;
			}
		</style>
<style type="text/css">			
			body{
				font-family: Arial;
			    margin: 80px 100px 10px 100px;
			    padding: 0;
			    color: white;
			    text-align: center;
			    background: #555652;
			}

			.container {
				color: #E8E9EB;
				background: #222;
				border: #555652 1px solid;
				padding: 10px;
			}
		</style>	
<style>
canvas{

  width:580px !important;
  height:350px !important;

}
</style>

<style>
#content-wrapper{
	position: absolute;
	top: 116px;
	left: 500px;
	width: 80%;
	height: 514px;
	margin: 0px auto;
}
#lhs{
	position: relative;
	float: left;
	height: 514px;
	width: 51%;
	text-align: center;
}

#content-wrapper2{
	position: absolute;
	top: 420px;
	left: 155px;
	width: 80%;
	height: 514px;
	margin: 0px auto;
    z-index: 1;

</style>
<style>
.button {
    position:absolute;
    transition: .5s ease;
    top: 50%;
    left: 50%;
	
#form{
 z-index: 1;
}	
	
}
</style>

</head>
<body>
<pre class="tab">
<div class="form">
<p ><h2><a href="test.php">Rulare exe</a>	<a href="inregistrare.php">Cont nou</a>	<a href="despre.php">Despre aplicație</a>	<a href="delogare.php">Logout</a>			Utilizator autentificat: <?php echo $_SESSION['username']; ?> </h2></a></p>

</pre>

<div class="split left">
  <div class="centered">
<div style="padding-left:16px">

  <?php
	date_default_timezone_set("Europe/Bucharest");
	echo "<h2>" . date("h:i:sa") ."<br>";
	echo "<h2>" . date("Y/m/d") . "<br>";
  ?>
  <br><br>
  <hr>
  
</div>
			
		   <br><br><br>

	        <div class="chart-container" style="position: relative; height:40vh; width:80vw">
	   <h3 style="text-align:left">Reprezentarea grafică a valorilor din BD MySQL</h3><br>
			<canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

			<script>
				var ctx = document.getElementById("chart").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'line',
		        data: {
		            labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25,26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252],
		            
					datasets: 
		            [{
		                label: 'Temperatura [°C]',
		                data: [<?php echo $data1; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(255,99,132)',
		                borderWidth: 3
		           	
		            }]
		        }, 
		     
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
		        }
		    });
			</script>
	    </div>
 <?php
	/* Database connection settings */
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'proiect';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	$data5 = '';
	$data6 = '';

	//query to get data from the table
	$sql = "SELECT * FROM `datesenzor` ";
    $result = mysqli_query($mysqli, $sql);

	//loop through the returned data
	while ($row = mysqli_fetch_array($result)) {

		$data5 = $data5 . '"'. $row['energia'].'",';
		$data6 = $data6 . '"'. $row['energia'] .'",';
	}   

	$data5 = trim($data5,",");
	$data6 = trim($data6,",");
?>

<br><br> 
 

			<br><br><br><br><br><br><br><br><br><br><br>
   
	     <div class="chart-container" style="position: relative; height:40vh; width:80vw">		
	<!--    <h1>Energia [W]</h1>  -->      
			<canvas id="chart2" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

			<script>
				var ctx2 = document.getElementById("chart2").getContext('2d');
    			var myChart = new Chart(ctx2, {
        		type: 'line',
		        data: {
		            labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25,26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252],
		            
					datasets: 
		            [{
		                label: 'Energia [W]',
		                data: [<?php echo $data5; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(0,255,255)',
		                borderWidth: 3
		           }]
		        }, 
		     
		        options: {
					
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
		        }
		    });
			</script>
			</div>
 
 </div>





<br><br><br><br><br><br><br><br><br><br>
 


<div id="content-wrapper2">
<h3 style="text-align:right">SBC pentru monitorizarea consumului termic</h3><br>
<span><p style="text-align:right">Introduceți numărul de ore de funcționare :</span>
<form name="register_form" action="interfata2.php" method="post">
<span style="float:right;"><input size="45" type="text" name="a" align="right" maxlength="5" ></span>

<br><br>
<input type="SUBMIT" value="Confirmare">
<br>
</div>
<div id="content-wrapper">
      <div id="rhs">
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="main">
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
	
if (isset($_POST['submit'])) {  
	$a=$_POST['a'];
}

	include("db_config.php");
    $query = $db->get_results("SELECT * FROM datesenzor");
    $count = 0;
    foreach ( $query as $result ) {
        $temperatura = $result->temperatura;
        $count++;
		
		echo '<table class="timecard">';
		echo '<th>Temperatura</th>';
		echo '<th>Consum</th>';
        echo '<tr>';

	//MINIM
		if (($_POST['a']<=8) && ($temperatura <=15))
		{
	
	echo '
	
            <td>
          	<p id="p-symptoms">'.$temperatura.'°C</p>
			
            </td>
        ';
		
		echo '<td><i style="color:green;font-size:16px;font-family:calibri ;">
       Consum minim </i></td> ';
	   
	   echo '<td><img src=png/1.png></td>';
	
		}
		
	//FOARTE MIC
			if (($_POST['a']>=9) && ($_POST['a']<=16) && ($temperatura <=15))
		{
	
	echo '
	
            <td>
          	<p id="p-symptoms">'.$temperatura.'°C</p>
            </td>
        ';
		
		echo '<td><i style="color:#2E8B57;font-size:16px;font-family:calibri ;">
      Consum foarte mic</td></i> ';
	
	echo '<td><img src=png/2.png></td>';
		}
		
	//MIC
			if (($_POST['a']>=17) && ($_POST['a']<=24) && ($temperatura <=15))
		{
	
		
	echo '
	
            <td>
          	<p id="p-symptoms">'.$temperatura.'°C</p>
            </td>
        ';
	echo '<td><i style="color:#006400;font-size:16px;font-family:calibri ;">
      Consum mic</i></td> ';
	  
	  echo '<td><img src=png/3.png></td>';
		}
		
	//-<<MEDIU
		else if(($_POST['a']<=8) && ($temperatura >=16) && ($temperatura <=26))
		{
		
	echo '
	
            <td>
          	<p id="p-symptoms">'.$temperatura.'°C</p>
            </td>
        ';
			echo '<td><i style="color:orange;font-size:16px;font-family:calibri ;">
      Consum mediu-</i></td> ';
	  
	  
	  echo '<td><img src=png/4.png></td>';
	
		}
		
	//MEDIU
			else if(($_POST['a']>=9) && ($_POST['a']<=16) && ($temperatura >=16) && ($temperatura <=26))
		{
		
	echo '
	
            <td>
          	<p id="p-symptoms">'.$temperatura.'°C</p>
            </td>
        ';
		echo '<td><i style="color:#FF8C00;font-size:16px;font-family:calibri ;">
      Consum mediu</i></td> ';
	  
	  echo '<td><img src=png/5.png></td>';
		}
		
		
	//MEDIU>>+
		else if(($_POST['a']>=17) && ($_POST['a']<=24) &&  ($temperatura >=16) && ($temperatura <=26))
		{
		
	echo '
	
            <td>
          	<p id="p-symptoms">'.$temperatura.'°C</p>
            </td>
        ';
			echo '<td><i style="color:#B8860B;font-size:16px;font-family:calibri ;">
      Consum mediu+</i></td> ';
	
	echo '<td><img src=png/6.png></td>';
		}
		
	//MARE	
		else if(($_POST['a']<=8) && ($temperatura >=27) && ($temperatura <=37))
		{
		
	echo '
	
            <td>
          	<p id="p-symptoms">'.$temperatura.'°C</p>
            </td>
        ';
		echo '<td><i style="color:red;font-size:16px;font-family:calibri ;">
      Consum mare</i></td> ';
	  
	  echo '<td><img src=png/7.png></td>';
		}
		
		
		//FOARTE MARE	
		else if(($_POST['a']>=9) && ($_POST['a']<=16) && ($temperatura >=27) && ($temperatura <=37))
		{
		
	echo '
	
            <td>
          	<p id="p-symptoms">'.$temperatura.'°C</p>
            </td>
       ';
		echo '<td><i style="color:red;font-size:16px;font-family:calibri ;">
      Consum foarte mare</i></td> ';
	  
	  echo '<td><img src=png/8.png></td>';
		}
		
		//MAXIM	
		else if(($_POST['a']>=17) && ($_POST['a']<=24) && ($temperatura >=27) && ($temperatura <=37))
		{
			
	echo '
	
            <td>
          	<p id="p-symptoms">'.$temperatura.'°C</p>
            </td>
        ';
	echo '<td><i style="color:brown;font-size:16px;font-family:calibri ;">
      Consum maxim</i></td> ';
	  
	  echo '<td><img src=png/9.png></td>';
		}
		echo '</tr>';
		echo '</table>';
	}
    
	
    echo '<input type="hidden" name="count" id="count" value="'.$count.'">'; 
	
?>
</body>
</html>