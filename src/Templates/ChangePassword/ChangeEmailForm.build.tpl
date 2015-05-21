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

        <h3>Indicanos tu nueva contraseña:</h3>

    <form action="/changepassword" method="post">
    
        <div id="formHeader">contraseña:</div>
        
		<div id="formBody">
			<label for="campo-nombre">Password:</label>
			<input autocomplete="off" type="password" name="password">
			
			<label for="campo-nombre">Repeat Email:</label>
			<input autocomplete="off" type="password" name="password2">
			
			<input type="text" name="hash" value={{ hash }} hidden=true>
			
			<input type="submit" value="Enviar">
		</div> 
        
    </form>

    </body>
</html>