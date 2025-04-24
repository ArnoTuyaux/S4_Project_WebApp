<!DOCTYPE html>
<h2>Modifier un serveur</h2>

<form id="formModifierServeur">
    <input type="hidden" name="ID_SERVEUR" value="<?= htmlspecialchars($serveur['ID_SERVEUR']) ?>">

    <label>Nom (prénom)</label>
    <input type="text" name="PRENOM" value="<?= htmlspecialchars($serveur['PRENOM']) ?>" required>

    <label>Secteur attribué</label>
    <input type="text" name="SECTEUR" value="<?= htmlspecialchars($serveur['SECTEUR'] ?? '') ?>">

    <button type="submit">Enregistrer</button>
</form>

<script>
    document.getElementById('formModifierServeur').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        const response = await fetch('http://localhost/Projet_S4/api/update_serveur.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            alert('Serveur modifié avec succès');
            window.location.href = '?page=admin_employes';
        } else {
            alert('Erreur : ' + result.message);
        }
    });
</script>
