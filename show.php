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
    <?= $game['min_num_players'] ?>
    <?php if ($game['min_num_players'] != $game['max_num_players']): ?>
        - <?= $game['max_num_players'] ?>
    <?php endif ?>
</p>
<p>
    <strong>Play Time: </strong>
    <?= $game['min_play_minutes'] ?>
    <?php if ($game['min_play_minutes'] != $game['max_play_minutes']): ?>
        - <?= $game['max_play_minutes'] ?>
    <?php endif ?>
</p><p><?= $game['description'] ?></p>

<?php require('partials\footer.php'); ?>