var form = document.getElementById('user-form');
var duplicat = false;

form.onsubmit = function() {
  var name = document.getElementById('nombre');
  var pass = document.getElementById('contraseña');
  var conf = document.getElementById('contraseña2');

  if (name.value.search(/^[a-z\d_]{4,15}$/i)===-1) {
    alert('El nombre de usuari solo puede contener letras i tiene que tener entre 4 i 15 caracteres.');
    return false;
  }
  if (!/^.*(?=.{8,})((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/.test(pass.value)) {
    alert('Password poco seguro.');
    return false;
  }
  if (pass.value > 16) {
    alert('Evita usar citas conocidas como password.');
    return false;
  }
  if (conf.value !== pass.value) {
    alert('Los passwords no coinciden.');
    return false;
  }
  if (duplicat) {
    alert('Nombre de usuario ya registrado, cámbialo.');
    return false;
  }
};

document.getElementById("nombre").addEventListener("blur", function(){
    var nombre = document.getElementById("nombre").value;
    nombre = nombre.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    nombre = nombre.replace(/'/g, "&#039;").replace(/"/g, "&quot;");
    nombre = nombre.replace(/\{/g, "&#123;").replace(/\}/g, "&#125;");
    ajax('/validUser', 'post', 'nombre='+nombre, display);
},true);

function display (data) {
  if (data.length === 1) {
    duplicat = true;
    alert('Nombre de usuario ya registrado, cámbialo.');
    return;
  }

  duplicat = false;
}

function ajax(url, method, data, success) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = onStateChange;
  request.overrideMimeType('application/json');
  request.open(method, url, true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(data);

  function onStateChange() {
    if (request.readyState < 4) {
      return; // not ready yet
    }
    if (request.status && (request.status < 200 || request.status >= 300)) {
      console.error('Request error', request);
      return;
    }

    var result = JSON.parse(request.responseText);
    success(result);
  }
}
