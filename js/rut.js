function validarRUT(rut) {
    // Eliminamos puntos y guiones del RUT
    rut = rut.replace(/\./g, '').replace(/\-/g, '').toUpperCase();
    
    // Validamos el formato del RUT
    if (!/^[0-9]+[0-9kK]{1}$/.test(rut)) {
      return false;
    }
    
    // Validamos el dígito verificador
    var dv = rut.charAt(rut.length - 1);
    var body = rut.slice(0, -1);
    var suma = 0;
    var multiplo = 2;
    
    for (var i = 1; i <= body.length; i++) {
      var index = multiplo * rut.charAt(body.length - i);
      suma += index;
      multiplo = multiplo < 7 ? multiplo + 1 : 2;
    }
    
    var dvEsperado = 11 - (suma % 11);
    dvEsperado = (dvEsperado === 11) ? 0 : ((dvEsperado === 10) ? "K" : dvEsperado);
    
    if (dv != dvEsperado) {
      return false;
    }
    
    return true;
  }
  