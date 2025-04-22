<!-- views/modals/reservationModal.php -->
<div id="reservationModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>

        <h2>Réservation</h2>
        <form method="post" action="controllers/reservationM.php">
            <input type="text" name="nom_client" placeholder="Nom" required><br>
            <input type="tel" name="telephone" placeholder="Téléphone" required><br>
            <input type="date" name="date" required><br>
            <input type="time" name="horaire" required><br>
            <input type="number" name="nombre_personne" placeholder="Nombre de personnes" required><br>
            <input type="number" name="id_table" placeholder="N° table" required><br>
            <button type="submit">Réserver</button>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('reservationModal').style.display = 'block';
    }
    function closeModal() {
        document.getElementById('reservationModal').style.display = 'none';
    }
</script>

