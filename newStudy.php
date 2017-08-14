<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
	<script src='./js/jquery.js'></script>
	</head>
	<body>
		<?php
			/*connect to server*/
			$servername = "localhost";
			$username = "root";
			$password = "Shark123";
			$database="study";
			$conn = new mysqli($servername, $username, $password, $database);
			
			if($conn->connect_error){
				die($conn->connect_error); 
			}
			

			/*prepare statement*/
			$statement = $conn->prepare("INSERT INTO " .$_SESSION["tablename"]."(question, answer) VALUES (?,?)");
			$statement->bind_param("ss", $question, $answer);
		?>
		
		<style>
			.less{
				background-color: red;
				color: white;

			}
			
	
		</style>
		<?php
		function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}
		
		
		
		
		?>
		<form method="post" action="./newStudy.php">
		<button type="button"class="add">Add</button>
		<button type="button"class="addHead">Heading</button>
		<button type="button"class="addTitle">Title</button><br>
		<input type="submit" value="SAVE"> 
		<div id="form">
			<?php
			
			/*delete info from table*/
			
			 if(isset($_POST['content'])){
				$delete = "DELETE FROM ".$_SESSION["tablename"].";";
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
			
			
		
				/*retrieve data from table*/
				$insert = "SELECT question, answer FROM ".$_SESSION["tablename"];
				$result = $conn->query($insert);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						
					if($row["question"] === "!@#title!@#"){
						echo '<br><br><div class="enter">
							<input type="button" value="^" class="moveUp">
							<input type="button" value="v" class="moveDown">
							<input style="display: none;" name="content[]" type="text" value="!@#title!@#">
							<textarea name="content[]" rows="2" cols="43">'. $row["answer"].'</textarea>
							<button class="less">X</button><br></div>';
					}
					elseif($row["question"] === "!@#head!@#"){
						echo '<div class="enter">
							<input type="button" value="^" class="moveUp">
							<input type="button" value="v" class="moveDown">
							<input style="display: none;" name="content[]" type="text" value="!@#head!@#">
							<textarea name="content[]" rows="1" cols="43">'. $row["answer"].'</textarea>
							<button class="less">X</button><br></div>';
					}
					else{
						echo '<div class="enter">
						<input type="button" value="^" class="moveUp">
						<input type="button" value="v" class="moveDown">
						<textarea name="content[]" rows="2" cols="20">'. $row["question"].'</textarea>
						<textarea name="content[]" rows="2" cols="20">'. $row["answer"].'</textarea>
						<button class="less">X</button><br></div>';	
					}
						
					}
					
					
				} 
				
			
			?>
		
		</form>
		<script src="./js/newStudy.js" type="text/javascript"></script>
		<?php
		
		
		
		$conn->close();
		
		?>


		



		
	</body>
</html>