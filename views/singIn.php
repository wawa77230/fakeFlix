<?php
ob_start();
?>

    <div id="login-body">
        <h1>S'inscrire</h1>

        <form method="post" action="inscription/create">
            <input type="text" name="firstName" placeholder="Votre prénom" required />
            <input type="text" name="lastName" placeholder="Votre nom" required />
            <input type="email" name="email" placeholder="Votre adresse email" required />
            <input type="password" name="pwd" placeholder="Mot de passe" required />
            <input type="password" name="pwd-check" placeholder="Retapez votre mot de passe" required />
            <button type="submit">S'inscrire</button>
        </form>

        <p class="grey">Déjà sur Fakeflix ? <a href="connexion">Connectez-vous</a>.</p>
    </div>


<?php
$content =ob_get_clean();
$title = "Inscription";
$h1 = "Inscription";
require "templateView.php";