<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cuisinier</title>
	<link rel="stylesheet" href="css/cuisinier.css">
</head>
<div class="boisson-container">
    <?php foreach ($tickets as $ticketId => $items): ?>
        <div class="boisson-carte">
            <div class="boisson-header">
                Table n°<?= htmlspecialchars($items['id_table']) ?>
            </div>

            <div class="boisson-contenu">
                <?php foreach ($items as $key => $plat): ?>
                    <?php if ($key === 'id_table') continue; ?>
                    <p>x1 <?= htmlspecialchars($plat['NOM_PLAT']) ?></p>
                <?php endforeach; ?>
            </div>

            <div class="boisson-footer">
                <form method="post" action="controllers/terminer_boisson.php">
                    <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticketId) ?>">
                    <button type="submit">Terminé</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>