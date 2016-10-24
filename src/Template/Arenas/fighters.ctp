<!-- File: src/Template/Arenas/fighter.ctp -->

<h1>Tous les fighters de la bd</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>XP</th>
    </tr>

    <!-- Ici se trouve l'itération sur l'objet query de nos $articles, l'affichage des infos des articles -->

    <?php foreach ($fighters as $fighter): ?>
    <tr>
        <td><?= $fighter->id ?></td>
        <td>
            <?= $this->Html->link($fighter->name, ['action' => 'viewFighter', $fighter->id]) ?>
        </td>
        <td>
            <?= $fighter->xp ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>