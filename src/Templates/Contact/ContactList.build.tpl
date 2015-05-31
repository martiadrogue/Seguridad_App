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

        <h3>Bienvenido a la aplicación de contactos, esta es tu lista actual de contactos:</h3>

		<a href="/contact/add"><button>add contact</button></a>

		<h3>lista:</h3>

		<ul>
   			{% for contact in contacts %}
        		<p>{{ contact.contact }} <form action="/contact/detail" method="post"><input type="text" name="id" value={{ contact.id }} hidden=true><input type="submit" value="detail"></form><form action="/contact/edit" method="post"><input type="text" name="id" value={{ contact.id }} hidden=true><input type="submit" value="edit"></form><form action="/contact/erase" method="post"><input type="text" name="id" value={{ contact.id }} hidden=true><input type="submit" value="erase"></form></p>
    		{% endfor %}
		</ul>

    </body>
</html>
