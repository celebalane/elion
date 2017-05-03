<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= App::getInstance()->titre; ?></title>
    <!--Style-->
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,700|Martel:700,900" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../web/css/style.css">

  </head>
<body>
<nav class="navbar">
      <div class="container">
        <div id="navbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php?p=presentation">Savoir faire</a></li>
            <li><a href="index.php?p=vehicule">Projet</a></li>
            <li><a href="index.php?p=contact">Contact</a></li>
            <li><a href="index.php?p=login">Espace presse</a></li>
          </ul>
        </div>
      </div>
    </nav>
  <?= $content; ?>
</body>

</html>
