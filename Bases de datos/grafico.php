<?php
	$conexion=mysqli_connect('localhost','root','','gpstoreapps');

	$sql="SELECT AppName,MinimumInstalls,MaximumInstalls FROM `google_playstore`";
	$result=mysqli_query($conexion,$sql);
	foreach ($result as $data) {
    	$appname[] = $data['AppName'];
		$installmin[] = $data['MinimumInstalls'];
		$installmax[] = $data['MaximumInstalls'];
	}	
 
	$dataPoints = array();
	
	for ($i = 0; $i < 147209; $i++) {
    	array_push($dataPoints, array("label"=> $appname[$i], "y"=> array($installmin[$i],$installmax[$i])));
	}
 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HackZit - Bases de Datos</title>
<link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	 
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
    zoomEnabled: true,
	options: {
			maintainAspectRatio: false
        },
	title: {
		text: "AppName based on installs"
	},
	axisY:{
		title: "Installs (I)",
		suffix: "I",
		logarithmic: true
	},
	toolTip: {
		shared: true,
		reversed: true
	},
	theme: "dark1",
	data: [
		{
			type: "rangeBar",
			indexLabel: "{y[#index]} I",
			toolTipContent: "<b>{label}</b>: {y[0]} I to {y[1]} I",
			dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		}
	]
	
});
 
chart.render();
 
}
</script>	
</head>
<body>
	
<div class="container">
  <header>
    <div class="primary_header">
		
      <h1 class="title" >HackZit - Bases de Datos</h1>
    </div>
    <nav class="secondary_header" id="menu">
      <ul>
		  <li><img src="images/logo_transparent.png"  class="logo"></li>
        <li><a href="index.html" class="nav-enlace">Home Page</a></li>
        <li><a href="grafico.php" class="nav-enlace">Graficos</a></li>
		  <li><a href="index.html" class="nav-enlace">Base de Datos</a></li>
		  <li><a href="https://www.uninorte.edu.co/" class="nav-enlace">Universidad del Norte</a></li>
		  
      </ul>
    </nav>
  </header>


<div id="chartContainer" style="height: 605px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <footer class="secondary_header footer">
	  
    <div class="copyright">&copy;2021 - <strong>SIMPLE Theme</strong></div>
  </footer>
</div>
</body>
</html>
