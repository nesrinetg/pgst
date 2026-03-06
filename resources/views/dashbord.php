<?php
// dashboard.php - Page d'accueil
include 'includes/header.php';
?>

<header class="header">
    <div class="page-title">
        <h1>Dashboard</h1>
        <p>Vue d'ensemble des activités et performances</p>
    </div>
    <div class="header-actions">
        <div class="date-range">
            <span>📅</span> 7 derniers jours
        </div>
        <div class="notification-icon">🔔</div>
    </div>
</header>

<!-- KPI Rapides -->
<div class="kpi-row">
    <div class="kpi-card">
        <div class="kpi-label">Taux de résolution</div>
        <div class="kpi-value"> ...%</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-label">Interventions en cours</div>
        <div class="kpi-value">....</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-label">Retards SLA</div>
        <div class="kpi-value">....</div>
    </div>
</div>

<!-- Row: Interventions par zone + Classement -->
<div class="row-split">
    <!-- Graphique zones -->
    <div class="card">
        <div class="card-header">
            <h3>Interventions par zone</h3>
            <span class="badge-filter">7 jours</span>
        </div>
        <div class="graph-container">
            <div class="bar-chart">
                <?php
              
                ?>
            </div>
            <div class="legend">
                <div class="legend-item"><span class="dot-green"></span> Dans SLA</div>
                <div class="legend-item"><span class="dot-red"></span> Retard</div>
            </div>
        </div>
    </div>

    <!-- Classement sous-traitants -->
    <div class="card">
        <div class="card-header">
            <h3>Classement des sous-traitants</h3>
            <span class="badge-filter">7 jours</span>
        </div>
        <div class="ranking-list">
            <?php
           
            ?>
        </div>
    </div>
</div>

<!-- Tickets récents -->
<div class="card" style="margin-top: 8px;">
    <div class="card-header">
        <h3>Tickets récents</h3>
        <span class="badge-filter">Dernières mises à jour</span>
    </div>
    <div class="tickets-table">
        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Ticket</th>
                    <th>Client</th>
                    <th>Zone</th>
                    <th>Sous-traitant</th>
                    <th>Statut</th>
                    <th>SLA</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>
    <div class="footer-note">
        <span> Superviser AT · % Taux de résolution</span>
    </div>
</div>

<?php include 'includes/footer.php'; ?>