// Função para filtrar os produtos
  function filterProducts() {
    const searchInput = document.querySelector('.form-control');
    const searchTerm = searchInput.value.toLowerCase();
    const products = document.querySelectorAll('.col-md-3');

    products.forEach(function(product) {
      const title = product.querySelector('.card-title').textContent.toLowerCase();
      const text = product.querySelector('.card-text').textContent.toLowerCase();

      if (title.includes(searchTerm) || text.includes(searchTerm)) {
        product.style.display = 'block';
      } else {
        product.style.display = 'none';
      }
    });
  }

  // Ouvinte de evento para capturar o envio do formulário
  document.querySelector('.form-inline').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    filterProducts();
  });
