		//Las funciones
		function enviar() {
			var txtbox = document.getElementById("txt");
			var value = "mes"+"."+intConexion+"."+txtbox.value;
			if (conectado) {
				conn.send(value);
			}
			else {
				console.log("No hay conexion");
			}
		}
		function mostrar(mensaje) {
			$("#chat").attr("value", $("#chat").val()+mensaje+"\n");
			$("#chat").scrollTop($("#chat").height());
		}
		function log(mensaje){
			$("#log_textarea").attr("value", $("#log_textarea").val()+mensaje+"\n");
			$("#log_textarea").scrollTop($("#log_textarea").height());
		}
		function listarConectados(mensaje){
			$("#lista_conectados").append("<div class='conectado' onclick='jugar("+mensaje+")'>"+mensaje+"</div>");
		}
		function jugar(enemigo){
			if (intConexion == enemigo){
				alert("No puedes jugar contra ti mismo!");
			}
			else {
				conn.send("jugar"+"."+intConexion+"."+enemigo);
				console.log(intConexion,".", enemigo);	
			}
		}
		function enviarPos(x,y){
			var mensaje = ["pos",intConexion,x,y];
			var posicion = mensaje.join('.');
			if (conectado){
				conn.send(posicion);
				console.log("Envio: ",posicion);
			} 
		}
		//Colision de rectangulos
		function colision(x1, y1, w1, h1, x2, y2, w2, h2) {
		    w2 += parseInt(x2);
		    w1 += parseInt(x1);
		    if (x2 > w1 || x1 > w2){
		    	return false;
		    } 
		    h2 += parseInt(y2);
		    h1 += parseInt(y1);
		    if (y2 > h1 || y1 > h2){
		    	return false;
		    }
			console.log("Colision: ",x1,y1,w1,h1,x2,y2,w2,h2);
			return true;
		}
		function bounds(unit){
			//console.log("Entro 0");
			if (unit.x+unit.dx <= (mapa.width-unit.width)){
				//console.log("Entro 1");
				if (unit.x+unit.dx >= 0){
					//console.log("Entro 2");
					if (unit.y+unit.dy <= (mapa.height-unit.height)){
						//console.log("Entro 3");
						if (unit.y+unit.dy >= 0){
							//console.log("Entro 4");
							return true;
						}
						else return false;
					}
					else return false;
				}
				else return false;
			}
			else return false;
		}
		function isPlaying(){
			return inGame;
		}
		function iniciarJuego(){
			//Estilo de unidades
			$("#p1").css({"position":"absolute", "width":p1.width, "height":p1.height, "background-color":p1.color});
			$("#p2").css({"position":"absolute", "width":p2.width,"height":p2.height, "background-color":p2.color});
			$("#pelotita").css({"position":"absolute", "width":pelotita.width, "height":pelotita.height, "background-color":pelotita.color, "left":pelotita.x, "top":pelotita.y});
		}