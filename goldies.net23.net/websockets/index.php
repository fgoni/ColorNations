<html>
	<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript"></script>
	<script src="core.js" type="text/javascript"></script>
	<script src="funciones.js" type="text/javascript"></script>
	<link href="estilo.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
	<div id="contenedor_chat">
		<textarea rows="4" cols="50" id="chat" readonly="true"></textarea>
		<input type="text" name="txt" id="txt"/>
		<input type="button" value="enviar" onclick="enviar();"/>
	</div>
	<div id="mapa">
		<div id="p1"></div>
		<div id="p2"></div>
		<div id="pelotita"></div>
	</div>
	<div id="log">
		<textarea rows="4" cols="40" id="log_textarea" readonly="true"></textarea>
	</div>
	<div id="lista_conectados">
	</div>
	</body>
</html>