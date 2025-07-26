// valor-uf.js


console.log('Cargando script valor-uf.js');


(function() {
  // Referencias al DOM
  const inputPesos = document.getElementById('input-pesos');
  const inputUf    = document.getElementById('input-uf');
  const loadingEl  = document.getElementById('uf-loading');
  const errorEl    = document.getElementById('uf-error');
  const contentEl  = document.getElementById('uf-content');
  const infoEl     = document.getElementById('uf-info');
  let   valorUf    = null;

  function formatCLP(value) {
    const digits = value.replace(/\D/g, '');
    return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  function cargarValorUf() {
    loadingEl.style.display = 'block';
    errorEl.style.display   = 'none';

    fetch('/api/uf')
      .then(res => {
        if (!res.ok) throw new Error('No se pudo obtener el valor UF');
        return res.json();
      })
      .then(data => {
        console.log('Respuesta UF cruda:', data);

        let rawValue = null;

        // 1) Caso simple: data.valor
        if (data.valor != null) {
          rawValue = data.valor;
        }
        // 2) Caso Mindicador.cl: data.uf.valor
        else if (data.uf && data.uf.valor != null) {
          rawValue = data.uf.valor;
        }
        // 3) Caso simple: data.uf es número
        else if (data.uf && !isNaN(parseFloat(data.uf))) {
          rawValue = data.uf;
        }
        // 4) Caso API con array: data.serie[0].valor
        else if (Array.isArray(data.serie) && data.serie[0] && data.serie[0].valor != null) {
          rawValue = data.serie[0].valor;
        }
        else {
          throw new Error('No se encontró el valor UF en la respuesta');
        }

        valorUf = parseFloat(rawValue);
        if (isNaN(valorUf) || valorUf <= 0) {
          throw new Error('Valor UF inválido recibido: ' + rawValue);
        }

        // Muestro 1 UF = xxx CLP
        infoEl.textContent =
          '1 UF = ' +
          valorUf.toLocaleString('es-CL', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
          }) +
          ' CLP';

        loadingEl.style.display = 'none';
        contentEl.style.display = 'block';
      })
      .catch(err => {
        loadingEl.style.display = 'none';
        errorEl.textContent    = err.message;
        errorEl.style.display  = 'block';
        console.error('Error al cargar UF:', err);
      });
  }

  function convertirPesosAUf() {
    if (!valorUf) { inputUf.value = ''; return; }

    const raw   = inputPesos.value.replace(/\./g, '');
    const pesos = parseInt(raw, 10);
    if (isNaN(pesos)) { inputUf.value = ''; return; }

    const uf = pesos / valorUf;
    inputUf.value = isFinite(uf) ? uf.toFixed(4) : '';
  }

  function convertirUfAPesos() {
    if (!valorUf) { inputPesos.value = ''; return; }

    const ufValue = parseFloat(inputUf.value);
    if (isNaN(ufValue)) { inputPesos.value = ''; return; }

    const pesos = Math.round(ufValue * valorUf);
    inputPesos.value = formatCLP(pesos.toString());
  }

  document.addEventListener('DOMContentLoaded', () => {
    inputPesos.addEventListener('input', e => {
      e.target.value = formatCLP(e.target.value);
      convertirPesosAUf();
    });

    inputUf.addEventListener('input', convertirUfAPesos);

    cargarValorUf();
  });
})();