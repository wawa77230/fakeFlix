<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <link rel="stylesheet" href="<?= URL ?>public/css/style.css">

    <link rel="icon" type="image/pngn" href="<?= URL ?>/public/img/logos/favicon.png">

    <?php if (isset($links) && !empty($links)):?>
        <?php foreach ($links as $link): ?>
            <?= $link?>
        <?php endforeach;?>
    <?php endif;?>
    <script src="https://kit.fontawesome.com/1901af9c76.js" crossorigin="anonymous"></script>

    <title><?= $title?></title>
</head>
<body>
    <header>
<!--                add class navbar-transparent-->
                <nav class="navbar navbar-expand-lg ">
                    <a class="navbar-brand" href="<?= URL ?>accueil">
                       <img src="<?= URL ?>/public/img/logos/logo.png"  width="100" height="30" alt="Fakeflix">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">


                        <ul class="navbar-nav mr-auto">
        <!--                    <li class="nav-item active">-->
        <!--                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
        <!--                    </li>-->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Films
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Ajouter</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Liste des films</a>
                                </div>
                            </li>

        <!--                    <li class="nav-item">-->
        <!--                        <a class="nav-link" href="#">Link</a>-->
        <!--                    </li>-->
        <!--                    <li class="nav-item dropdown">-->
        <!--                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
        <!--                            Dropdown-->
        <!--                        </a>-->
        <!--                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
        <!--                            <a class="dropdown-item" href="#">Action</a>-->
        <!--                            <a class="dropdown-item" href="#">Another action</a>-->
        <!--                            <div class="dropdown-divider"></div>-->
        <!--                            <a class="dropdown-item" href="#">Something else here</a>-->
        <!--                        </div>-->
        <!--                    </li>-->
        <!--                    <li class="nav-item">-->
        <!--                        <a class="nav-link disabled" href="#">Disabled</a>-->
        <!--                    </li>-->
                        </ul>

                        <div class="row col-5 row justify-content-around align-items-center">
                            <form class="form-inline my-2 my-lg-0  align-items-center" action="recherche" method="get">
                                <input type="text" id="search" placeholder="&#61447; Rechercher">
                            </form>
                            <div class="row align-items-center">
                                <img class="user-img" src="<?= URL ?>/public/img/site/avatar.png"  width="50" height="50"/>
                                    <p id="userName" class="align-items-center"><?= $_SESSION['user']['firstName']?></p>
                                    &nbsp;
                                    <a href="<?= URL?>authentification/logout" class="logout" onclick="return confirm('Êtes vous sûrs de vouloir vous déconnecter ?');"><i class="fas fa-unlink"></i></a>
                            </div>
                        </div>

                    </div>

                </nav>


    <main>
        <h1 class="text-center"><?= $h1?></h1>

        <section>
            <?=$content?>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>Des questions ? Appelez le 0800 917 813</p>
            <a href="#">Conditions des cartes cadeaux</a>
            <a href="#">Conditions d'utilisation</a>
            <a href="#">Déclaration de confidentialité</a>
        </div>
    </footer>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->


    <?php if (isset($scripts) && !empty($scripts)):?>
        <?php foreach ($scripts as $script): ?>
            <?= $script?>
        <?php endforeach;?>
    <?php endif;?>
</body>
</html>