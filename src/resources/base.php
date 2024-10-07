<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kotolika</title>
    <link rel="stylesheet" href="<?= pubUrl("assets/global.css") ?>">
    <link rel="stylesheet" href="<?= pubUrl("assets/bootstrap/css/bootstrap.min.css") ?>">

    <style>
        <?= $style ?>
    </style>
</head>
<body>
<?= include_component("flash-message") ?>
<?= $content ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="<?= pubUrl("assets/global.js") ?>"></script>
<script src="<?= pubUrl("assets/fullcalendar/index.global.min.js") ?>"></script>
<script src="<?= pubUrl("assets/chartjs/chart.js") ?>"></script>
<script src="<?= pubUrl("assets/chartjs/chart.umd.js") ?>"></script>
<script src="<?= pubUrl("assets/chartjs/helpers.js") ?>"></script>
<script src="<?= pubUrl("assets/bootstrap/js/bootstrap.bundle.min.js" ) ?>"></script>

<script>
    <?= $script ?>
</script>

</body>
</html>