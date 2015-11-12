<?php
    require('includes\includes.php');
    
    $sql        = "SELECT * FROM games";
    $pdo_result = Database::prepare_and_execute($sql);
    $games      = $pdo_result->fetchAll();
    
?>
<?php require('partials\header.php'); ?>

<h1>Bored Game Geek</h1>

<?php foreach($games as $game): ?>
    <h2><?= $game['name'] ?></h2>
    <p><?= $game['description'] ?></p>
<?php endforeach ?>

<?php require('partials\footer.php'); ?>