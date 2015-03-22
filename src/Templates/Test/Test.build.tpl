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

        <h2>Esta página está hecha con twig </h2>
        <p>esto de aquí es una variable: {{ a_variable }}</p>
        <p>aunque yo la estoy viendo como:  a_variable </p>

        <p>Este Framework se ha creado principalmente con fines educativos como parte del master MPWAR. Sigue el modelo MVC. Es básico, pero también te puede ayudar a crear tus proyectos web más rapidamente</p>

        <p>Actualmente hay 4 páginas creadas disponibles permanentemente (y alguna más para gestionar mensajes de error o de éxito). Si quieres crear tu una página sigue los siguientes pasos:</p>

        <ul>
         <li>Crea un controlador nuevo para tu página y guárdalo en <strong>src/controllers/carpetaconnombrecontrolador/controlador.php</strong> Si tu controlador hereda de <strong>BaseController</strong> podrá usar la función <strong>newContainer</strong></li>
         <li>en <strong>src/config/routing.yml</strong> debes añadir tu controlador, path, acción por defecto...</li>
         <li>en <strong>src/templates/carpetanombrecontrolador/view.tlp</strong> se guardan las plantillas que utilices. Tienes disponible tanto <strong>twig</strong> como <strong>smarty</strong></li>
         <li>Si necesitas acceso a <strong>base de datos</strong> también podrás hacerlo con este framework. Te cuento un poco más en la siguiente página. Haz click en SubscriberList</li>
    </ul> 


    </body>
</html>