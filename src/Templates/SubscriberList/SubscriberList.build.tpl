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
		</ul> 

        <h2>Plantilla de twig: Aquí accedemos a base de datos y hacemos un display de todos los usuarios registrados</h2>
        <h3>Estos son todos los amigos que ya estan suscritos al boletin. Apuntate tu tambien!!!</h3>

		<ul>
   			{% for email in emails %}
        		<li>{{ email.email }}</li>
    		{% endfor %}
		</ul>

        <p>Para trabajar con esta base de datos necesitas utilizar el archivo .dump y también en <strong>src/config/DatabaseConfig.php</strong> deberás poner tus datos de conexión</p>
        
        <p>Por cierto, si quieres suscribirte a la newsletter haz click en subscribe to the newsletter (y tambien te cuento un poco más del Framework)</p>

    </body>
</html>