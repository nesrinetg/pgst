<?php
// header.php - Navigation partagée pour toutes les pages
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Algérie Télécom - Gestion des sous-traitants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body>
<div class="app-container">
    <!-- Sidebar (Nav) en bleu -->
    <aside class="sidebar">
        <div class="logo">
            <h2>Algérie Télécom</h2>
            <span>Plateforme de gestion des sous-traitants</span>
        </div>
        <nav class="nav-menu">
            <a href="dashbord.blade.php" class="nav-item <?php echo $current_page == 'dashbord.blade.php' ? 'active' : ''; ?>">
                <span class="nav-icon">📊</span>
                <span>Dashboard</span>
            </a>
            <a href="sous_traitants.blade.php" class="nav-item <?php echo $current_page == 'sous_traitants.blade.php' ? 'active' : ''; ?>">
                <span class="nav-icon">👥</span>
                <span>Sous-traitants</span>
            </a>
            <a href="zones.blade.php" class="nav-item <?php echo $current_page == 'zones.blade.php' ? 'active' : ''; ?>">
                <span class="nav-icon">📍</span>
                <span>Zones</span>
            </a>
            <a href="tickets.blade.php" class="nav-item <?php echo $current_page == 'tickets.blade.php' ? 'active' : ''; ?>">
                <span class="nav-icon">🎫</span>
                <span>Tickets</span>
            </a>
            <a href="kpi_rapports.blade.php" class="nav-item <?php echo $current_page == 'kpi_rapports.blade.php' ? 'active' : ''; ?>">
                <span class="nav-icon">📈</span>
                <span>KPI & Rapports</span>
            </a>
            <a href="parametres.blade.php" class="nav-item <?php echo $current_page == 'parametres.blade.php' ? 'active' : ''; ?>">
                <span class="nav-icon">⚙️</span>
                <span>Paramètres</span>
            </a>
            <a href="gestion_utilisateurs.blade.php" class="nav-item <?php echo $current_page == 'gestion_utilisateurs.blade.php' ? 'active' : ''; ?>">
                <span class="nav-icon">👤</span>
                <span>Gestion des utilisateurs</span>
            </a>
        </nav>
        <div class="user-section">
            <div class="user-info">
                <div class="user-avatar">X</div>
                <div class="user-details">
                    <h4> Superviser AT</h4>
                    <p><span class="resolution-badge">......% Taux de résolution</span></p>
                </div>
            </div>
        </div>
    </aside>
    
    <!-- Main content -->
    <main class="main-content">