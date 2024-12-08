<style>
    .headerr {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  background-color: gold;
  border-radius: 10px;
  height: 60px;
  color: #ffffff;
  font-weight: bold;
}

.raya {
  background-color: transparent;
  border: none;
  color: #ffffff;
  font-size: 24px;
  cursor: pointer;
  padding: 10px;
  margin-right: 10px;
}

.raya:hover {
  background-color: #374151;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.title-dash {
  font-size: 25px;
  margin-left: 10px;
  font-weight: lighter;
}
.eliconuser
{
  margin-right:30px; 
}
</style>

<header class="headerr">
    <button id="raya" class="raya"><i class="fas fa-bars"></i></button>
    <div class="title-dashh">
      <h1 class="title-dash">{{ $title ?? 'Dashboard' }}</h1>
    </div>
  
    <div class="eliconuser">
    </div>
  </header>