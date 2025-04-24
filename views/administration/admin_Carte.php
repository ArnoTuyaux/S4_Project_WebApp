<body>
<nav class="navbar">
    <a href="?page=barmanAccueil"><button class="back-btn">←</button></a>
    <div class="nav-buttons">
        <a href="?page=parametre&type=Entree"><button class="<?= ($_GET['type'] ?? 'Plats') === 'Entree' ? 'active' : '' ?>">ENTRÉES</button></a>
        <a href="?page=parametre&type=Plat"><button class="<?= ($_GET['type'] ?? 'Plats') === 'Plat' ? 'active' : '' ?>">PLATS</button></a>
        <a href="?page=parametre&type=Dessert"><button class="<?= ($_GET['type'] ?? 'Plats') === 'Dessert' ? 'active' : '' ?>">DESSERTS</button></a>
        <a href="?page=parametre&type=Boisson"><button class="<?= ($_GET['type'] ?? 'Plats') === 'Boisson' ? 'active' : '' ?>">BOISSONS</button></a>
        <a href="?page=parametre&type=Employes"><button class="<?= ($_GET['type'] ?? 'Plats') === 'Employes' ? 'active' : '' ?>">EMPLOYÉS</button></a>
    </div>
</nav>
<?php foreach ($items as $item): ?>
    <div class="dish-item">
        <?php if (($type ?? '') === 'Employes'): ?>
            <span><?= htmlspecialchars($item['NOM_COMPLET']) ?></span>
            <a href="?page=modifier_employe&id=<?= $item['ID_SERVEUR'] ?>"><button class="edit">Modifier</button></a>
            <button class="delete" data-id="<?= $item['ID_SERVEUR'] ?>" data-type="employe">Supprimer</button>
        <?php else: ?>
            <span>
                <?= htmlspecialchars($item['NOM_PLAT']) ?>
                - <?= number_format($item['PRIX'], 2, ',', ' ') ?> €
            </span>
            <a href="?page=modifier_carte&id=<?= $item['ID_PLAT'] ?>"><button class="edit">Modifier</button></a>
            <button class="delete" data-id="<?= $item['ID_PLAT'] ?>" data-type="plat">Supprimer</button>
        <?php endif; ?>
    </div>
<?php endforeach; ?>


<a href="?page=modifier_carte">
<button class="add">Ajouter</button>
</a>

<style>
    .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center; }
    .modal-content { background: white; padding: 20px; text-align: center; }
    button { margin: 10px; }
</style>

<div id="confirmModal" class="modal">
    <div class="modal-content">
        <h2>Êtes-vous sûr de vouloir supprimer cet élément ?</h2>
        <button id="confirmYes">Oui</button>
        <button id="confirmNo">Non</button>
    </div>
</div>

<script>
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', (e) => {
            const itemId = e.target.dataset.id;
            const type = e.target.dataset.type; // 'plat' ou 'employe'
            document.getElementById('confirmModal').style.display = 'flex';

            document.getElementById('confirmYes').onclick = async function() {
                const url = type === 'plat'
                    ? `http://localhost/Projet_S4/api/delete_plat.php?id=${itemId}`
                    : `http://localhost/Projet_S4/api/delete_employe.php?id=${itemId}`;

                const response = await fetch(url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                });

                const result = await response.json();
                if (result.success) {
                    alert(`${type === 'plat' ? 'Plat' : 'Employé'} supprimé avec succès !`);
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
