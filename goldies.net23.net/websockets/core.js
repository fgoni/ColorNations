//Los dos personajes
		var conectado = false;
		var mover = false;
		var inGame = false;
		var intConexion;
		var pelotitaW = 5;
		var pelotitaH = 5;
		var mapa = {
			height:150,
			width:500
		};
		var p1 = {
			color:"red",
			width:20,
			height:40,
			dx:0,
			dy:0
		};
		var p2 = {
			color:"blue",
			width:20,
			height:40,
			dx:0,
			dy:0
		};
		var pelotita = {
			color:"green",
			width:pelotitaW,
			height:pelotitaH,
			x:mapa.width/2-pelotitaW/2,
			y:mapa.height/2-pelotitaH/2,
			dx:0,
			dy:0
		};
		console.log(pelotita.x, pelotita.y);
		//La conexión con el servidor
		var servidor = new Array("localhost", "192.168.1.103", "facuserver.zapto.org", "24.232.244.233");
		var servidorOpcion = 0;
		var conn;
		start('ws://'+servidor[servidorOpcion]+':8080');
		function start(websocketServerLocation){
		    conn = new WebSocket(websocketServerLocation);
		    conn.onclose = function(){
		        //try to reconnect in 5 seconds
		        conectado = false;
		        console.log("Conexion terminada");
		        log("Desconectado del servidor");
		        servidorOpcion++;
		        console.log(servidorOpcion, servidor.length);
				if (servidorOpcion<servidor.length){
					console.log("Intentando conectarse a "+servidor[servidorOpcion]);
					log("Intentando conectarse nuevamente");
					setTimeout(function(){
		        	start('ws://'+servidor[servidorOpcion]+':8080');
			        },
			         3000);
				}
				else {
					servidorOpcion = 0;
					start('ws://'+servidor[servidorOpcion]+':8080');
				}

		    };

			conn.onopen = function(e) {
				console.log("Connection established!");
				log("Conectado al servidor");
				conectado = true;
			};
			conn.onerror = function() {
				console.log("Error al conectarse a "+servidor[servidorOpcion]);
			};
			conn.onmessage = function(e) {
				var mensaje = e.data;
				//console.log("Recibo: ",mensaje);
				var partes=mensaje.split(".");
				switch (partes[0]){
					case 'id':
						intConexion = partes[1];
					break;
					case 'pos':
						mover = true;
						if (partes[1] != intConexion){
							console.log("Recibo de otro:",mensaje);
							p2.x = partes[2];
							p2.y = partes[3];
						}
					break;
					case 'mes':
						//console.log(mensaje);
						mostrar(partes[1]+' dice:'+partes[2]);	
					break;
					case 'ini':
						for (i=0; i<partes.length; i++){
							console.log(partes[i]);
						}
						if (partes[1] == 1){
							p1.x = 0;
							p1.y = mapa.height/2-p1.height/2;
							p2.x = mapa.width-p2.width;
							p2.y = mapa.height/2-p2.height/2;
						}
						else if (partes[1] == 2){
							p1.x = mapa.width-p1.width;
							p1.y = mapa.height/2-p1.height/2;
							p2.x = 0;
							p2.y = mapa.height/2-p2.height/2;
						}
						iniciarJuego();
						log(mensaje);
					break;
					case 'lista':
						//Borro el contenido del div.
						$("#lista_conectados").html("");
						//Pego la lista. 
						for (i=1; i<partes.length; i++){
							listarConectados(partes[i]);
						}
					break;
					case 'invitacion':
						var aceptar = confirm(partes[1]+" te ha invitado a jugar");
						conn.send("aceptar" + "." + aceptar+"."+intConexion+"."+partes[1]);
						if (aceptar) {
							inGame = true;
						}
					break;
					default:
					break;
				}
			};
		}
		
		$(document).ready(function(){

			//Lectura de los eventos de teclas	
			$(document).keydown(function(e){
				//Boolean para controlar los movimientos.
				if (mover){
					/*
					if(e.which == 39){
						p1.dx=1;
					}
					if (e.which==37){
						p1.dx=-1;
						}
						*/
					if (e.which == 40){
						p1.dy=1;
						}
					if (e.which == 38) {
						p1.dy=-1;
						}
				}

			});
			$(document).keyup(function(e){
				/*
				if((e.which == 39) || (e.which == 37) ){
					p1.dx=0;
					}
					*/
				if ((e.which == 38) || (e.which == 40)) {
					p1.dy=0;
					}
				});

			//El loop infinito
			timer=setInterval(function(){
				if (bounds(p1)){
					//p1.x+p1.dx<= (mapa.width-p1.width) && p1.x+p1.dx >= 0 && p1.y+p1.dy <= (mapa.height-p1.height) &&  p1.y+p1.dy >= 0
					if (!colision(p1.x+p1.dx, p1.y+p1.dy, p1.width, p1.height, p2.x, p2.y, p2.width, p2.height)){
						p1.x+=p1.dx;
						p1.y+=p1.dy;
						$('#p1').css('left',p1.x+'px');
						$('#p1').css('top',p1.y+'px');
						enviarPos(p1.x,p1.y);
						//console.log("if" + p1.x + " " + p1.y);
					}
					//console.log(p1.x + " " +p1.y);

				}
				$('#p2').css('left',p2.x+'px');
				$('#p2').css('top',p2.y+'px');
			},30);

			$('#mapa').css({"width":mapa.width, "height":mapa.height, "min-height":mapa.height});
		});