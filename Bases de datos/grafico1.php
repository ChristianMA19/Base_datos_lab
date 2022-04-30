<?php
	$conexion=mysqli_connect('localhost','root','','gpstoreapps');

	$sql1="SELECT Category, AVG(Price) price FROM `google_playstore` WHERE Price != 0 GROUP BY Category;";
	$sql2="SELECT Category, AVG(MinimumInstalls) Minimum FROM `google_playstore` WHERE MinimumInstalls != 0 GROUP BY Category;";
	$sql3="SELECT Category, AVG(MaximumInstalls) Maximum FROM `google_playstore` WHERE MaximumInstalls != 0 GROUP BY Category;";
	$result1=mysqli_query($conexion,$sql1);
	$result2=mysqli_query($conexion,$sql2);
	$result3=mysqli_query($conexion,$sql3);
	foreach ($result1 as $data) {
    	$category[] = $data['Category'];
		$price[] = $data['price'];
	}	
	foreach ($result2 as $data) {
		$installmin[] = $data['Minimum'];
	}	
	foreach ($result3 as $data) {
		$installmax[] = $data['Maximum'];
	}	
 
	function console_log($output, $with_script_tags = true) {
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
	');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}
 	
	$dataPoints1 = array();	
	$dataPoints2 = array();	
	$dataPoints3 = array();	
	
	for ($i = 0; $i < count($category); $i++) {
		array_push($dataPoints1, array("y" => $price[$i], "label" => $category[$i])); 
		array_push($dataPoints2, array("y" => $installmin[$i], "label" => $category[$i])); 
		array_push($dataPoints3, array("y" => $installmax[$i], "label" => $category[$i])); 
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
	 
<script type="text/javascript">
	
			
							
window.onload = function () {
 			
				var amountData = document.getElementById('Amount');
				var TypeData = document.getElementById('rows');
				amountData.addEventListener( "change",  function(){
				var am = parseInt(amountData.options[amountData.selectedIndex].value);
				console.log(am);
				
				var type = parseInt(TypeData.options[TypeData.selectedIndex].value)
				switch(type) {
				  case 1:
					var dataJSon= <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>;
					break;
				  case 2:
					var dataJSon= <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>;
					break;
				  case 3:
					var dataJSon= <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>;
					break;
				  default:
					// code block
				}
					
				
				var dataJS = new Array(am)
				for (i=0; i<am; i++) {

					//dataJS[i]=[appname[i],[installmin[i],installmax[i]]];
					dataJS[i]=dataJSon[i];
				}
				console.log(dataJS);	
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					zoomEnabled: true,
					theme: "dark1",
					options: {
								maintainAspectRatio: false
							},
					title:{
						text: "Categorys"
					},
					axisY: {
						title: "Quantity",
						logarithmic: true
					},
					axisX: {						
						labelAngle: 90,
						labelAutoFit: true,
						labelPlacement: "inside",
						interval: 1
					},
					data: [{
						type: "column",
						dataPoints: dataJS
					}]
				});

					chart.render();
					
			});
	
			TypeData.addEventListener( "change",  function(){
				var am = parseInt(amountData.options[amountData.selectedIndex].value);
				console.log(am);
				var TypeData = document.getElementById('rows')
				var type = parseInt(TypeData.options[TypeData.selectedIndex].value)
				switch(type) {
				  case 1:
					var dataJSon= <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>;
					break;
				  case 2:
					var dataJSon= <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>;
					break;
				  case 3:
					var dataJSon= <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>;
					break;
				  default:
					// code block
				}
					
				
				var dataJS = new Array(am)
				for (i=0; i<am; i++) {

					//dataJS[i]=[appname[i],[installmin[i],installmax[i]]];
					dataJS[i]=dataJSon[i];
				}
				console.log(dataJS);	
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					zoomEnabled: true,
					theme: "dark1",
					options: {
								maintainAspectRatio: false
							},
					title:{
						text: "Categorys"
					},
					axisY: {
						title: "Quantity",
						logarithmic: true
					},
					axisX: {						
						labelAngle: 90,
						labelAutoFit: true,
						labelPlacement: "inside",
						interval: 1
					},
					data: [{
						type: "column",
						dataPoints: dataJS
					}]
				});

					chart.render();
					
			});
	
	
	var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					zoomEnabled: true,
					theme: "dark1",
					zoomEnabled: true,
					options: {
								maintainAspectRatio: false
							},
					title:{
						text: "Categorys"
					},
					axisY: {
						title: "Quantity",
						logarithmic: true
					},
					axisX: {						
						labelAngle: 90,
						labelAutoFit: true,
						labelPlacement: "inside",
						interval: 1
					},
					data: [{
						type: "column",
						dataPoints: 0
					}]
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
		  <li><a href="index.html" class="nav-enlace">Base de Datos</a></li>
		  <li><a href="https://www.uninorte.edu.co/" class="nav-enlace">Universidad del Norte</a></li>
		  
      </ul>
    </nav>
  </header>

<div>Amount of data to show:
  <select id="Amount" name="Cantidad">
	<option value="" selected disabled hidden>Choose here</option>
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="20">20</option>
    <option value="30">30</option>
    <option value="40">40</option>.
	<option value="48">All</option>
  </select>  
</div>
	<div>Category vs:
  <select id="rows" name="DataRow">
	<option value="" selected disabled hidden>Choose here</option>
    <option value="1">Price</option>
	<option value="2">Minimum Installs</option>
    <option value="3">Maximum Installs</option>
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
