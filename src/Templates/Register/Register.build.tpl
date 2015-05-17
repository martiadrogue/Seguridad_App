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
		  <li><a href="/test">Test</a></li>
		  <li><a href="/subscriberlist">SubscriberList</a></li>
          <li><a href="/subscribe">Subscribe to the newsleter</a></li>
		  <li><a href="/login">Login</a></li>
		  <li><a href="/register">Register</a></li>
		  <li><a href="/contact">Contacts</a></li>
		  <li><a href="/logout">Logout</a></li>
		</ul> 

        <h3>Para acceder al contenido de la web debes estar registrado. Rellena los siguientes campos:</h3>

    <form action="/register" method="post">
    
        <div id="formHeader">Formulario de registro</div>
        
		<div id="formBody">
			<label for="campo-nombre">Nombre:</label>
			<input type="text" name="nombre">

			<label for="campo-contraseña">Password:</label>
			<input type="password" name="contraseña">

			<input type="submit" value="registrarme">
		</div> 
        
    </form>

    </body>
</html>