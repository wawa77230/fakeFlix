<?php
ob_start();
?>
    <div class="mt-5 mb-5 bg-light p-5 rounded table-responsive">

        <a href="<?= URL?>categories/c" class="btn btn-success mb-5">
            <i class="fas fa-plus"></i>&nbsp;Ajouter une catégorie
        </a>

        <?php if (isset($_SESSION['alert'])):?>
            <div class="alert alert-<?=$_SESSION['alert']['type']?> text-center text-dark" role="alert">
                <?=$_SESSION['alert']['msg']?>
            </div>
        <?php endif;?>

        <table class="table table-striped table-bordered bg-light text-center" >
            <thead>
            <tr >
                <th scope="col">Nom</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($categories):?>
                <?php foreach ($categories as $category):?>
                    <tr >
                        <th><a href="<?=URL?>categorie/<?= $category->getId()?>"><?= $category->getName()?></a></th>
                        <td class="btn-group border-0">
                            <a href="<?=URL?>categories/u/<?= $category->getId()?>" class="btn btn-primary">Modifier</a>
                            <button type="submit" name="remove" class="btn btn-danger remove" data-url="<?=URL?>ajax/categories/d" data-id="<?= $category->getId()?>" data-name="<?= $category->getName()?>"><i class="far fa-trash-alt"></i>&nbsp;Supprimer</button>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php else:?>
                <tr>
                    <td class="text-center" colspan="8">Aucun film</td>
                </tr>
            <?php endif;?>
            </tbody>
        </table>
    </div>


<?php
$content =ob_get_clean();
$title = "Catégories";
$h1 = "Catégories";

$dataTableScript = "<script src='%spublic/js/dataTables.js'></script>";
$dataTableScript = sprintf($dataTableScript,URL);





$scripts = ["<script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>",
    $dataTableScript,
];

$links = ["<link rel='stylesheet' href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'> "];

require "./views/templateView.php";