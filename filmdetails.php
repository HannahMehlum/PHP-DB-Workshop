<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>filmdetails</title>

</head>
<body>
    
    <h1>Filmdetails</h1>
    <?php
    
 $fid = filter_input(INPUT_GET, 'filmid', FILTER_VALIDATE_INT)
		or die('Missing/illegal filmid parameter');
		
		require_once('dbconnection.php');
		$sql = 'SELECT title, description, release_year
                FROM film
                WHERE film_id=?';
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $fid);
		$stmt->execute();
        $stmt->bind_result($ftitle, $fdesc, $frl);
	    while($stmt->fetch()){ 
    
       echo 'Title "'.$ftitle.'<br>';
       echo 'Description "'.$fdesc.'<br>';
       echo 'Realese year "'.$frl.'<br>';
        
            
    ?>
		
<?php } ?>
    
  <a href="actordetails.php?filmid=<?=$fid?>">See actor details</a>
    
    <hr
        <?php
        
        require_once('dbconnection.php');
		$sql = 'SELECT film_category.category_id, category.name
                FROM film_category
                JOIN category
                WHERE film_category.category_id=?';
		$stmt = $link->prepare($sql);
		$stmt->bind_param('s', $fid);
		$stmt->execute();
        $stmt->bind_result($fcat);
	    while($stmt->fetch()){ 
    
       echo 'cathegory "'.$fcat.'<br>';
        
        } ?>
		

</body>
</html>