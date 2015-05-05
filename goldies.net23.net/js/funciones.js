// JavaScript Document

var enlace = true;
function changeValue(id, valor){
	document.getElementById(id).innerHTML = valor;
}
function validarCambiarPW(form){
	var pass_vieja = true;
	var pass1_vacia = true;
	var pass2_vacia = true;
	if (!vacio(form.old_pass.value)) pass_vieja = false;
	if (!vacio(form.new_pass1.value)) pass1_vacia = false;
	if (!vacio(form.new_pass2.value)) pass2_vacia = false;
	if (pass_vieja){
		alert("La contraseña actual no puede estar vacía"); return false;
	}
	if (pass1_vacia){
		alert("La nueva contraseña no puede estar vacía"); return false;
		 }
	if (pass2_vacia){
		 alert("Debe repetir la contraseña"); return false;
		 }
	if (form.new_pass1.value!=form.new_pass2.value){
		alert("Las contraseñas deben ser iguales"); return false;
	}
	if (!validarPass(form.new_pass1.value)){
		alert("La contraseña no cumple con los requisitos de seguridad");
		return false;
	}
}
function Validar( form ) {
	var usuario_vacio = true;
	var mail_vacio = true;
	var pass1_vacia = true;
	var pass2_vacia = true;
	
	if (!vacio(form.usuario.value)) usuario_vacio=false;
	if (!vacio(form.mail.value)) mail_vacio=false;
	if (!vacio(form.password1.value)) pass1_vacia=false;
	if (!vacio(form.password2.value)) pass2_vacia=false;
	
	if(!validarMail(form.mail.value)) {
		alert("La dirección de e-mail es incorrecta");
		return false;
	}
	if (usuario_vacio){
		 alert("El campo usuario no puede estar vacío"); return false;
		 }
	if (mail_vacio){
		 alert("El campo mail no puede estar vacío"); return false;
		 }
	if (pass1_vacia){
		 alert("La contraseña no puede estar vacía"); return false;
		 }
	if (pass2_vacia){
		 alert("Debe repetir la contraseña"); return false;
		 }
	if (!validarUsuario(form.usuario.value)){
		alert("Username has invalid characters. Only letters and underscore");
		return false;
	}
	if (!validarPass(form.password1.value)){
		alert("La contraseña no cumple con los requisitos de seguridad");
		return false;
	}
	if (form.password1.value!=form.password2.value){
		alert("Las contraseñas deben ser iguales"); return false;
	}
}

function validarMail(mail) {
	var exr = /^[0-9a-z_\-\.]+@[0-9a-z\-\.]+\.[a-z]{2,4}$/i;
	return exr.test(mail);
}
function validarUsuario(usuario){
	var expr = /^\w+$/i;
	return expr.test(usuario);
}

function validarPass(pass){
	var expr = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,})$/;
	return expr.test(pass);
}

function vacio(campo) {  
        for ( i = 0; i < campo.length; i++ ) {  
                if ( campo.charAt(i) != " " ) {  
                        return false  
                }  
        }  
        return true  
}
// Comienzo del código de verificación de contraseñas.
$(document).ready(function() {
//input[type=password]
	$('input[type=password]').keyup(function() {
		// set password variable
		var pswd = $(this).val();
		//validate the length
		if ( pswd.length < 8 ) {
			$('#length').removeClass('valid').addClass('invalid');
		} else {
			$('#length').removeClass('invalid').addClass('valid');
		}
			//validate letter
		if ( pswd.match(/[A-Z]/i) ) {
			$('#letter').removeClass('invalid').addClass('valid');
		} else {
			$('#letter').removeClass('valid').addClass('invalid');
		}
		//validate number
		if ( pswd.match(/\d/) ) { 
			$('#number').removeClass('invalid').addClass('valid');
		} else {
			$('#number').removeClass('valid').addClass('invalid');
		}
	}).focus(function() {
		$('#pswd_info').show();
		// set password variable
		var pswd = $(this).val();
		//validate the length
		if ( pswd.length < 8 ) {
			$('#length').removeClass('valid').addClass('invalid');
		} else {
			$('#length').removeClass('invalid').addClass('valid');
		}
			//validate letter
		if ( pswd.match(/[A-Z]/i) ) {
			$('#letter').removeClass('invalid').addClass('valid');
		} else {
			$('#letter').removeClass('valid').addClass('invalid');
		}
		//validate number
		if ( pswd.match(/\d/) ) { 
			$('#number').removeClass('invalid').addClass('valid');
		} else {
			$('#number').removeClass('valid').addClass('invalid');
		}
	}).blur(function() {
		$('#pswd_info').hide();
	});
});
//Muestra un div y oculta otro div. Para Enlace y Archivo en Altas.
function ShowHide(divId, divId2)
{
	if(document.getElementById(divId).style.display == 'none')
	{
		document.getElementById(divId).style.display='block';
		enlace = true;
		document.getElementById("enlace_tbox").value='';
		document.getElementById(divId2).style.display='none';
	}
	else
	{
		document.getElementById(divId).style.display = 'none';
		enlace = false;
		document.getElementById("enlace_tbox").value='';
		document.getElementById(divId2).style.display='block';
	}
}
//Función para revisar si un archivo es menor al máximo especificado.
function checkSize(max_file_size)
{
    var input = document.getElementById("fileinput");
    // check for browser support (may need to be modified)
    if(input.files && input.files.length == 1)
    {           
        if (input.files[0].size > max_file_size) 
        {
            alert("El archivo debe pesar menos de " + (max_file_size/1024/1024) + "MB");
            return false;
        }
    }
return true;
}

function comprueba_extension(archivo) {
	//alert(archivo); 
   extensiones_permitidas = new Array( ".gif", ".jpg", ".doc", ".pdf", ".docx", ".xls",".xlsx", ".txt", ".ppt", ".rar", ".zip", ".sldx", ".ppsx", ".pptx", ".pps" ); 
   error = ""; 
   if (!archivo) { 
      //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario 
      	error = "No has seleccionado ningún archivo"; 
   }
   else { 
      //recupero la extensión de este nombre de archivo 
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
      //alert (extension); 
      //compruebo si la extensión está entre las permitidas 
      permitida = false; 
      for (var i = 0; i < extensiones_permitidas.length; i++) { 
         if (extensiones_permitidas[i] == extension) { 
         permitida = true; 
         break; 
         } 
      }
      if (!permitida) { 
         error = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
      	}
		else return true;
   } 
   //si estoy aqui es que no se ha podido submitir
   alert (error);
   return false;
}

function validar_archivo(){
	archivo = document.getElementById('fileinput').value;
	//alert(archivo);
	//alert("Entro al validar");
	if (checkSize(1048576)){
		//alert("Aprobó checksize");
		if (comprueba_extension(archivo)){
			//alert("Aprobó extension");
			return true;
		}
		else return false;
	}
	else return false;
}

function valid_url(url){
	if (enlace){
		prueba = url.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
		if (prueba) return true;
		else{
			alert("La URL ingresada no es válida");
			return false;
		}
	}
	else return true;
}
//F.A.Q.
function muestra_oculta(id){
	if (document.getElementById){ //se obtiene el id
	var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
	el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
	}
}
window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/

}
/*
$(document).ready(function() {

    function update() {
      $.ajax({
       type: 'POST',
       url: 'datetime.php',
       timeout: 900,
       success: function(data) {
          $("#timer").html(data); 
          window.setTimeout(update, 900);
       },
      });
     }
     update();
});
*/