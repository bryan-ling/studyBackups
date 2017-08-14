<?php
// Start the session
session_start();
$_SESSION["tableId"] = "1";

define ('SITE_ROOT','http://localhost');

/*connect to server*/
$main = "";
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
//find table name
$insertName = "SELECT id, tableName FROM ".$tableNames;
$resultName = $conn->query($insertName);
if ($resultName->num_rows > 0) {
	while($row = $resultName->fetch_assoc()) {
	if($row["id"] === $_SESSION["tableId"]){
		$main = $row["tableName"];
	}
} 
}
//edit colors
function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
$insertColor = "SELECT tableName, colorOne, colorTwo, textColor,image FROM ".$tableNames;
$resultColor = $conn->query($insertColor);


if(isset($_GET['colorOne'])){
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
	  $colorOne = test_input($_GET["colorOne"]);
	  $tableName = test_input($_GET["tableName"]);
	  $colorTwo  = test_input($_GET["colorTwo"]);
	  $textColor = test_input($_GET["textColor"]);
	  $image  = test_input($_GET["image"]);
	}
	$sqlColor = "UPDATE ".$tableNames." SET tableName='".$tableName ."', 
	colorOne='".$colorOne ."', 
	colorTwo='".$colorTwo ."', 
	textColor='".$textColor ."', 
	image='".$image ."' WHERE tableName='".$main."'";

	if ($conn->query($sqlColor) === TRUE) {

	} else {
	echo "Error updating record: " . $conn->error;
	}

	
}
else{
	if ($resultColor->num_rows > 0) {
	while($row = $resultColor->fetch_assoc()) {
	if($row["tableName"] === $main){
		$tableName = $row["tableName"];
		$colorOne = $row["colorOne"];
		$colorTwo = $row["colorTwo"];
		$textColor = $row["textColor"];
		$image = $row["image"];
	}
} 
}
}
/*prepare statement*/
$statement = $conn->prepare("INSERT INTO " .$main."(question, answer) VALUES (?,?)");
$statement->bind_param("ss", $question, $answer);
/*delete info from table*/

if(isset($_POST['content'])){
$delete = "DELETE FROM ".$main.";";
if ($conn->query($delete) === TRUE) {

} 
else{
	echo $conn->error;
} 
}

/*send submited data to table*/


$content = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$content = $_POST["content"]; 
$arrlength = count($content);

for($x = 0; $x < $arrlength; $x+=2) {
$question = $content[$x];
$answer = $content[$x + 1];
$statement->execute();
}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Biology gr.10</title>
		<link href="./css/tableStyling.php" type="text/css" rel="stylesheet">
		<link href="./css/highlight.css" type="text/css" rel="stylesheet">
		<script src='./js/jquery.js'></script>
		<script type="text/javascript" src="./js/questionanswerbutton.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
	</head>
<body>
	
<div class="background">
		<!-- edit colors -->
		<div style="background-color: white; display: block; position: fixed; z-index: 100; width: 100%;top: 300px;">
		<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		Table Name: <input type="text" name="tableName" value="<?php echo $tableName;?>"><br>
		Color One: <input type="color" name="colorOne" value="<?php echo $colorOne;?>"><br>
		Color Two: <input type="color" name="colorTwo" value="<?php echo $colorTwo;?>"><br>
		Text Color: <input type="color" name="textColor" value="<?php echo $textColor;?>"><br>
		Background Image URL: <input type="text" name="image" value="<?php echo $image;?>"><br>
		<input type="submit" value="Update">
		</form>
		</div>
		<button type="button" class="editButton bright">Edit Info</button>
		<!-- Highlights button-->
		<div class="highlight"><div id="highlighted"></div></div>
		<script type="text/javascript" src="../js/highlight.js"></script>
		<div class="bright ShowAnswersButton colorBorder">
		</div>
		<div class="bright ShowQuestionsButton colorBorder colorTwo"> 
		</div>
		<h1 class="colorText"><?php echo $tableName;?></h1><p id="test"></p>
		<div class="Units doneEditingHeader">
			<?php
			/*retrieve data from table*/
				$insert = "SELECT question, answer FROM ".$main;
				$result = $conn->query($insert);
				$number = 1;
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
					
					if($row["question"] === "!@#title!@#"){
						echo '<div class="UnitsRow"><div class="bright UnitSelect colorBorder" id="unit'.$number.'">
							</div><div class="UnitWords"><p>'. $row["answer"].'<p> </div></div>	';
							$number = $number + 1;
					}	
					}
				} 
			?>
		</div>

		<div style="width: 610px; margin: auto; "class="editing">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
		
		
<?php

/*retrieve data from table*/
$insert = "SELECT question, answer FROM ".$main;
$result = $conn->query($insert);
?>
		<table>
		<div id="form">
		<?php
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						
					if($row["question"] === "!@#title!@#"){
						echo '<div class="enter titleMargin">
							<input type="button" value="^" class="moveUp tableTitle">
							<input type="button" value="v" class="moveDown tableTitle">
							<input style="display: none;" name="content[]" type="text" value="!@#title!@#">
							<textarea class="headBorder colorBorder"name="content[]" rows="2" cols="95">'. $row["answer"].'</textarea>
							<button class="less tableTitle bright">X</button><br></div>';
					}
					elseif($row["question"] === "!@#head!@#"){
						echo '<div class="enter">
							<input type="button" value="^" class="moveUp tableHead">
							<input type="button" value="v" class="moveDown tableHead">
							<input style="display: none;" name="content[]" type="text" value="!@#head!@#">
							<textarea class="headBorder colorBorder" name="content[]" rows="1" cols="95">'. $row["answer"].'</textarea>
							<button class="less tableHead bright">X</button><br></div>';
					}
					else{
						
						echo '<div class="enter">
						<input type="button" value="v" class="moveDown tableData">
						<input type="button" value="^" class="moveUp tableData">
						<textarea class="headBorder2 colorBorderTwo" name="content[]" rows="5" cols="45">'. $row["question"].'</textarea>
						<textarea class="headBorder2 colorBorderTwo" name="content[]" rows="5" cols="45">'. $row["answer"].'</textarea>
						<button class="less tableData bright">X</button><br></div>';

					}
						
					}
					
					
				} 
				
			
			?>
		</div>
		<div class="addButtons">
		<button type="button"class="addHead bright">Add<br>Heading</button>
		<button type="button"class="add bright">+</button>
		<button type="button"class="addTitle bright">Add<br>Title</button><br>
		</div>
		<input class="editSaveButton bright"type="submit" value="SAVE">
		</form>
		
		</table>
		
		
		</div>
		
		
		<div class="doneEditing">
		<table class="colorTwo">
		<?php
			/*retrieve data from table*/
				$insert = "SELECT question, answer FROM ".$main;
				$result = $conn->query($insert);
				$tableclass = 1;

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						
					if($row["question"] === "!@#title!@#"){
						echo '</table><table class="bigTitle colorTwo unit'.$tableclass.'"><tr>
						<td class="titles colorText titleColor" colspan="2">'
						. $row["answer"].'</td></tr>';
						$tableclass = $tableclass + 1;
					}
					elseif($row["question"] === "!@#head!@#"){
						echo '<tr>
						<td class="subtitles colorText titleColor" colspan="2">'
						. $row["answer"].'</td></tr>';
					}
					else{
						echo '<tr>
						<td class="questions">'. $row["question"].'</td>
						<td class="answers">'. $row["answer"].'</td>
						</tr>';	
					}
						
					}
				} 
		?>
		</table>

		</div>
		
		</div>
		<script src="./js/newStudy.js" type="text/javascript"></script>
	</body>
</html>