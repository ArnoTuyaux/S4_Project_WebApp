<div id="commandeModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2>Commande de la table <span id="tableNum"></span></h2>
        <div id="commandeDetails">Chargement...</div>
    </div>
</div>

<!--<div id="reserveeModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-btn" id="closeReserveeModal">&times;</span>
        <h1>Page Réservée</h1>
    </div>
</div>
-->

<div id="reserveeModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-btn" id="closeReserveeModal">&times;</span>
        <h1>Réservation</h1>

        <form id="reservationForm">
            <label>Nom : <input type="text" id="resNom"></label><br>
            <label>Téléphone : <input type="text" id="resTel"></label><br>
            <label>Date : <input type="text" id="resDate" disabled></label><br>
            <label>Horaire : <input type="text" id="resHoraire"></label><br>
            <label>Nb personnes : <input type="number" id="resNb"></label><br>
            <button type="button" id="supprimerBtn" class="btn btn-danger">Supprimer la réservation</button>
            <button type="submit" class="btn btn-success">OK</button>
        </form>

        <hr>
        <h3>Autre réservation</h3>
        <div id="autresReservations" style="display: flex; gap: 10px;"></div>
    </div>
</div>
