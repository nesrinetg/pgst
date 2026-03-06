<?php
// zones.php - Page de gestion des zones
include 'includes/header.php';
?>

<header class="header">
    <div class="page-title">
        <h1>Zones</h1>
        <p>Gestion des zones d'intervention</p>
    </div>
    <div class="header-actions">
        <button class="btn-add" onclick="showNotification('Ajout d\'une zone')">
            <i class="bi bi-plus"></i> Ajouter une zone
        </button>
    </div>
</header>

<div class="zones-grid">
    <?php
    $zones = [
        ['icon' => '🌆', 'name' => 'Alger', 'sous_traitants' => 12, 'interventions' => 47, 'en_cours' => 8, 'sla' => 91],
        ['icon' => '🏙️', 'name' => 'Oran', 'sous_traitants' => 8, 'interventions' => 32, 'en_cours' => 5, 'sla' => 86],
        ['icon' => '🏛️', 'name' => 'Constantine', 'sous_traitants' => 6, 'interventions' => 28, 'en_cours' => 4, 'sla' => 88],
        ['icon' => '🏔️', 'name' => 'Tizi Ouzou', 'sous_traitants' => 5, 'interventions' => 21, 'en_cours' => 3, 'sla' => 82]
    ];
    
    foreach ($zones as $zone) {
        echo '<div class="zone-card">';
        echo '<div class="zone-header">';
        echo '<div class="zone-icon">' . $zone['icon'] . '</div>';
        echo '<div>';
        echo '<div class="zone-name">' . $zone['name'] . '</div>';
        echo '<div class="text-muted">' . $zone['sous_traitants'] . ' sous-traitants</div>';
        echo '</div>';
        echo '</div>';
        
        echo '<div class="zone-stats">';
        echo '<div><div class="stat-value">' . $zone['interventions'] . '</div><div class="stat-label">Interventions</div></div>';
        echo '<div><div class="stat-value">' . $zone['en_cours'] . '</div><div class="stat-label">En cours</div></div>';
        echo '<div><div class="stat-value">' . $zone['sla'] . '%</div><div class="stat-label">SLA</div></div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>