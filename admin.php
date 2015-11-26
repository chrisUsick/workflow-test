<?php
    require('includes\includes.php');
    
    $games = find_all_games();

    require('partials\header.php');
?>

<h2>Edit Existing Games</h2>

<?php if (count($games) == 0): ?>
    <p>No games present in system.</p>
<?php else: ?>
    <ul>
        <?php foreach($games as $game): ?>
            <li>
                <a href="create_or_update_game.php?id=<?= $game['id'] ?>"><?= $game['name'] ?></a>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

<h2>Add New Games or Categories</h2>

<p>
    <a href="create_or_update_game.php" class="btn btn-primary">Add Game</a>
    <a href="create_or_update_category.php" class="btn btn-primary">Add Category</a>
</p>

<?php require('partials\footer.php'); ?>