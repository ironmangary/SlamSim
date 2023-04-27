<?php

// Get list of wrestler files in the wrestlers directory
$wrestlerFiles = scandir('wrestlers/');

// Filter out non-PHP files
$wrestlerFiles = array_filter($wrestlerFiles, function($file) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'php';
});

// Generate the wrestler options for the dropdown box
$wrestlerOptions = '';
foreach ($wrestlerFiles as $wrestlerFile) {
    $wrestlerName = pathinfo($wrestlerFile, PATHINFO_FILENAME);
    $wrestlerOptions .= '<option value="' . $wrestlerFile . '">' . $wrestlerName . '</option>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wrestling Game</title>
</head>
<body>
    <h1>Wrestling Game</h1>
    <form action="play_game.php" method="post">
        <label for="wrestler1">Wrestler 1:</label>
        <select id="wrestler1" name="wrestler1">
            <?php echo $wrestlerOptions; ?>
        </select>
        <br>
        <label for="wrestler2">Wrestler 2:</label>
        <select id="wrestler2" name="wrestler2">
            <?php echo $wrestlerOptions; ?>
        </select>
        <br>
        <label for="wrestler3">Wrestler 3:</label>
        <select id="wrestler3" name="wrestler3">
            <option value="none">None</option>
            <?php echo $wrestlerOptions; ?>
        </select>
        <br>
        <label for="wrestler4">Wrestler 4:</label>
        <select id="wrestler4" name="wrestler4">
            <option value="none">None</option>
            <?php echo $wrestlerOptions; ?>
        </select>
        <br>
        <input type="submit" value="Run Match">
    </form>
</body>
</html>
