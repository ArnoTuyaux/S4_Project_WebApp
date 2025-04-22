<link rel="stylesheet" href="css/nav.css?v=1">
<link rel="stylesheet" href="css/barmanAccueil.css?v=1">

<?php
if ($tables && is_array($tables)) {
    echo "<div class='zones-container'>";

    foreach ($zones as $zoneName => $ids) {
        echo "<div class='zone'><h2>$zoneName</h2>";
        foreach ($tables as $table) {
            $id = $table['ID_TABLES'];
            if (in_array($id, $ids)) {
                $statut = $table['statut_table'];

                echo "<button class='table-btn' data-statut='$statut' data-id='$id'>Table $id</button>";
            }
        }
        echo "</div>";
    }

    echo "</div>";
} else {
    echo "Erreur lors du chargement des tables.";
}
?>

<script>
    let commandesData = [];
    let toutesLesReservations = [];
    let reservationId = null; // ← Important ! pas touché

    // Charger les commandes actives
    fetch('http://localhost/Projet_S4/api/get_commandes_actives.php')
        .then(res => res.json())
        .then(data => {
            commandesData = data;
        });

    // Charger toutes les réservations du jour
    fetch('http://localhost/Projet_S4/api/get_reservations.php')
        .then(res => res.json())
        .then(data => {
            toutesLesReservations = data;
        });

    // Sélection des boutons de table
    let boutons = document.querySelectorAll('.table-btn');

    boutons.forEach(function(bouton) {
        let statut = bouton.dataset.statut;
        let idTable = bouton.dataset.id;

        // Si la table est occupée
        if (statut === 'Occupee') {
            bouton.addEventListener('click', function() {
                let commandes = commandesData.filter(function(cmd) {
                    return cmd.ID_TABLES == idTable;
                });
                afficherModaleCommande(commandes, idTable);
            });
        }

        // Si la table est réservée
        if (statut === 'Reservee') {
            bouton.addEventListener('click', function() {
                const reservationsTable = toutesLesReservations.filter(r => r.id_tables == idTable);
                afficherModaleReservee(reservationsTable, idTable);
            });
        }
    });

    function afficherModaleCommande(commandes, numeroTable) {
        let modal = document.getElementById('commandeModal');
        let details = document.getElementById('commandeDetails');
        let tableSpan = document.getElementById('tableNum');

        tableSpan.textContent = numeroTable;
        details.innerHTML = "";

        if (commandes.length > 0) {
            let html = "<ul>";
            commandes.forEach(function(cmd) {
                html += "<li>" + cmd.NOM_PLAT + " - " + cmd.PRIX + "€</li>";
            });
            html += "</ul>";
            details.innerHTML = html;
        } else {
            details.textContent = "Aucune commande trouvée pour cette table.";
        }

        modal.style.display = "flex";
    }

    function afficherModaleReservee(reservations, tableId) {
        const modal = document.getElementById('reserveeModal');
        const nomInput = document.getElementById('resNom');
        const telInput = document.getElementById('resTel');
        const dateInput = document.getElementById('resDate');
        const horaireInput = document.getElementById('resHoraire');
        const nbInput = document.getElementById('resNb');
        const autresContainer = document.getElementById('autresReservations');

        let current = 0;

        function remplirFormulaire(index) {
            const r = reservations[index];
            reservationId = r.id_reservation; // mise à jour de la variable globale
            nomInput.value = r.nom_client;
            telInput.value = r.TELEPHONE;
            dateInput.value = r.date_reservation;
            horaireInput.value = r.horaire;
            nbInput.value = r.NOMBRE_PERSONNE;
        }

        if (reservations.length > 0) {
            remplirFormulaire(current);

            autresContainer.innerHTML = '';
            reservations.forEach((res, index) => {
                const btn = document.createElement('button');
                btn.textContent = `Nom : ${res.nom_client}\nHoraire : ${res.horaire}`;
                btn.className = "btn btn-warning";
                btn.onclick = () => {
                    current = index;
                    remplirFormulaire(current);
                };
                autresContainer.appendChild(btn);
            });

            modal.style.display = "flex";
        } else {
            alert("Aucune réservation trouvée pour cette table.");
        }
    }

    // Bouton “OK” : mise à jour réservation
    document.getElementById('reservationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('action', 'update');
        formData.append('id', reservationId);
        formData.append('nom', document.getElementById('resNom').value);
        formData.append('tel', document.getElementById('resTel').value);
        formData.append('date', document.getElementById('resDate').value);
        formData.append('horaire', document.getElementById('resHoraire').value);
        formData.append('nb', document.getElementById('resNb').value);

        fetch('http://localhost/Projet_S4/controllers/traitement_reservation.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                console.log("Réponse serveur :", data);
                if (data.success) {
                    alert("Réservation mise à jour !");
                    location.reload();
                } else {
                    alert("Erreur lors de la mise à jour.");
                }
            })
            .catch(err => {
                console.error("Erreur JSON :", err);
                alert("Une erreur est survenue.");
            });
    });

    // Bouton "Supprimer"
    document.getElementById('supprimerBtn').addEventListener('click', function() {
        if (confirm("Tu es sûr de vouloir supprimer cette réservation ?")) {
            const formData = new FormData();
            formData.append('action', 'delete');
            formData.append('id', reservationId);

            fetch('http://localhost/Projet_S4/controllers/traitement_reservation.php', {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert("Réservation supprimée.");
                        location.reload();
                    } else {
                        alert("Erreur lors de la suppression.");
                    }
                })
                .catch(err => {
                    console.error("Erreur JSON :", err);
                    alert("Une erreur est survenue.");
                });
        }
    });

    // Fermeture des modales
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('commandeModal').style.display = 'none';
    });

    document.getElementById('closeReserveeModal').addEventListener('click', function() {
        document.getElementById('reserveeModal').style.display = 'none';
    });

    window.addEventListener('click', function(e) {
        let commandeModal = document.getElementById('commandeModal');
        let reserveeModal = document.getElementById('reserveeModal');

        if (e.target === commandeModal) {
            commandeModal.style.display = 'none';
        }
        if (e.target === reserveeModal) {
            reserveeModal.style.display = 'none';
        }
    });
</script>





