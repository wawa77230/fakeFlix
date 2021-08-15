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
        <nav class="navbar  navbar-expand-lg ">

                    <a class="navbar-brand" href="<?= !empty($_SESSION['user'])? URL.'accueil' : URL.'connexion' ?>">
                       <img src="<?= URL ?>/public/img/logos/logo.png"  width="100" height="30" alt="Fakeflix">
                    </a>
                    <?php if (!empty($_SESSION['user'])):?>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon ">
                            <i class="fas fa-bars "></i>
                        </span>
                    </button>

                    <div class="collapse navbar-collapse <?=!$_SESSION['user']['isAdmin']? 'justify-content-end':''?>" id="navbarSupportedContent">

                        <?php if ($_SESSION['user']['isAdmin']):?>
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Films
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?= URL?>films/c">Ajouter</a>
                                        <a class="dropdown-item" href="<?= URL?>films">Liste des films</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Utilisateur
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?= URL?>utilisateurs">Liste des utilisateurs</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Catégories
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?= URL?>categories/c">Ajouter</a>
                                    <a class="dropdown-item" href="<?= URL?>categories">Liste des catégories</a>
                                </div>
                            </li>
                        </ul>
                        <?php endif;?>


                        <div class="row col-xl-6 col-lg-7 col-12  justify-content-between align-items-center" id="user-portal">

                            <?php if (empty($_GET['page']) || $_GET['page'] != "recherche" ):?>
                            <form action="<?= URL?>recherche" method="get" class="col-12 col-sm-7">
                                <div class="input-group " id="search-container">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-light" id="submit" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                    <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? $_GET['search']: ''?>" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" required>
                                </div>
                            </form>
                            <?php endif;?>
                            <div class="row align-items-center" id="user">
                                <img class="user-img" src="<?= URL ?>public/img/site/avatar.png"  width="50" height="50" alt="avatar"/>
                                    <p id="user-name" class="align-items-center"><?= $_SESSION['user']['firstName']?></p>
                                    &nbsp;
                                    <a href="<?= URL?>auth/logout" id="logout"><i class="fas fa-unlink"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endif?>
                </nav>
    </header>
    <main>
        <?php if (isset($_GET['page']) && $_GET['page'] != 'accueil'):?>

        <h1 class="text-center mb-5 mt-5"><?= $h1?></h1>
        <?php endif;?>

        <section>
            <?=$content?>
        </section>
    </main>
    <footer>
        <div class="container">
            <p class="text-center">Des questions ? Appelez le 0800 917 813</p>
            <div id="us">
                <a href="#">Conditions des cartes cadeaux</a>
                <a href="#">Conditions d'utilisation</a>
                <a href="#">Déclaration de confidentialité</a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!--Script SweetAlert 2    -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset($scripts) && !empty($scripts)):?>
        <?php foreach ($scripts as $script): ?>
            <?= $script?>
        <?php endforeach;?>
    <?php endif;?>

    <?php if (!empty($_SESSION['user'])):?>
        <script src="<?= URL?>public/js/index.js"></script>
    <?php endif;?>
</body>
</html>