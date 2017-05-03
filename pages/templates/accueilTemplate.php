<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?= App::getInstance()->titre; ?></title>
    <!--Style-->
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,700|Martel:700,900" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../web/css/style.css">

  </head>
<body>
  <?= $content; ?>
</body>

</html>