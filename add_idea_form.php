<?php
require('database.php');
$query = 'SELECT *
          FROM difficulties
          ORDER BY difficultyID';
$statement = $db->prepare($query);
$statement->execute();
$difficulties = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Idea Generator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Add an Idea</h1></header>

    <main>
        <h1>Add Idea</h1>
        <form action="add_idea.php" method="post"
              id="add_idea_form">

            <label>Difficulty:</label>
            <select name="difficulty_id">
            <?php foreach ($difficulties as $difficulty) : ?>
                <option value="<?php echo $difficulty['difficultyID']; ?>">
                    <?php echo $difficulty['difficultyName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>Idea:</label> <br>
            <textarea rows="5" cols="60" name="actual_idea" ></textarea>
			<br>
            
			
			<label>Category:</label>
			<input type="text" name="category" />
			<br>
			
			
            <input type="submit" value="Add Idea"><br>
        </form>
        <p><a href="listView.php">View Idea List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Brain Blast, Inc.</p>
    </footer>
</body>
</html>