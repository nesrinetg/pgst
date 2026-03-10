<?php
// gestion_utilisateurs.php - Page de gestion des utilisateurs
include 'layouts/app.blade.php';
?>

<header class="header">
    <div class="page-title">
        <h1>Gestion des utilisateurs</h1>
        <p>Administration des comptes</p>
    </div>
    <div class="header-actions">
        <button class="btn-add" onclick="showNotification('Ajout d\'un utilisateur')">
            <i class="bi bi-plus"></i> Ajouter un utilisateur
        </button>
    </div>
</header>

<div class="users-table-container">
    <table>
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Rôle</th>
                <th>Email</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            ?>
        </tbody>
    </table>
</div>

<?php include 'layouts/footer.blade.php';?>