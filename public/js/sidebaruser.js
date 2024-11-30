function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
}

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const hamburger = document.querySelector('.hamburger');
    if (window.innerWidth <= 768 && !sidebar.contains(event.target) && !hamburger.contains(event.target)) {
        sidebar.classList.remove('active');
    }
});

// Handle resize events
window.addEventListener('resize', function() {
    const sidebar = document.getElementById('sidebar');
    if (window.innerWidth > 768) {
        sidebar.classList.remove('active');
    } else {
        sidebar.classList.remove('active');
    }
});