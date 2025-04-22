<!DOCTYPE html>
<html>
<head>
    <title>Modifier un plat</title>
</head>
<body>
<h1>Modifier le plat</h1>

<form id="updateForm">
    <input type="hidden" name="ID_PLAT" value="<?= htmlspecialchars($plat['ID_PLAT']) ?>">

    <label>Nom du plat</label>
    <input type="text" name="NOM_PLAT" value="<?= htmlspecialchars($plat['NOM_PLAT']) ?>">

    <label>Prix</label>
    <input type="number" step="0.01" name="PRIX" value="<?= htmlspecialchars($plat['PRIX']) ?>">

    <label>Type</label>
    <input type="text" name="TYPE_PLAT" value="<?= htmlspecialchars($plat['TYPE_PLAT']) ?>">

    <button type="submit"><?= $modeAjout ? 'Ajouter' : 'Enregistrer' ?></button>
</form>

<script>
    const isAjout = <?= $modeAjout ? 'true' : 'false' ?>;

    document.getElementById('updateForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);

        const endpoint = isAjout ? '../../api/create_plat.php' : '../../api/update_plat.php';

        const response = await fetch(endpoint, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        alert(result.message); // ou modale/bulle si tu veux styliser
    });
</script>

</body>
</html>