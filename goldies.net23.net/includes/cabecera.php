<?php
include_once('funciones.php');
require_once('connect.php');
?>
<!-- filename: cabecera.php -->
<link href='http://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" />
<link rel="stylesheet" href="css/goldies.css" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type= "text/javascript" src="js/funciones.js"></script>
</head>

<body>

    <?php
    include_once("analyticstracking.php");
    if (!isset($_SESSION))
        session_start();
    if (isset($_SESSION['userid'])) {
        ?>
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img alt="Brand" src="favicon.ico"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="hq.php">Headquarters</a></li>
                        <li><a href="tech.php">Techs</a></li>
                        <li><a href="battlefield.php">Battlefield</a></li>
                        <li><a href="training.php">Training</a></li>
                        <li><a href="info.php">Game Info</a></li>
                        <li><a href="rankings.php">Rankings</a></li>
                        <li><a href="combatlog.php">Combat Log</a></li>
                        <li><a href="economy.php">Economy</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container"> <!-- Body Container-->


            <?php
        } else {
            ?>
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img alt="Brand" src="favicon.ico"></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="battlefield.php">Battlefield</a></li>
                            <li><a href="info.php">Game Info</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div> <!-- Cierro center -->
            </nav> <!-- Cierro cabecera -->
            <div class="container"> <!-- Body Container-->
                <?php
            }
            require_once('includes/login.php');
            ?>

