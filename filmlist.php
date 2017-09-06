<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
    
<?php
if($fmd = filter_input(INPUT_POST, 'fmd')){
    
    if($fmd == 'delete_film'){
		
		
		$fid = filter_input(INPUT_POST, 'filmid', FILTER_VALIDATE_INT)
			or die('Missing/illegal filmid parameter');
		
			
		require_once('dbconnection.php');
		$sql = 'DELETE FROM film WHERE film_id=?';
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $fid);
		$stmt->execute();
        
		
		if($stmt->affected_rows > 0){
			echo 'Film "'.$fid.'" is deleted';
		}
		else{
			echo 'Could not delete film '.$fid;
		}			
		
	}
	else {
		die('Unknown fmd parameter');
	}
}
    
    ?>


<?php
    
	$cid = filter_input(INPUT_GET, 'categoryid', FILTER_VALIDATE_INT)
		or die('Missing/illegal filmid parameter');
?>

	<h1>Category <?=$cid?></h1>
	
	<ul>
        
<?php
    
    
	require_once('dbconnection.php');
	$sql = 'SELECT f.film_id, f.title
			FROM film f, film_category fc
			WHERE f.film_id=fc.film_id
			AND fc.category_id=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('i', $cid);
	$stmt->execute();
	$stmt->bind_result($fid, $ftitle);
	while($stmt->fetch()){ ?>
		
		<li><a href="filmdetails.php?filmid=<?=$fid?>"><?=$ftitle?></a></li>
         	
			<a href="filmlist.php?filmid=<?=$fid?>"></a>
			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
				<input type="hidden" name="filmid" value="<?=$fid?>" />
				<button type="submit" name="fmd" value="delete_film">Delete film</button>
                
			</form>
	
		
<?php } ?> 
      

	</ul>
    
 
    

</body>
</html>
