<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Actordetails</title>

</head>
   
<body>

    <h1>Actordetails</h1>

<?php
	$fid = filter_input(INPUT_GET, 'filmid', FILTER_VALIDATE_INT)
		or die('Missing/illegal actorid parameter');
?>
    
<?php
	require_once('dbconnection.php');
	$sql = 'SELECT film_actor.actor_id, film_actor.film_id, actor.first_name, actor.last_name
            FROM film_actor
            JOIN actor
            WHERE film_actor.actor_id = actor.actor_id
            AND film_actor.film_id =?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('i', $fid);
	$stmt->execute();
	$stmt->bind_result($aid, $fid, $afnam, $alnam);
	while($stmt->fetch()){
		
		echo 'Actor name: '.$afnam.'  '.$alnam.'<br>';
      
		
} ?>


</body>
</html>