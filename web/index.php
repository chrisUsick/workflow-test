<?php
    require('includes\includes.php');

    $games = find_all_games();

    require('partials\header.php');
?>

<h2>Board Games</h2>
<ul>
    <?php foreach($games as $game): ?>
        <li><a href="show.php?id=<?= $game['id'] ?>"><?= $game['name'] ?></a></li>
    <?php endforeach ?>
</ul>

<?php require('partials\footer.php'); ?>