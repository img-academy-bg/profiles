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
                <?php if (isset($errorMessage)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errorMessage; ?>
                </div>
                <?php endif; ?>
                <?php if (isset($successMessage)): ?>
                <div class="alert alert-success" role="alert">
                    <?= $successMessage; ?>
                </div>
                <?php endif; ?>
                <?php if (isset($warningMessage)): ?>
                <div class="alert alert-warning" role="alert">
                    <?= $warningMessage; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <?= $content; ?>
            </div>
        </div>
    </body>
</html>