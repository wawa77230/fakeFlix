<?php
ob_start();
?>

    <div id="login-body">
        <h1>S'identifier</h1>

        <form method="post" action="<?= URL ?>authentification/login">

            <?php if (isset($_SESSION['alert'])):?>
                <div class="alert alert-<?=$_SESSION['alert']['type']?> text-center text-dark" role="alert">
                    <?=$_SESSION['alert']['msg']?>
                </div>
            <?php endif;?>
            <input type="email" name="email" placeholder="Votre adresse email" required />
            <input type="password" name="pwd" placeholder="Mot de passe" required />
            <button type="submit">S'identifier</button>
            <label id="option"><input type="checkbox" name="auto"  />&nbsp;&nbsp;Se souvenir de moi</label>
        </form>


        <p class="grey">Première visite sur Fakeflix ? <a href="<?= URL ?>inscription">Inscrivez-vous</a>.</p>
    </div>

<?php
$content =ob_get_clean();
$title = "Connexion";
$h1 = "Connexion";
require "templateView.php";