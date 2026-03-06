<?php
// tickets.php - Page de gestion des tickets
include 'includes/header.php';
?>

<header class="header">
    <div class="page-title">
        <h1>Tickets</h1>
        <p>Gestion des tickets d'intervention</p>
    </div>
</header>

<div class="tickets-filters">
    <input type="text" class="search-box" placeholder="Rechercher un ticket...">
    <select class="filter-select">
        <option>Tous les statuts</option>
        <option>En cours</option>
        <option>En retard</option>
        <option>Clôturé</option>
    </select>
   <select class="filter-select">
    <option>Toutes les wilayas</option>
    <option>Adrar</option>
    <option>Chlef</option>
    <option>Laghouat</option>
    <option>Oum El Bouaghi</option>
    <option>Batna</option>
    <option>Béjaïa</option>
    <option>Biskra</option>
    <option>Béchar</option>
    <option>Blida</option>
    <option>Bouira</option>
    <option>Tamanrasset</option>
    <option>Tébessa</option>
    <option>Tlemcen</option>
    <option>Tiaret</option>
    <option>Tizi Ouzou</option>
    <option>Alger</option>
    <option>Djelfa</option>
    <option>Jijel</option>
    <option>Sétif</option>
    <option>Saïda</option>
    <option>Skikda</option>
    <option>Sidi Bel Abbès</option>
    <option>Annaba</option>
    <option>Guelma</option>
    <option>Constantine</option>
    <option>Médéa</option>
    <option>Mostaganem</option>
    <option>M'Sila</option>
    <option>Mascara</option>
    <option>Ouargla</option>
    <option>Oran</option>
    <option>El Bayadh</option>
    <option>Illizi</option>
    <option>Bordj Bou Arreridj</option>
    <option>Boumerdès</option>
    <option>El Tarf</option>
    <option>Tindouf</option>
    <option>Tissemsilt</option>
    <option>El Oued</option>
    <option>Khenchela</option>
    <option>Souk Ahras</option>
    <option>Tipaza</option>
    <option>Mila</option>
    <option>Aïn Defla</option>
    <option>Naâma</option>
    <option>Aïn Témouchent</option>
    <option>Ghardaïa</option>
    <option>Relizane</option>
    <option>Timimoun</option>
    <option>Bordj Badji Mokhtar</option>
    <option>Ouled Djellal</option>
    <option>Béni Abbès</option>
    <option>In Salah</option>
    <option>In Guezzam</option>
    <option>Touggourt</option>
    <option>Djanet</option>
    <option>El M'Ghair</option>
    <option>El Meniaa</option>
</select>
</div>

<div class="card">
    <div class="tickets-table">
        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Client</th>
                    <th>Zone</th>
                    <th>Sous-traitant</th>
                    <th>Statut</th>
                    <th>SLA</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
               
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>