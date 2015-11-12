<?php
    require('includes\includes.php');
    require('partials\header.php');
    
    $sql   = "SELECT * from games";
    $games = Database::prepare_and_execute($sql, []);
    
?>

<h1>This is the Temp Index</h1>
<ul>
    <?php while ($row = $games->fetch()): ?>
        <li><?= $row['name'] ?></li>
    <?php endwhile ?>
</ul>
<?php
    require('partials\footer.php');
?>