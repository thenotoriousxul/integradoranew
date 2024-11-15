document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('table');
    const visualizer = document.getElementById('visualizer');
    const overlay = document.getElementById('overlayy');
    const productImage = document.getElementById('product-image');
    const productTitle = document.getElementById('product-title');
    const productStock = document.getElementById('product-stock');
    const productPrice = document.getElementById('product-price');
    const productStatus = document.getElementById('product-status');

    let currentProductId = null;

    function toggleVisualizer(show, productData) {
        if (show) {
            productImage.src = productData.imgSrc;
            productTitle.textContent = `${productData.id} - ${productData.name}`;
            productStock.textContent = `${productData.stock} - Warehouse 1`;
            productPrice.textContent = productData.price;
            productStatus.textContent = 'Status: Ready';
            productStatus.className = 'badge bg-success';

            visualizer.style.display = 'block';
            overlay.style.display = 'block';
        } else {
            visualizer.style.display = 'none';
            overlay.style.display = 'none';
            currentProductId = null;
        }
    }

    table.addEventListener('click', function(e) {
        const row = e.target.closest('tr');
        if (row) {
            const id = row.getAttribute('data-id');
            if (id === currentProductId) {
                toggleVisualizer(false);
            } else {
                const name = row.querySelector('td:nth-child(2)').textContent.trim();
                const price = row.querySelector('td:nth-child(3)').textContent;
                const stock = row.querySelector('td:nth-child(4)').textContent;
                const imgSrc = row.querySelector('img').src;

                toggleVisualizer(true, { id, name, price, stock, imgSrc });
                currentProductId = id;
            }
        }
    });

    overlay.addEventListener('click', function() {
        toggleVisualizer(false);
    });
});