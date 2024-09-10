<?
	include ('config.php');	
	$hash=$_GET['hash'];
	$i=1;
	foreach($_FILES as $file)	
	{
		$name = 'tmp_uploads/'.$hash.'_'.$i.$file['name'];
		if(move_uploaded_file($file['tmp_name'], $name))
			mysqli_query ($conn, "INSERT INTO tmp_uploads (path, hash, date) VALUES ('$name', '$hash',".time().")");
		$i++;
	}
	echo '{"success": true}';
?>