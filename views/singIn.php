<?php
ob_start();
?>

    <div id="login-body">
        <h1>S'inscrire</h1>

        <form method="post" action="<?= URL?>inscription/creation" data-validate>

            <?php if (isset($_SESSION['alert'])):?>
                <div class="alert alert-<?=$_SESSION['alert']['type']?> text-center text-dark" role="alert">
                    <?=$_SESSION['alert']['msg']?>
                </div>
            <?php endif;?>

            <input type="text" name="firstName" placeholder="Votre prénom" required data-minlength="2"/>
            <input type="text" name="lastName" placeholder="Votre nom" required data-minlength="2" />
            <input type="email" name="email" placeholder="Votre adresse email" required data-minlength="5"/>
            <input type="password" name="pwd" placeholder="Mot de passe" required data-minlength="8" />
            <input type="password" name="pwd-check" placeholder="Retapez votre mot de passe" required  data-minlength="8"/>
            <button type="submit">S'inscrire</button>
        </form>

        <p class="grey">Déjà sur Fakeflix ? <a href="<?= URL ?>connexion">Connectez-vous</a>.</p>
    </div>


<?php
$content =ob_get_clean();
$title = "Inscription";
$h1 = "Inscription";

$formValidator = "<script src='%spublic/js/form/FormValidator.class.js'></script>" ;
$formValidator = sprintf($formValidator,URL);

$scripts = [ $formValidator];
require "templateView.php";