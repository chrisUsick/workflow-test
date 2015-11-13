<?php
    require('includes\includes.php');
    
    $games = find_all_games();

    require('partials\header.php');
?>

<h1>Bored Game Geek</h1>

<?php foreach($games as $game): ?>
    <h2><?= $game['name'] ?></h2>
    <p><?= $game['description'] ?></p>
<?php endforeach ?>

<?php require('partials\footer.php'); ?>