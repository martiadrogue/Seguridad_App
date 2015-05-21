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
		
		<h4>La contraseña no es válida. Debe tener:</h4>
		
		<ul>
			<li> al menos una letra mayúscula </li>
			<li> al menos una letra minúscula </li>
			<li> al menos un número o caracter especial </li>
			<li> como mínimo 8 caracteres y como máximo 15</li>
		</ul>

		<p>Inténtalo otra vez</p>

    </body>
</html>