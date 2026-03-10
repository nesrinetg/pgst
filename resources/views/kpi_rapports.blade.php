<?php
// kpi_rapports.php - Page KPI & Rapports
include 'layouts/app.blade.php';
?>

<header class="header">
    <div class="page-title">
        <h1>KPI & Rapports</h1>
        <p>Indicateurs de performance</p>
    </div>
</header>

<div class="kpi-grid">
    <div class="kpi-chart-card">
        <h3>Performance par zone</h3>
        <div style="height: 250px; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
            Graphique en construction...
        </div>
    </div>
    <div class="kpi-chart-card">
        <h3>Évolution des interventions</h3>
        <div style="height: 250px; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
            Graphique en construction...
        </div>
    </div>
    <div class="kpi-chart-card">
        <h3>Respect des SLA</h3>
        <div style="height: 250px; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
            Graphique en construction...
        </div>
    </div>
</div>

<?php include 'layouts/footer.blade.php';?>