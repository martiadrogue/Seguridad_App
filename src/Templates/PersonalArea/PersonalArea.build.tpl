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

        <h3>area personal</h3>

		<h3>tus datos:</h3>

		<ul>
        		<p> User = {{ personalarea.user }} <form action="/personalarea/changeUser" method="post"><input type="text" name="id" value={{ personalarea.id }} hidden=true><input type="submit" value="change"></form></p>
				<p> Password = ******** <form action="/personalarea/changePassword" method="post"><input type="text" name="id" value={{ personalarea.id }} hidden=true><input type="submit" value="change"></form></p>
		</ul>

    </body>
</html>
