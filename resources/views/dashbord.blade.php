<?php
// dashboard.php - Page d'accueil
include 'layouts/app.blade.php';
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

<!-- Barre de recherche simple - large, carrée, centrée -->
<div style="display: flex; justify-content: center; margin: 20px 0 30px 0;">
    <div style="position: relative; width: 80%; max-width: 800px;">
        <i class="bi bi-search" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 1.2rem;"></i>
        <input type="text"
               id="globalSearch"
               placeholder="Rechercher un ticket, sous-traitant, client..."
               style="width: 100%;
                      padding: 18px 25px 18px 55px;
                      border: 2px solid #e2e8f0;
                      border-radius: 12px;
                      font-size: 1rem;
                      outline: none;
                      transition: all 0.3s ease;
                      background: white;
                      box-shadow: 0 4px 6px rgba(0,0,0,0.02);"
                      onfocus="this.style.borderColor='#1e3a8a'; this.style.boxShadow='0 4px 12px rgba(30, 58, 138, 0.1)';"
                      onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.02)';"
                      onkeyup="if(event.key === 'Enter') performSimpleSearch();">
    </div>
</div>

<!-- Résultats de recherche (caché par défaut) -->
<div id="searchResults" style="display: none; margin: 0 auto 30px auto; width: 80%; max-width: 800px; background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
    <div style="padding: 15px 20px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1rem; font-weight: 600; color: #1e293b; margin: 0;">Résultats de recherche</h3>
        <span id="simpleResultCount" style="background: #f1f5f9; padding: 4px 12px; border-radius: 30px; font-size: 0.8rem; color: #475569;">0 résultats</span>
    </div>
    <div id="simpleSearchResultsContent" style="padding: 10px;">
        <!-- Les résultats seront affichés ici -->
    </div>
</div>

<!-- KPI Rapides -->
<div class="kpi-row">
    <div class="kpi-card">
        <div class="kpi-label">Taux de résolution</div>
        <div class="kpi-value">  %</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-label">Interventions en cours</div>
        <div class="kpi-value">  </div>
    </div>
    <div class="kpi-card">
        <div class="kpi-label">Retards SLA</div>
        <div class="kpi-value"> </div>
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
                <?php
               
                ?>
            </tbody>
        </table>
    </div>
    <div class="footer-note">
        <span>Superviser AT ·   % Taux de résolution</span>
    </div>
</div>

<script>
// Fonction de recherche simple
function performSimpleSearch() {
    const searchTerm = document.getElementById('globalSearch').value.toLowerCase();
    const resultsDiv = document.getElementById('searchResults');
    const resultsContent = document.getElementById('simpleSearchResultsContent');
    const resultCount = document.getElementById('simpleResultCount');

    if (searchTerm.length < 2) {
        alert('Veuillez entrer au moins 2 caractères');
        return;
    }

    // Simuler des résultats de recherche
    const searchResults = [];

    // Données de recherche
    const ticketsData = [
        { type: 'ticket', id: '19042', title: 'Ticket #19042', description: 'Ahmed B. - Algiers', url: 'tickets.php?search=19042' },
        { type: 'ticket', id: '19041', title: 'Ticket #19041', description: 'Entreprise XYZ - Mostaganem', url: 'tickets.php?search=19041' },
        { type: 'ticket', id: '19040', title: 'Ticket #19040', description: 'Karim D. - Blida', url: 'tickets.php?search=19040' },
        { type: 'ticket', id: '19039', title: 'Ticket #19039', description: 'Nadia K. - Tizi Ouzou', url: 'tickets.php?search=19039' },
        { type: 'ticket', id: '19038', title: 'Ticket #19038', description: 'Amine L. - Constantine', url: 'tickets.php?search=19038' }
    ];

    const sousTraitantsData = [
        { type: 'sous-traitant', id: 'ST001', title: 'Société A', description: 'Alger Centre - 47 interventions', url: 'sous_traitants.php?search=Société A' },
        { type: 'sous-traitant', id: 'ST002', title: 'Société B', description: 'Oran - 32 interventions', url: 'sous_traitants.php?search=Société B' },
        { type: 'sous-traitant', id: 'ST003', title: 'Société C', description: 'Constantine - 28 interventions', url: 'sous_traitants.php?search=Société C' },
        { type: 'sous-traitant', id: 'ST004', title: 'Société D', description: 'Blida - 19 interventions', url: 'sous_traitants.php?search=Société D' }
    ];

    const clientsData = [
        { type: 'client', id: 'CL001', title: 'Ahmed B.', description: 'Client résidentiel - Algiers', url: 'tickets.php?client=Ahmed' },
        { type: 'client', id: 'CL002', title: 'Entreprise XYZ', description: 'Client professionnel - Mostaganem', url: 'tickets.php?client=XYZ' },
        { type: 'client', id: 'CL003', title: 'Karim D.', description: 'Client résidentiel - Blida', url: 'tickets.php?client=Karim' },
        { type: 'client', id: 'CL004', title: 'Nadia K.', description: 'Client résidentiel - Tizi Ouzou', url: 'tickets.php?client=Nadia' },
        { type: 'client', id: 'CL005', title: 'Amine L.', description: 'Client résidentiel - Constantine', url: 'tickets.php?client=Amine' }
    ];

    // Recherche dans toutes les données
    [...ticketsData, ...sousTraitantsData, ...clientsData].forEach(item => {
        if (item.title.toLowerCase().includes(searchTerm) ||
            item.description.toLowerCase().includes(searchTerm) ||
            item.id.toLowerCase().includes(searchTerm)) {
            searchResults.push(item);
        }
    });

    // Afficher les résultats
    if (searchResults.length > 0) {
        let html = '';
        searchResults.forEach(result => {
            let icon = '📄';
            if (result.type === 'sous-traitant') icon = '👥';
            if (result.type === 'client') icon = '👤';
            if (result.type === 'ticket') icon = '🎫';

            html += `
                <a href="${result.url}" style="text-decoration: none; color: inherit;">
                    <div style="display: flex; align-items: center; gap: 15px; padding: 15px; border-bottom: 1px solid #edf2f7; transition: all 0.3s;">
                        <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #1e3a8a, #2563eb); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                            ${icon}
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: #1e293b;">${result.title}</div>
                            <div style="font-size: 0.9rem; color: #64748b;">${result.description}</div>
                        </div>
                        <div style="color: #1e3a8a;">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </a>
            `;
        });

        resultsContent.innerHTML = html;
        resultCount.innerText = searchResults.length + ' résultat(s)';
        resultsDiv.style.display = 'block';
    } else {
        resultsContent.innerHTML = '<div style="padding: 40px; text-align: center; color: #94a3b8;">Aucun résultat trouvé pour "' + searchTerm + '"</div>';
        resultCount.innerText = '0 résultat';
        resultsDiv.style.display = 'block';
    }
}
</script>

<?php include 'layouts/footer.blade.php'; ?>