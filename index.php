<?php include 'navBar.php'; 
require_once('database.php'); 

$randomIdeaQuery = 'SELECT * 
					FROM ideas
					ORDER BY RAND()
					LIMIT 1';
$randomIdeaQuery = $db->prepare($randomIdeaQuery);
$randomIdeaQuery->execute();
$randomIdeaReturned = $randomIdeaQuery->fetch();
$randomIdeaQuery->closeCursor();
					



?>
<!DOCTYPE html>
<html>
<head>
    <title>Idea Generator</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
	
</head>
<body>
	<main>
	
		<p><?php echo $randomIdeaReturned['idea']; ?></p>
	</main>    
<footer></footer>
</body>
</html>