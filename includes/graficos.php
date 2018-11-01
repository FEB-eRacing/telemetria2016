
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!--<link rel="shortcut icon" href="imagens/febracing.ico">
		<title>Telemetria FEB Racing</title>-->
		<script src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bibliotecaAjax.js"></script>
		<script type="text/javascript" src="graficos.js"></script>
		<script src="js/highcharts.js"></script>
		<script src="js/highcharts-more.js"></script>

	</head>
	<body>
		
		<!--<img style="position:absolute" src="imagens/baja.jpg" width="165" height="145">-->
		<center>
			<table>
				<tr>
					<td colspan="2">
						<center>
							<span id="erro"></span>
						</center>
					<td>
				</tr>
				<tr>
					<td>
						<div id="container2" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
					</td>
					<td>
						<div id="container" style="min-width: 810px; height: 250px; margin: 0 auto"></div>
					</td>
				</tr>
				<tr>
					<td>
						<div id="container5" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
					</td>
					<td>
						<div id="container6" style="min-width: 810px; height: 250px; margin: 0 auto"></div>
					</td>
				</tr>
				<tr>
					<td>
						<div id="container3" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
					</td>
					<td>
						<div id="container4" style="min-width: 810px; height: 250px; margin: 0 auto"></div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div id="container7" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
					</td>
				</tr>
			</table>
		</center>
		<input type="hidden" id="velocidade" value="0" />
		<input type="hidden" id="contagiro" value="0" />
		<input type="hidden" id="tempo" value="<?php date('H:m'); ?>" />
		<input type="hidden" id="posicaoX" value="0" />
		<input type="hidden" id="posicaoY" value="0" />
		<input type="hidden" id="posicaoGPS" value="" />
		<span id="erro"></span>
	</body>
</html>
