

  function manterObjetosDiferentesPorCodigo(array) {

    const mapaDeCodigos = new Map();
    const resultado = [];
  
    for (const objeto of array) {
      let codigo = objeto.codigo;
  
      // Convertendo para número se o código estiver em formato de string
      if (typeof codigo === 'string') {
        codigo = parseInt(codigo, 10);
      }
  
      // Verificando se o código não está vazio
      if (codigo !== '' && !mapaDeCodigos.has(codigo)) {
        mapaDeCodigos.set(codigo, true);
        resultado.push(objeto);
      }
    }
  
    return resultado;
  }