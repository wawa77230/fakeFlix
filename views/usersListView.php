<?php
ob_start();
?>
    <table class="table table-striped table-bordered bg-light text-center">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Email</th>
            <th scope="col">Date de création</th>
            <th scope="col">Administrateur</th>
            <th scope="col">Suspendu</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user):?>
            <tr>
                <td><?= $user->getLastName()?></td>
                <td><?= $user->getFirstName()?></td>
                <td><?= $user->getEmail()?></td>
                <td><?= $user->getCreateAt()?></td>
                <td>
                    <form>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" <?= $user->getIsAdmin()? "checked": '' ?> class="custom-control-input" id="adminSwitch<?= $user->getId()?>">
                            <label class="custom-control-label" for="adminSwitch<?= $user->getId()?>"></label>
                        </div>
                    </form>
                </td>
                <td>
                    <form>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" <?= $user->getIsBlocked()? "checked": '' ?> class="custom-control-input" id="statusSwitch<?= $user->getId()?>">
                            <label class="custom-control-label" for="statusSwitch<?= $user->getId()?>"></label>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="<?=URL?>utilisateurs/d/<?= $user->getId()?>" method="post">
                        <button type="submit" name="remove" class="btn btn-danger col-6"><i class="far fa-trash-alt"></i> Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

<?php
$content =ob_get_clean();

$title = "Utilisateurs";
$h1 = "Utilisateurs";


$dataTableScript = "<script src='%spublic/js/dataTables.js'></script>";
$dataTableScript = sprintf($dataTableScript,URL);



$links = ["<link rel='stylesheet' href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'> "];


$scripts = ["<script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>",
    $dataTableScript,
];


require "templateView.php";