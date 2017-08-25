<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Start the session
session_start();

/*connect to server*/
$tableNames = "allTables";
$servername = "localhost";
$username = "root";
$password = "Shark123";
$database="study";
$conn = new mysqli($servername, $username, $password, $database);
$tableName = $colorOne = $colorTwo = $textColor = $image = "";
if($conn->connect_error){
die($conn->connect_error); 
}
if (isset($_POST['formid']) && isset($_SESSION['formid']) && $_POST["formid"] == $_SESSION["formid"]){
	header("Location:menu.php");
    $_SESSION["formid"] = '';
    $tables = "SELECT tableName, colorOne, colorTwo, textColor,image, editName FROM ".$tableNames;
	$resulttables = $conn->query($tables);
	//generate key
	$key = md5(microtime().rand());
	$last_id = $key ;
	$sql = "INSERT INTO alltables (tableName, colorOne, colorTwo, textColor, image, editName)
	VALUES ('".$last_id ."','#1F3A93','#3A539B','#ffffff','http://benoitfelten.com/wp-content/uploads/2013/01/06012013-IMG_1023.jpg','untitled')";

	if ($conn->query($sql) === TRUE) {
		$sqw = "CREATE TABLE `".$last_id."` (
		question VARCHAR(252),
		answer VARCHAR(252),
		date TIMESTAMP
		)";

		if ($conn->query($sqw) === TRUE) {
			$sqr = "INSERT INTO ".$last_id ."(question, answer) VALUES ('!@#title!@#','This is a TITLE');";
			$sqr .= "INSERT INTO ".$last_id ."(question, answer) VALUES ('!@#head!@#','This is a HEADING');";
			$sqr .= "INSERT INTO ".$last_id ."(question, answer) VALUES ('data','data')";
	if ($conn->multi_query($sqr) === TRUE) {
			} 
		else {
			echo "Error creating table: " . $conn->error;
		}
		}
		

	} 
	else {
    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	


}
else
{
    $_SESSION["formid"] = md5(rand(0,10000000));
}

?>
<!DOCTYPE html>
<html>
<head>
<title>menu</title>
<link href="./css/menu.css" type="text/css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
</head>
<body>
<?php
$tables = "SELECT tableName, colorOne, colorTwo, textColor,image, editName FROM ".$tableNames;
$resulttables = $conn->query($tables);

if ($resulttables->num_rows > 0) {
	while($row = $resulttables->fetch_assoc()) {
		echo "<a target='_blank' href='./biology.php?value=".$row["tableName"]."'><button>".$row["editName"]."</button></a>" ;
	} 
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" name="formid" value="<?php echo htmlspecialchars($_SESSION["formid"]); ?>" />
<input type="submit" value="+">
</form>

</body>
</html>