<?php
ob_start();
?>
<div class="mt-5 mb-5 bg-light p-5 rounded table-responsive">

     <a href="<?= URL?>films/c" class="btn btn-success mb-5">
            <i class="fas fa-plus"></i>&nbsp;Ajouter un film
        </a>

    <?php if (isset($_SESSION['alert'])):?>
        <div class="alert alert-<?=$_SESSION['alert']['type']?> text-center text-dark" role="alert">
            <?=$_SESSION['alert']['msg']?>
        </div>
    <?php endif;?>

    <table class="table table table-striped table-bordered text-center">
        <thead>
        <tr class="text-center">
            <th scope="col">Nom</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Note</th>
            <th scope="col">Description</th>
            <th scope="col">Année</th>
            <th scope="col">Image</th>
            <th scope="col">Lien vidéo</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($movies):?>
            <?php foreach ($movies as $movie):?>
            <tr>
                <th><a href="<?= URL ?>film/<?= $movie->getId()?>"><?= $movie->getName()?></a></th>
                <th><?= $categories->getCategoryNameById($movie->getCategoryId())?></th>
                <td><?= $movie->getRank()?></td>
                <td><?= substr($movie->getDescription(),0,20).'...'?></td>
                <td><?= $movie->getYear()?></td>
                <td class="img-list" ><img src="./public/img/movies/<?= $movie->getPicture()?>" alt="<?= $movie->getName()?>" class="thumbnail"></td>
                <td><?= $movie->getIframe()?></td>
                <td class="btn-group border-0 "  >
                    <a href="<?=URL?>films/u/<?= $movie->getId()?>" class="btn btn-primary">Modifier</a>
                    <form action="<?=URL?>films/d/<?= $movie->getId()?>" method="post">
                        <button type="submit" name="remove" class="btn btn-danger remove" data-url="<?=URL?>ajax/movies/d" data-id="<?= $movie->getId()?>" data-name="<?= $movie->getName()?>">Supprimer</button>
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
$title = "Films";
$h1 = "Films";

$dataTableScript = "<script src='%spublic/js/dataTables.js'></script>";
$dataTableScript = sprintf($dataTableScript,URL);



$scripts = ["<script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>",
            $dataTableScript,
            ];

$links = ["<link rel='stylesheet' href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'> "];

require "templateView.php";