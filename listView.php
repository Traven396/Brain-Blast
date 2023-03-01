<?php
require_once('database.php');
include 'navBar.php';
// Get category ID
if (!isset($difficulty_id)) {
    $difficulty_id = filter_input(INPUT_GET, 'difficulty_id', 
            FILTER_VALIDATE_INT);
    if ($difficulty_id == NULL || $difficulty_id == FALSE) {
        $difficulty_id = 1;
    }
}

// Get name for selected difficulty
$queryDifficulty = 'SELECT * FROM difficulties
                      WHERE difficultyID = :difficulty_id';
$statement1 = $db->prepare($queryDifficulty);
$statement1->bindValue(':difficulty_id', $difficulty_id);
$statement1->execute();
$difficulty = $statement1->fetch();
$difficulty_name = $difficulty['difficultyName'];
$statement1->closeCursor();

// Get all difficulties
$queryAllDifficulties = 'SELECT * FROM difficulties
                           ORDER BY difficultyID';
$statement2 = $db->prepare($queryAllDifficulties);
$statement2->execute();
$difficulties = $statement2->fetchAll();
$statement2->closeCursor();

// Get ideas for selected difficulty
$queryIdeas = 'SELECT * FROM ideas
              WHERE difficultyID = :difficulty_id
              ORDER BY ideaId';
$statement3 = $db->prepare($queryIdeas);
$statement3->bindValue(':difficulty_id', $difficulty_id);
$statement3->execute();
$ideas = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>Idea Generator</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<main>
    <h1>Idea List</h1>
    <aside>
        <!-- display a list of difficulties -->
        <h2>Difficulties</h2>
        <nav>
        <ul>
            <?php foreach ($difficulties as $difficulty) : ?>
            <li>
                <a href="listView.php?difficulty_id=<?php echo $difficulty['difficultyID']; ?>">
                    <?php echo $difficulty['difficultyName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>           
    </aside>

    <section>
        <!-- display a table of ideas -->
        <h2><?php echo $difficulty_name; ?></h2>
        <table>
            <tr>
                <th>Category</th>
                <th>Idea</th>
                <th class="right">Date Added</th>
            </tr>

            <?php foreach ($ideas as $idea) : ?>
            <tr>
                <td><?php echo $idea['category']; ?></td>
                <td><?php echo $idea['idea']; ?></td>
                <td class="right"><?php echo $idea['dateAdded']; ?></td>
            </tr>
            <?php endforeach; ?>            
        </table>
    </section>
</main>    
<footer></footer>
</body>
</html>