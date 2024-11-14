document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.getElementById("raya");
    const sidebar = document.querySelector(".sidebar-container");
    const mainContent = document.getElementById("dash-body");
    const overlay = document.getElementById("overlay");
  
    function toggleSidebar() {
      const isMobile = window.innerWidth <= 768;
  
      if (isMobile) {
        sidebar.classList.toggle("visible");
        overlay.classList.toggle("visible");
      } else {
        sidebar.classList.toggle("hidden"); 
        mainContent.classList.toggle("expanded");
      }
    }
  
    toggleButton.addEventListener("click", toggleSidebar);
    overlay.addEventListener("click", toggleSidebar);
  
    window.addEventListener("resize", () => {
      const isMobile = window.innerWidth <= 768;
  
      if (!isMobile) {

        sidebar.classList.remove("visible");
        overlay.classList.remove("visible");
  
        if (sidebar.classList.contains("hidden")) {
          mainContent.classList.add("expanded");
        } else {
          mainContent.classList.remove("expanded");
        }
      } else {
        sidebar.classList.remove("hidden");
        mainContent.classList.remove("expanded");
      }
    });
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