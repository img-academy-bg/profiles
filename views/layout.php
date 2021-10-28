<?php
// views/layout.php
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title><?= $pageTitle; ?></title>
    </head>
    <body>
        <div class="container">
            <h1><?= $pageHeader; ?></h1>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    Error message
                </div>
                <div class="alert alert-success" role="alert">
                    Success message
                </div>
                <div class="alert alert-warning" role="alert">
                    Warning message
                </div>
            </div>
            <div class="row">
                <?= $content; ?>
            </div>
        </div>
    </body>
</html>