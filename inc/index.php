<html>
<head>
<style>
	body {
	width:600px;
	text-align:center;
	}
	.sql-import-response {
		padding: 10px;
	}
	.success-response {
		background-color: #a8ebc4;
	    border-color: #1b7943;
	    color: #1b7943;
	}
	.error-response {
		border-color: #d96557;
    	background: #f0c4bf;
    	color: #d96557;
	}
</style>
</head>
<body>
<?php
$conn =new mysqli(DB_HOST, DB_USER, DB_PASSWORD , DB_NAME);
$query = '';
$sqlScript=file(plugins_url('duaa-1/inc/wp_duaa.sql'));

//$sqlScript =file('http://moh.loc/wp/wp-content/plugins/duaa/inc/wp_duaa.sql');
if($sqlScript){
foreach ($sqlScript as $line)	{
	
	$startWith = substr(trim($line), 0 ,2);
	$endWith = substr(trim($line), -1 ,1);
	
	if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
		continue;
	}
		
	$query = $query . $line;
	if ($endWith == ';') {
		mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
		$query= '';		
	}
}
}
echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
?>
</body>
</html>

