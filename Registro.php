<?php include("Header.php"); ?>
	<div class="DivPrin">
		<div class="DivSec">
			<form id="formReg">
				<figure>
					<img class="userLogo" src="images/logo_user.gif">
				</figure>
				<br>
				<label>Nombre de Usuario:</label>
				<br>
				<input id="NomUser" type="text" placeholder="NamUser" required autofocus>
				<br>
				<label>Correo Electrónico</label>
				<br>
				<input id="CorreoElc" type="email" required placeholder="correo@empresa.dom">
				<br>
				<br>
				<button type="button" class="btn btn-primary btn-block btn-lg buton">REGISTRAR</button>
				<button type="button" class="btn btn-primary btn-block btn-lg buton">VOLVER</button>
			</form>
		</div>
	</div>
<?php include("Footer.php"); ?>
