<?php
//var_dump($user->isAuthenticated());
ob_start();
?>
<div class="mt-5 mb-5">
    <table >
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
            <tr class="text-center">
                <th><a href="film/<?= $movie->getId()?>"><?= $movie->getName()?></a></th>
                <th><?= $category->getCategoryForMovie($movie->getCategoryId())?></th>
                <td><?= $movie->getRank()?></td>
                <td><?= substr($movie->getDescription(),0,20).'...'?></td>
                <td><?= $movie->getYear()?></td>
                <td class="img-list" ><img src="<?= $movie->getPicture()?>" alt="<?= $movie->getName()?>"></td>
                <td><?= $movie->getIframe()?></td>
                <td class="btn-group">
                    <a href="" class="btn btn-primary">Modifier</a>
                    <a href="" class="btn btn-danger">Supprimer</a>
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
$scripts = ["<script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>",
            "<script src='public/js/dataTables.js'></script>"   ];
$links = ["<link rel='stylesheet' href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'> "];

require "templateView.php";