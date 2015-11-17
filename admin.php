<?php
    require('includes\includes.php');
    
    $games = find_all_games();

    require('partials\header.php');
?>

<h1>Bored Game Geek Admin</h1>

<p><a href="new_game.php">Add New Game</a></p>

<h2>Edit Existing Games</h2>

<?php if (count($games) == 0): ?>
    <p>No games present in system.</p>
<?php else: ?>
    <ul>
        <?php foreach($games as $game): ?>
            <li><a href="new_game.php?id=<?= $game['id'] ?>"><?= $game['name'] ?></a></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>

<?php require('partials\footer.php'); ?>