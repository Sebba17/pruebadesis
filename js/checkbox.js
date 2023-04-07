

/* Seleccionamos los checkbox para que cuando sea menor a 2 selecciones, se muestre un error*/
document.querySelector('form').addEventListener('submit', function(event) {
    var checkboxes = document.querySelectorAll('input[name="checkboxes[]"]:checked');
    if (checkboxes.length < 2) {
      event.preventDefault();
      document.querySelector('#errorcheckbox').style.display = 'block';
    } else {
      document.querySelector('#errorcheckbox').style.display = 'none';
    }
  });
  