<?php
ob_start();
?>
    <div class="mt-5 mb-5 bg-light p-5 rounded table-responsive">
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
                            <input type="checkbox" <?= $user->getIsAdmin()? "checked": '' ?> class="custom-control-input" id="adminSwitch<?= $user->getId()?>" data-id="<?= $user->getId()?>" data-url="users/updateAdminStatus" data-status="<?=$user->getIsAdmin()?>" >
                            <label class="custom-control-label" for="adminSwitch<?= $user->getId()?>"></label>
                        </div>
                    </form>
                </td>
                <td>
                    <form>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" <?= $user->getIsBlocked()? "checked": '' ?> class="custom-control-input" id="statusSwitch<?= $user->getId()?>" data-id="<?= $user->getId()?>" data-url="users/updateIsBlockedStatus" data-status="<?=$user->getIsBlocked()?>">
                            <label class="custom-control-label" for="statusSwitch<?= $user->getId()?>"></label>
                        </div>
                    </form>
                </td>
                <td>
                    <?php if($user->getId() != 1):?>
                    <button type="submit" name="remove" class="btn btn-danger remove"  data-url="<?=URL?>ajax/users/d" data-id="<?= $user->getId()?>" data-name="<?= $user->getFirstName()?> <?= $user->getLastName()?>"><i class="far fa-trash-alt"></i>&nbsp;Supprimer</button>
                    <?php endif?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    </div>
<?php
$content =ob_get_clean();

$title = "Utilisateurs";
$h1 = "Utilisateurs";


$dataTableScript = "<script src='%spublic/js/dataTables.js'></script>";
$dataTableScript = sprintf($dataTableScript,URL);

$updateByAjaxScript = "<script src='%spublic/js/ajax/updateStatusByAjax.js'></script>";
$updateByAjaxScript = sprintf($updateByAjaxScript,URL);

$links = ["<link rel='stylesheet' href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'> "];


$scripts = ["<script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>",
    $dataTableScript, $updateByAjaxScript];


require "./views/templateView.php";