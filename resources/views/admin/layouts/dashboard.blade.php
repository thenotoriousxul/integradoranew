<!DOCTYPE html>
<html lang="es">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>{{ $title ?? 'Dashboard' }}</title>
</head>
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
crossorigin="anonymous"
/>
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
/>
<style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  margin: 0;
  padding: 0;
  font-family: "Inter", sans-serif;
  height: 100%;
  background-color: #f3f3f3 !important;
}
    .overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); 
  z-index: 999; 
}
.dash-body {
  flex-grow: 1;
  padding: 20px;
  margin-left: 250px;
  transition: margin-left 0.3s ease-in-out;
}

.dash-body.expanded {
  margin-left: 0;
}
.menu-container::-webkit-scrollbar {
  width: 0px; 
  background: transparent; 
}
/* Para Firefox */
.menu-container {
  scrollbar-width: none; 
  -ms-overflow-style: none; 
}
.menu-container {
  overflow: hidden; 
  overflow-y: scroll; 
}
.menu-container::-webkit-scrollbar {
  display: none; 
}

@media (max-width: 768px) {

  .dash-body {
    margin-left: 0;
    width: 100%;
  }
  .dash-body.expanded {
    margin-left: 0;
  }
  .overlay.visible {
    display: block;
  }
  
}

</style>
<body>
    @include('admin.layouts.sidebar') 


    <div class="overlay" id="overlay"></div>


    <main class="dash-body" id="dash-body">
        <header class="header">
            @include('admin.layouts.headerdash')
        </header>

        <div class="">
            @yield('content') 
        </div>
    </main>

    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
</body>
</html>
