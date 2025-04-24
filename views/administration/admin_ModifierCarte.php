<!DOCTYPE html>
<html>
<head>
    <title><?= $modeAjout ? 'Ajouter' : 'Modifier' ?> un plat</title>
</head>
<body>
<h1><?= $modeAjout ? 'Ajouter' : 'Modifier' ?> un plat</h1>

<form id="updateForm">
    <input type="hidden" name="ID_PLAT" value="<?= htmlspecialchars($plat['ID_PLAT']) ?>">

    <label>Nom du plat</label>
    <input type="text" name="NOM_PLAT" value="<?= htmlspecialchars($plat['NOM_PLAT']) ?>">

    <label>Prix</label>
    <input type="number" step="0.01" name="PRIX" value="<?= htmlspecialchars($plat['PRIX']) ?>">

    <label>Type</label>
    <input type="text" name="TYPE_PLAT" value="<?= htmlspecialchars($plat['TYPE_PLAT']) ?>">

	<label>
		<input type="checkbox" name="CONTIENT_SAUCE" value="1" <?= !empty($plat['CONTIENT_SAUCE']) ? 'checked' : '' ?>>
		Contient une sauce
	</label>

	<label>
		<input type="checkbox" name="CONTIENT_CUISSON" value="1" <?= !empty($plat['CONTIENT_CUISSON']) ? 'checked' : '' ?>>
		Nécessite une cuisson
	</label>

    <button type="submit"><?= $modeAjout ? 'Ajouter' : 'Enregistrer' ?></button>
</form>

<script>
    document.getElementById('updateForm').addEventListener('submit', async function(e) {
        const form = e.target;
        const formData = new FormData(form);

        if (!formData.has('CONTIENT_SAUCE')) {
            formData.append('CONTIENT_SAUCE', 0);
        }
        if (!formData.has('CONTIENT_CUISSON')) {
            formData.append('CONTIENT_CUISSON', 0);
        }

        const response = await fetch('http://localhost/Projet_S4/api/update_plat.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            alert('Plat mis à jour !');
            const typePlat = formData.get('TYPE_PLAT') || 'Plat';
            window.location.href = '?page=parametre&type=' + encodeURIComponent(typePlat);
        } else {
            alert('Erreur : ' + result.message);
        }
    });
</script>


</body>
</html>