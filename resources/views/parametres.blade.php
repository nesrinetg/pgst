<?php
// parametres.php - Page des paramètres
include 'layouts/app.blade.php';
?>

<header class="header">
    <div class="page-title">
        <h1>Paramètres</h1>
        <p>Configuration de l'application</p>
    </div>
</header>

<div class="settings-form">
    <form method="POST" action="">
        <div class="form-group">
            <label class="form-label">Nom de l'application</label>
            <input type="text" class="form-control" value="Plateforme de gestion des sous-traitants">
        </div>
        <div class="form-group">
            <label class="form-label">Email de contact</label>
            <input type="email" class="form-control" value="contact@algerietelecom.dz">
        </div>
        <div class="form-group">
            <label class="form-label">Langue</label>
            <select class="form-control">
                <option>Français</option>
                <option>Arabe</option>
                <option>Anglais</option>
            </select>
        </div>
        <button type="submit" class="btn-add" onclick="showNotification('Paramètres enregistrés')">Enregistrer</button>
    </form>
</div>

<?php include 'layouts/footer.blade.php';?>