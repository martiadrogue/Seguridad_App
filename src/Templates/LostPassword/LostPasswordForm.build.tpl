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
		  <li><a href="/personalarea">Personal Area</a></li>
		</ul> 

        <h3>Has olvidado tu contraseña? indícanos tu correo y te enviaremos un email para resetearla:</h3>

    <form action="/lostpassword" method="post">
    
        <div id="formHeader">Formulario de recuperación de contraseña</div>
        
		<div id="formBody">
			<label for="campo-nombre">Email:</label>
			<input autocomplete="off" type="email" name="email">

			<input type="submit" value="Enviar">
		</div> 
        
    </form>

    </body>
</html>