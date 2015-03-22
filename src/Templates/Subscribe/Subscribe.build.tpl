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

        <h1>Para suscribirte simplemente indica tu email</h1>
        <h2>Apuntate tu tambien!!!</h2>

    <form action="/subscribe" method="post">
    
        <div id="formHeader">Registration Form</div>
        
        <div id="formBody">
            <div class="formField">
                <input type="email" name="email" required placeholder="Email" />
            </div>
        
            <div>
                <input type="submit" value="Register" class="customButton" />
            </div>
            
        </div>
        
    </form>
    
    <p>desde aquí puedes guardar los emails que te envien en la base de datos. Si todo va bién te redirigirá a una página de éxito</p>

    <p>Si intentas acceder a una página que no existe, por ejemplo <a href="/nothing">esta</a>, verás que te sale una página de error hecha con smarty</p>

    <p>Comentarte finalmente que también tienes disponible un sencillo <strong>container de dependencias</strong>. Primero deberás indicar los servicios en <strong>src/config/services.yml</strong>, las clases a instanciar y sus dependencias. A partir de ahí si utilizas la clase <strong>BaseController</strong> podrás utilizar la función <strong>newContainer()</strong> y llamar al servicio que necesites utilizando la función <strong>get($service)</strong> del container</p>

    </body>
</html>