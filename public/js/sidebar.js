document.addEventListener("DOMContentLoaded", () => {
  const toggleButton = document.getElementById("raya");
  const sidebar = document.querySelector(".sidebar-container");
  const mainContent = document.getElementById("dash-body");
  const overlay = document.getElementById("overlay");

  const isMobile = () => window.innerWidth <= 768;

  function toggleSidebar() {
      if (isMobile()) {
          sidebar.classList.toggle("visible");
          overlay.classList.toggle("visible");
      } else {
          sidebar.classList.toggle("hidden");
          mainContent.classList.toggle("expanded");
      }
  }

  function adjustLayout() {
      if (isMobile()) {
          sidebar.classList.remove("hidden", "visible");
          mainContent.classList.remove("expanded");
          overlay.classList.remove("visible");
      } else {
          sidebar.classList.remove("visible");
          overlay.classList.remove("visible");
          mainContent.classList.toggle("expanded", sidebar.classList.contains("hidden"));
      }
  }

  toggleButton.addEventListener("click", toggleSidebar);
  overlay.addEventListener("click", toggleSidebar);
  window.addEventListener("resize", adjustLayout);
});

  
  document.addEventListener('DOMContentLoaded', function() {
    const inventoryItem = document.getElementById('inventario-item');
    const inventorySubmenu = document.getElementById('inventario-submenu');
    
    inventoryItem.addEventListener('click', function(e) {
      e.preventDefault();
      inventorySubmenu.style.display = inventorySubmenu.style.display === 'none' ? 'block' : 'none';
    });
  });
  

  document.addEventListener('DOMContentLoaded', function() {
    const inventoryItem = document.getElementById('ordenes');
    const inventorySubmenu = document.getElementById('ordenes-submenu');
    
    inventoryItem.addEventListener('click', function(e) {
      e.preventDefault();
      inventorySubmenu.style.display = inventorySubmenu.style.display === 'none' ? 'block' : 'none';
    });
  });
  
  document.addEventListener('DOMContentLoaded', function() {
    const inventoryItem = document.getElementById('configuracion');
    const inventorySubmenu = document.getElementById('configuracion-submenu');
    
    inventoryItem.addEventListener('click', function(e) {
      e.preventDefault();
      inventorySubmenu.style.display = inventorySubmenu.style.display === 'none' ? 'block' : 'none';
    });
  });


  document.addEventListener('DOMContentLoaded', function() {
    const inventoryItem = document.getElementById('ediciones');
    const inventorySubmenu = document.getElementById('ediciones-submenu');
    
    inventoryItem.addEventListener('click', function(e) {
      e.preventDefault();
      inventorySubmenu.style.display = inventorySubmenu.style.display === 'none' ? 'block' : 'none';
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    const inventoryItem = document.getElementById('estampados');
    const inventorySubmenu = document.getElementById('estampados-submenu');
    
    inventoryItem.addEventListener('click', function(e) {
      e.preventDefault();
      inventorySubmenu.style.display = inventorySubmenu.style.display === 'none' ? 'block' : 'none';
    });
  });


  document.addEventListener('DOMContentLoaded', function() {
    const inventoryItem = document.getElementById('proveedores');
    const inventorySubmenu = document.getElementById('proveedores-submenu');
    
    inventoryItem.addEventListener('click', function(e) {
      e.preventDefault();
      inventorySubmenu.style.display = inventorySubmenu.style.display === 'none' ? 'block' : 'none';
    });
  });

  
  document.addEventListener('DOMContentLoaded', function() {
    const inventoryItem = document.getElementById('acciones');
    const inventorySubmenu = document.getElementById('acciones-submenu');
    
    inventoryItem.addEventListener('click', function(e) {
      e.preventDefault();
      inventorySubmenu.style.display = inventorySubmenu.style.display === 'none' ? 'block' : 'none';
    });
  });