<?php
	$conexion=mysqli_connect('localhost','root','','gpstoreapps');

	$sql="SELECT AppName,MinimumInstalls,MaximumInstalls FROM `google_playstore`";
	$result=mysqli_query($conexion,$sql);
	foreach ($result as $data) {
    	$appname[] = $data['AppName'];
		$installmin[] = $data['MinimumInstalls'];
		$installmax[] = $data['MaximumInstalls'];
	}	
 
	function console_log($output, $with_script_tags = true) {
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
	');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}
 	
	$dataPoints = array();	
	
	for ($i = 0; $i < 147209; $i++) {
		array_push($dataPoints, array("label"=> $appname[$i], "y"=> array($installmin[$i],$installmax[$i]))); 
	}

	$datajson=json_encode($dataPoints, JSON_NUMERIC_CHECK);
	$appnamejson=json_encode($appname, JSON_NUMERIC_CHECK);
	$installminjson=json_encode($installmin, JSON_NUMERIC_CHECK);
	$installmaxjson=json_encode($installmax, JSON_NUMERIC_CHECK);
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
	 
<script type="text/javascript">
	
			
							
window.onload = function () {
 			
				var amountData = document.getElementById('Amount');
				amountData.addEventListener( "change",  function(){
				var am = parseInt(amountData.options[amountData.selectedIndex].value);
				console.log(am);
				
				
				var dataJSon= <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
				var dataJS = new Array(am)
				for (i=0; i<am; i++) {

					//dataJS[i]=[appname[i],[installmin[i],installmax[i]]];
					dataJS[i]=dataJSon[i];
				}
				console.log(dataJS);	
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
							title: "Installs",
							suffix: "",
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
								toolTipContent: "<b>{label}</b>: {y[0]} to {y[1]}",
								dataPoints: dataJS
							}
						]

					});
					chart.render();
					
			});
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
							title: "Installs",
							suffix: "",
							logarithmic: true
						},
						axisX:{
							labelPlacement: "inside"
						},
						toolTip: {
							shared: true,
							reversed: true
						},
						theme: "dark1",
						data: [
							{
								type: "rangeBar",
								toolTipContent: "<b>{label}</b>: {y[0]} to {y[1]}",
								dataPoints: 0
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
        <li><a href="grafico1.php" class="nav-enlace">Grafico 1</a></li>
		  <li><a href="grafico2.php" class="nav-enlace">Grafico 2</a></li>
		<li><a href="grafico3.php" class="nav-enlace">Grafico 3</a></li>
		<li><a href="grafico.php" class="nav-enlace">Grafico 4</a></li>
		  <li><a href="Base-de-datos.php" class="nav-enlace">Base de Datos</a></li>
		  <li><a href="https://www.uninorte.edu.co/" class="nav-enlace">Universidad del Norte</a></li>
		  
      </ul>
    </nav>
  </header>

<div class="select">Amount of data to show:
  <select id="Amount" name="Cantidad">
	<option value="" selected disabled hidden>Choose here</option>
    <option value="25">25</option>
    <option value="50">50</option>
    <option value="100">100</option>
    <option value="500">500</option>
    <option value="2000">2000</option>.
	<option value="147209">All</option>
  </select>  
</div>
<div id="chartContainer" style="height: 605px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <footer class="secondary_header footer">
	  
    <div class="copyright">&copy;2021 - <strong>SIMPLE Theme</strong></div>
  </footer>
</div>
</body>
</html>
