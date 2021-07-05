<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
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
        <nav>
        <div id="brand"><a href="<?= URL?>accueil"><img src="<?= URL ?>/public/img/logos/logo.png" alt="Fakeflix"></a></div>
        <?php if (!empty($_SESSION['user'])):?>
            <div class="left-menu">
                <p>Browse&nbsp;<i class="fa fa-caret-down"></i></p>
                <?php if ($_SESSION['user']['isAdmin']):?>
                    <a href="<?= URL?>films">Ajouter un film&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php endif;?>
                <p>DVD</p>
            </div>

            <div class="right-menu">

                <?php if ($_GET['page'] != "recherche"):?>
                    <form action="recherche" method="get">
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-light" id="submit" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                            <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']): ''?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" required>
                    </div>
                </form>
                <?php endif;?>

                <div class="user">
                    <img class="user-img" src="<?= URL ?>/public/img/site/avatar.png"/>
                    <h4><?= $_SESSION['user']['firstName']?></h4>
                    <a href="<?= URL?>authentification/logout" class="logout" onclick="return confirm('Êtes vous sûrs de vouloir vous déconnecter ?');"><i class="fas fa-unlink"></i></a>
                </div>
            </div>
        <?php endif;?>
        </nav>
    </header>

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