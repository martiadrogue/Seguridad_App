<html>
<head>
<title>Info Smarty</title>
       <link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
</head>
<body>

<h2>Menú Principal</h2>
<ul class = "navbar">
		 <li><a href="/">Home</a></li>
		 <li><a href="/test">Test</a></li>
		 <li><a href="/subscriberlist">SubscriberList</a></li>
		 <li><a href="/subscribe">Subscribe to the newsleter</a></li>
		 <li><a href="/login">login</a></li>
		 <li><a href="/register">Register</a></li>
		 <li><a href="/contact">Contacts</a></li>
</ul> 

<pre>
¡Bienvenido al Framework MPWAR!

Esta es la página de home hecha con <strong>template Smarty:</strong>

Verás que arriba de todo tienes permanentemente un texto que te indica si estás en el entorno de desarrollo o en producción. Si el texto te molesta simplemente tienes que eliminarlo de los archivos <strong>public/index.php</strong> y <strong>public/index_dev.php</strong>

Le he pasado unas variables como test. 
Yo las veo como:
<strong>
Name: $name
Address: $address
</strong>
Pero tu ahora mismo, gracias a Smarty las estarás viendo como:
<strong>
Name: {$name}
Address: {$address}
</strong>

Puedes hacer más cosas con este Framework. Haz click en 'test' y te sigo contando :)
</pre>

</body>
</html>