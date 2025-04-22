<!-- index.php -->
<!DOCTYPE html>
<html lang="fr">
<body>
<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'Accueil';

switch ($page) {
    case 'Accueil':
        require_once('controllers/Accueil.php');
        break;
    case 'barmanAccueil':
        require_once('controllers/barmanAccueil.php');
        break;
    case 'Cuisnier':
        require_once('controllers/.php');
        break;
    case 'boisson':
        require_once('controllers/barmanBoisson.php');
        break;
    case 'parametre':
        require_once('controllers/administration/admin_Carte.php');
        break;
    default:
        echo "<h1>Page non trouvée</h1>";
        break;
}
?>
</body>
</html>
