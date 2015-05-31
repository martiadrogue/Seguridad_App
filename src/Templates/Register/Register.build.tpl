<!DOCTYPE html>
<html>
    <head>
        <title>My Webpage</title>
        {% block stylesheets %}
            <link href="{{ 'css/bootstrap.css' }}" type="text/css" rel="stylesheet" />
         {% endblock %}
    </head>
    <body>
        <h2>Menú Principal</h2>
    <ul>
		  <li><a href="/">Home</a></li>
		  <li><a href="/login">Login</a></li>
		  <li><a href="/register">Register</a></li>
		  <li><a href="/contact">Contacts</a></li>
		  <li><a href="/logout">Logout</a></li>
		  <li><a href="/personalarea">Personal Area</a></li>
		</ul>

        <h3>Para acceder al contenido de la web debes estar registrado. Rellena los siguientes campos:</h3>

		<h4>El nombre de usuario debe tener entre 4 y 15 carácteres, sean letras o números:</h4>

		<h4>la contraseña debe tener:</h4>

		<ul>
			<li> al menos una letra mayúscula </li>
			<li> al menos una letra minúscula </li>
			<li> al menos un número o caracter especial </li>
			<li> como mínimo 8 caracteres y como máximo 15</li>
		</ul>

    <form id="user-form" action="/register" method="post" enctype="multipart/form-data">

        <div id="formHeader">Formulario de registro</div>

		<div id="formBody">
			<label for="campo-nombre">Nombre de usuario:</label>
			<input autocomplete="off" type="text" id="nombre" name="nombre" required>

			<label for="campo-email">Email:</label>
			<input autocomplete="off" type="email" name="email" required>

			<label for="campo-contraseña">Password:</label>
			<input autocomplete="off" type="password" id="contraseña" name="contraseña" required maxLength="16">

			<label for="campo-contraseña">Password Repeat:</label>
			<input autocomplete="off" type="password" id="contraseña2" name="contraseña2" required maxLength="16">

      <label for="retrato">Retrato:</label>
			<input autocomplete="off" type="file" name="retrato" size="0" accept="image/*" required>


			<input type="submit" value="registrarme">
		</div>

    </form>
    <script src="js/validator-register.js"></script>
    </body>
</html>
