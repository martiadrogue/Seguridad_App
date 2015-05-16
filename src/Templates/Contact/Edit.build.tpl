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
		</ul> 

		<h3>modo edición:</h3>
		
		<ul>
   			{% for contact in contacts %}
        		<p><form action="/contact/update" method="post"><input type="text" name="data_updated" value="{{ contact.task }}"><input type="text" name="id" value={{ contact.id }} hidden=true><input type="submit" value="update"></form></p>
    		{% endfor %}
		</ul>

    </body>
</html>