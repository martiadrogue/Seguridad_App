<!DOCTYPE html>
<html>
    <head>
        <title>My Webpage</title>
        {% block stylesheets %}
            <link href="{{ '../css/bootstrap.css' }}" type="text/css" rel="stylesheet" />
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

        <h3>Para añadir un contacto rellena el siguiente campo:</h3>

    <form action="/contact/add" method="post">
    
        <div id="formHeader">Nuevo contacto</div>
        
		<div id="formBody">
			<label for="campo-nombre">Nombre:</label>
			<input type="text" name="nombre">

			<input type="submit" value="añadir">
		</div> 
        
    </form>

    </body>
</html>