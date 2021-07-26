<?php
ob_start();
?>
    <div class="mt-5 mb-5">

        <a href="<?= URL?>categories/c" class="btn btn-success mb-5">
            <i class="fas fa-plus"></i>&nbsp;Ajouter une catégorie
        </a>

        <table class="table table-striped table-bordered bg-light" >
            <thead>
            <tr class="text-center">
                <th scope="col">Nom</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($categories):?>
                <?php foreach ($categories as $category):?>
                    <tr class="text-center">
                        <th><a href="<?= URL ?>categories/<?= $category->getId()?>"><?= $category->getName()?></a></th>
                        <td class="btn-group">
                            <a href="<?=URL?>categories/u/<?= $category->getId()?>" class="btn btn-primary">Modifier</a>
                            <form action="<?=URL?>categories/d/<?= $category->getId()?>" method="post">
                                <button type="submit" name="remove" class="btn btn-danger">Supprimer</button>
                            </form>
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

require "templateView.php";