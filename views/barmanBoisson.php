<link rel="stylesheet" href="css/nav.css?v=1">
<link rel="stylesheet" href="css/boissons.css">

<h1>PAGE BOISSON</h1>

<div class="boisson-container">
    <?php foreach ($boisson as $ticketId => $items): ?>
        <div class="boisson-carte">
            <div class="boisson-header">
                T°<?= htmlspecialchars($ticketId) ?>
            </div>

            <div class="boisson-contenu">
                <?php foreach ($items as $plat): ?>
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
