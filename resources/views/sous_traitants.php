<?php
// sous_traitants.php - Page de gestion des sous-traitants
include 'includes/header.php';
?>

<header class="header">
    <div class="page-title">
        <h1>Sous-traitants</h1>
        <p>Gestion et suivi des sous-traitants</p>
    </div>
    <div class="header-actions">
        <button class="btn-add" onclick="showNotification('Ajout d\'un sous-traitant')">
            <i class="bi bi-plus"></i> Ajouter un sous-traitant
        </button>
    </div>
</header>

<div class="sous-traitants-grid">
    
</div>

<?php include 'includes/footer.php'; ?>