<?php
/**
 * Header file.
 */
use PhpOffice\PhpSpreadsheet\Helper\Sample;

error_reporting(E_ALL);

require_once __DIR__ . '/../src/Bootstrap.php';

$helper = new Sample();

// Return to the caller script when runs by CLI
if ($helper->isCli()) {
    return;
}
?>
<html>
<head>
    <title><?php echo $helper->getPageTitle(); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/bootstrap/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/bootstrap/css/phpspreadsheet.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
    </script>
</head>
<body>
    <div class="container">
        <div class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">PHPSpreadsheet</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav"><?php
                    foreach ($helper->getSamples() as $category => $files) {
                        ?><li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category ?><strong class="caret"></strong></a>
                            <ul class="dropdown-menu"><?php
                            foreach ($files as $name => $file) {
                                echo '<li><a href="/' . $file . '">' . $name . '</a></li>';
                            } ?></ul>
                        </li>
                    <?php
                    } ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="https://github.com/PHPOffice/PHPSpreadsheet"><i class="fa fa-github fa-lg" title="GitHub"></i>&nbsp;</a></li>
                        <li><a href="https://phpspreadsheet.readthedocs.io"><i class="fa fa-book fa-lg" title="Docs"></i>&nbsp;</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        echo $helper->getPageHeading();
