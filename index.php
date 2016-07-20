<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title align='center'>REGISTRO</title>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="favicon.ico">
    </head>
    <body >
        <table align="center" width="100%">
            <tr>
		<td align="center">
        <div class="contenedor">
            <div align="center" ><a href= "index.php" title="Pagina Principal"><img src="logo.png" style="width:270px;height:110px;align:center"></a>
            </div>
            <h1>CONSULTAS</h1>
            <div id= "resultado"></div>
            <div id=" formulario" >
                <form method="POST" action="return false" onsubmit="return false">
                <p style="width:30%; height:55% ;margin:0 auto"><input required type="text" class="form-control" maxlength="40" value="" id="nombre" name="nombre" placeholder="NOMBRE">
                    </p>
                <p style="width:30%; height:55% ;margin:0 auto"><input required type="text" class="form-control" maxlength="40" value="" id="apellido" name="apellido" placeholder="APELLIDO">
                    </p>
                <p><button onclick="lista(document.getElementById('nombre').value,  document.getElementById('apellido').value);">CONSULTAR</button>
                    
            </form>
        </div>
        <script>
           function lista(nombre, apellido)
           {
           $.ajax({
               url: 'lista.php',
               type: 'POST',
               data:'nombre='+nombre+'&apellido='+apellido,
               success: function(resp){
                   $('#resultado').html(resp);
               }
           });
           } 
        </script>
                </p>
        </div>
        </table>
        <table align="center" style="border-top:#999999;border-top-style:groove;position:relative;" width="100%">
	<tr>
		<td>
			<p align="center" style="color: #002448;font-size:12px;">
                            Direcci&oacute;n: Constituci&oacute;n esq. 25 de Mayo - Telefax: 451 925 / 492 109 <br />
                            Asunci&oacute;n - Paraguay <br />
                            Cont&aacute;ctenos: sfp@sfp.gov.py
			</p>
		</td>
	</tr>
</table>
</body>
</html>