<body>
<nav class="navbar">
    <button class="back-btn">←</button>
    <div class="nav-buttons">
        <a href="?type=Entree"><button class="<?= ($_GET['type'] ?? 'Plats') === 'Entree' ? 'active' : '' ?>">ENTRÉES</button></a>
        <a href="?type=Plat"><button class="<?= ($_GET['type'] ?? 'Plats') === 'Plat' ? 'active' : '' ?>">PLATS</button></a>
        <a href="?type=Dessert"><button class="<?= ($_GET['type'] ?? 'Plats') === 'Dessert' ? 'active' : '' ?>">DESSERTS</button></a>
        <a href="?type=Boisson"><button class="<?= ($_GET['type'] ?? 'Plats') === 'Boisson' ? 'active' : '' ?>">BOISSONS</button></a>
        <a href="?type=Employe"><button class="<?= ($_GET['type'] ?? 'Plats') === 'Employe' ? 'active' : '' ?>">EMPLOYÉS</button></a>
    </div>
</nav>
<?php foreach ($plats as $plat): ?>
<div class="dish-item">
        <span>
    <?= htmlspecialchars($plat['NOM_PLAT']) ?>
    - <?= number_format($plat['PRIX'], 2, ',', ' ') ?> €
</span>
	<a href="../../controllers/administration/admin_ModifierCarte.php?id=<?= $plat['ID_PLAT'] ?>"><button class="edit">Modifier</button></a>
    <button class="delete" data-id="<?= $plat['ID_PLAT'] ?>">Supprimer</button>
</div>

<div id="confirmModal" class="modal">
    <div class="modal-content">
        <h2>Êtes-vous sûr de vouloir supprimer ce plat ?</h2>
        <button id="confirmYes">Oui</button>
        <button id="confirmNo">Non</button>
    </div>
</div>
<?php endforeach; ?>
<a href="../../controllers/administration/admin_ModifierCarte.php">
<button class="add">Ajouter</button>
</a>

<style>
    .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center; }
    .modal-content { background: white; padding: 20px; text-align: center; }
    button { margin: 10px; }
</style>

<script>
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', (e) => {
            const platId = e.target.dataset.id;
            document.getElementById('confirmModal').style.display = 'flex';

            document.getElementById('confirmYes').onclick = async function() {
                const response = await fetch(`http://localhost/Projet_S4/api/delete_plat.php?id=${platId}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                });

                const result = await response.json();
                if (result.success) {
                    alert('Plat supprimé avec succès !');
                    window.location.reload();
                } else {
                    alert('Erreur : ' + result.message);
                }
                document.getElementById('confirmModal').style.display = 'none';
            };

            document.getElementById('confirmNo').onclick = function() {
                document.getElementById('confirmModal').style.display = 'none';
            };
        });
    });
</script>