<?php
	$conexion=mysqli_connect('localhost','root','','gpstoreapps');

	$sql11="SELECT Category, COUNT(AdSupported) AdSupported FROM `google_playstore` WHERE AdSupported = 'True' GROUP BY Category;";
	$sql12="SELECT Category, COUNT(AdSupported) AdSupported FROM `google_playstore` WHERE AdSupported = 'False' GROUP BY Category;";
	$sql21="SELECT Category, COUNT(InAppPurchases) InAppPurchases FROM `google_playstore` WHERE InAppPurchases = 'True' GROUP BY Category;";
	$sql22="SELECT Category, COUNT(InAppPurchases) InAppPurchases FROM `google_playstore` WHERE InAppPurchases = 'False' GROUP BY Category;";
	$sql31="SELECT Category, COUNT(Free) Free FROM `google_playstore` WHERE Free = 'True' GROUP BY Category;";
	$sql32="SELECT Category, COUNT(Free) Free FROM `google_playstore` WHERE Free = 'False' GROUP BY Category;";
	$result11=mysqli_query($conexion,$sql11);
	$result21=mysqli_query($conexion,$sql21);
	$result31=mysqli_query($conexion,$sql31);
	$result12=mysqli_query($conexion,$sql12);
	$result22=mysqli_query($conexion,$sql22);
	$result32=mysqli_query($conexion,$sql32);
	foreach ($result11 as $data) {
    	$category[] = $data['Category'];
		$AdSupportedT[] = $data['AdSupported'];
	}	
	foreach ($result12 as $data) {
		$AdSupportedF[] = $data['AdSupported'];
	}	
	foreach ($result21 as $data) {
		$InAppPurchasesT[] = $data['InAppPurchases'];
	}	
	foreach ($result22 as $data) {
		$InAppPurchasesF[] = $data['InAppPurchases'];
	}	
	foreach ($result31 as $data) {
		$FreeT[] = $data['Free'];
	}	
	foreach ($result32 as $data) {
		$FreeF[] = $data['Free'];
	}	
 
 
	function console_log($output, $with_script_tags = true) {
		$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
	');';
		if ($with_script_tags) {
			$js_code = '<script>' . $js_code . '</script>';
		}
		echo $js_code;
	}
 	
	$dataPoints11 = array();	
	$dataPoints21 = array();	
	$dataPoints31 = array();	
	$dataPoints12 = array();	
	$dataPoints22 = array();	
	$dataPoints32 = array();	
	
	for ($i = 0; $i < count($category); $i++) {
		array_push($dataPoints11, array("label"=> $category[$i], "y"=> $AdSupportedT[$i])); 
		array_push($dataPoints12, array("label"=> $category[$i], "y"=> $AdSupportedF[$i])); 
		array_push($dataPoints21, array("label"=> $category[$i], "y"=> $InAppPurchasesT[$i])); 
		array_push($dataPoints22, array("label"=> $category[$i], "y"=> $InAppPurchasesF[$i])); 
		array_push($dataPoints31, array("label"=> $category[$i], "y"=> $FreeT[$i])); 
		array_push($dataPoints32, array("label"=> $category[$i], "y"=> $FreeF[$i]));
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
					var dataJSon1= <?php echo json_encode($dataPoints11, JSON_NUMERIC_CHECK); ?>;
					var dataJSon2= <?php echo json_encode($dataPoints12, JSON_NUMERIC_CHECK); ?>;
					break;
				  case 2:
					var dataJSon1= <?php echo json_encode($dataPoints21, JSON_NUMERIC_CHECK); ?>;
					var dataJSon2= <?php echo json_encode($dataPoints22, JSON_NUMERIC_CHECK); ?>;
					break;
				  case 3:
					var dataJSon1= <?php echo json_encode($dataPoints31, JSON_NUMERIC_CHECK); ?>;
					var dataJSon2= <?php echo json_encode($dataPoints32, JSON_NUMERIC_CHECK); ?>;
					break;
				  default:
					// code block
				}
					
				
				var dataJS1 = new Array(am)
				var dataJS2 = new Array(am)
				for (i=0; i<am; i++) {

					//dataJS[i]=[appname[i],[installmin[i],installmax[i]]];
					dataJS1[i]=dataJSon1[i];
					dataJS2[i]=dataJSon2[i];
				}
				var chart = new CanvasJS.Chart("chartContainer", {
					title: {
						text: "Categorys"
					},
					options: {
								maintainAspectRatio: false
							},
					theme: "dark1",
					animationEnabled: true,
					zoomEnabled: true,
					toolTip:{
						shared: true,
						reversed: false
					},
					axisY: {
						logarithmic: true
					},
					axisX: {						
						labelAngle: 90,
						labelAutoFit: true,
						labelPlacement: "inside",
						interval: 1
					},
					legend: {
						cursor: "pointer",
						itemclick: toggleDataSeries
					},
					data: [
						{
							type: "stackedColumn",
							name: "Yes",
							showInLegend: true,
							dataPoints: dataJS1
						},{
							type: "stackedColumn",
							name: "No",
							showInLegend: true,
							dataPoints: dataJS2
						}
					]
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
					var dataJSon1= <?php echo json_encode($dataPoints11, JSON_NUMERIC_CHECK); ?>;
					var dataJSon2= <?php echo json_encode($dataPoints12, JSON_NUMERIC_CHECK); ?>;
					break;
				  case 2:
					var dataJSon1= <?php echo json_encode($dataPoints21, JSON_NUMERIC_CHECK); ?>;
					var dataJSon2= <?php echo json_encode($dataPoints22, JSON_NUMERIC_CHECK); ?>;
					break;
				  case 3:
					var dataJSon1= <?php echo json_encode($dataPoints31, JSON_NUMERIC_CHECK); ?>;
					var dataJSon2= <?php echo json_encode($dataPoints32, JSON_NUMERIC_CHECK); ?>;
					break;
				  default:
					// code block
				}
					
				
				var dataJS1 = new Array(am)
				var dataJS2 = new Array(am)
				for (i=0; i<am; i++) {

					//dataJS[i]=[appname[i],[installmin[i],installmax[i]]];
					dataJS1[i]=dataJSon1[i];
					dataJS2[i]=dataJSon2[i];
				}	
				var chart = new CanvasJS.Chart("chartContainer", {
					title: {
						text: "Categorys"
					},
					options: {
								maintainAspectRatio: false
							},
					theme: "dark1",
					animationEnabled: true,
					zoomEnabled: true,
					toolTip:{
						shared: true,
						reversed: false
					},
					axisY: {
						logarithmic: true
					},
					axisX: {						
						labelAngle: 90,
						labelAutoFit: true,
						labelPlacement: "inside",
						interval: 1
					},
					legend: {
						cursor: "pointer",
						itemclick: toggleDataSeries
					},
					data: [
						{
							type: "stackedColumn",
							name: "Yes",
							showInLegend: true,
							dataPoints: dataJS1
						},{
							type: "stackedColumn",
							name: "No",
							showInLegend: true,
							dataPoints: dataJS2
						}
					]
				});


					chart.render();
					
			});
	
	
	var chart = new CanvasJS.Chart("chartContainer", {
					title: {
						text: "Categorys"
					},
					options: {
								maintainAspectRatio: false
							},
					theme: "dark1",
					animationEnabled: true,
					zoomEnabled: true,
					toolTip:{
						shared: true,
						reversed: false
					},
					axisY: {
						logarithmic: true
					},
					axisX: {						
						labelAngle: 90,
						labelAutoFit: true,
						labelPlacement: "inside",
						interval: 1
					},
					legend: {
						cursor: "pointer",
						itemclick: toggleDataSeries
					},
					data: [
						{
							type: "stackedColumn",
							name: "Yes",
							showInLegend: true,
							dataPoints: 0
						},{
							type: "stackedColumn",
							name: "No",
							showInLegend: true,
							dataPoints: 0
						}
					]
				});

					chart.render();
	
			function toggleDataSeries(e) {
				if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
					e.dataSeries.visible = false;
				} else {
					e.dataSeries.visible = true;
				}
				e.chart.render();
			}

		
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
<div class="select">Category vs:
  <select id="rows" name="DataRow">
	<option value="" selected disabled hidden>Choose here</option>
    <option value="1">Ad Supported</option>
	<option value="2">In-App Purchases</option>
    <option value="3">Free</option>
  </select>  
</div>
<div class="select">Amount of data to show:
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
	
<div id="chartContainer" style="height: 605px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <footer class="secondary_header footer">
	  
    <div class="copyright">&copy;2021 - <strong>SIMPLE Theme</strong></div>
  </footer>
</div>
</body>
</html>
