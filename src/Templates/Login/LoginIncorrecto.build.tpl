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

        <h3>Login incorrecto, por favor introduce los datos correctos.</h3>

        <p><a href="/Login">Vuelve a Login</a></p>

	<p>Has olvidado tu password? <a href="/LostPassword">Recuperar</a></p>

    </body>
</html>
