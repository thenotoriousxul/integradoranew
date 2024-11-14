@extends('admin.layouts.dashboard')

@section('content')

<style>
    .dash-info {
  display: grid;
  gap: 20px;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  margin-bottom: 40px;
}

.card {
  padding: 20px;
  border-radius: 10px;
  color: #ffffff;
}

.card:nth-child(1) {
  background: linear-gradient(to right, #ffd700, #ffa500);
}

.card:nth-child(2) {
  background: linear-gradient(to right, #00bfff, #1e90ff);
}

.card:nth-child(3) {
  background: linear-gradient(to right, #32cd32, #00fa9a);
}

.dashboard-sections, .section-columns {
  display: grid;
  gap: 20px;
}
.section-columns
{
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
}

.dashboard-section {
  background-color: #1f2937;
  border-radius: 10px;
  padding: 20px;

}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.section-title {
  font-size: 18px;
}

.section-content {
  height: 300px;
  background-color: #3a354c;
  border-radius: 5px;
}

</style>



<div class="dash-info">
    <div class="card">
      <h2>Ingresos Del Mes</h2>
      <div class="table-info"></div>
    </div>
    <div class="card">
      <h2>Ventas del mes</h2>
      <div class="table-info"></div>
    </div>
    <div class="card">
      <h2>Nuevos clientes</h2>
      <div class="table-info"></div>
    </div>
  </div>

  <div class="dashboard-sections">
    <div class="dashboard-section">
      <div class="section-header">
        <h2 class="section-title">Actividad Reciente</h2>
      </div>
      <div class="section-content"></div>
    </div>
      <div class="section-columns">
        <div class="dashboard-section">
          <div class="section-header">
            <h2 class="section-title">Alertas</h2>
          </div>
          <div class="section-content"></div>
        </div>

        <div class="dashboard-section">
          <div class="section-header">
            <h2 class="section-title">Productos mas vendidos</h2>
          </div>
          <div class="section-content"></div>
        </div>
      </div>
    
  </div>

@endsection