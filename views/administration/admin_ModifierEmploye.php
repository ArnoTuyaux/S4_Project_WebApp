<!DOCTYPE html>
<html>
<head>
    <title>Modifier un employé</title>
    <link rel="stylesheet" href="css/admin_ModifierCarte.css">
</head>
<body>

<form id="updateEmployeForm">
    <input type="hidden" name="ID_SERVEUR" value="<?= htmlspecialchars($id) ?>">

    <div class="element">
        <label>Nom complet</label>
        <input type="text" name="NOM_COMPLET" value="<?= htmlspecialchars($nomComplet) ?>">
    </div>

    <div class="element">
        <label>Secteurs attribués :</label>
        <?php foreach ($listeSecteurs as $idSecteur => $nomSecteur): ?>
            <div>
                <input type="checkbox"
                       name="SECTEURS[]"
                       value="<?= $idSecteur ?>"
                    <?= in_array($idSecteur, $secteursAttribues) ? 'checked' : '' ?>>
                <?= htmlspecialchars($nomSecteur) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="submit">Enregistrer</button>
</form>

<script>
    document.getElementById('updateEmployeForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        const response = await fetch('http://localhost/Projet_S4/api/update_employe.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            alert('Employé mis à jour !');
            window.location.href = '?page=listeEmployes';
        } else {
            alert('Erreur : ' + result.message);
        }
    });
</script>
</body>
</html>