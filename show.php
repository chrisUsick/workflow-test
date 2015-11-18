<?php
    require('includes\includes.php');
    
    $id = safe_get_id();
    
    $game = find_game_by_id($id);

    require('partials\header.php');
?>

<h1>Bored Game Geek</h1>

<h2><?= $game['name'] ?></h2>
<p>
    <strong>Number of Players: </strong>
</p>
<p><?= $game['description'] ?></p>

<?php require('partials\footer.php'); ?>