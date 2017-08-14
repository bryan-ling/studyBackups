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
			
								
			$sql = "INSERT INTO allTables (tableName, colorOne, colorTwo, textColor, image)
			VALUES ('Grade10Science', '#1E824C', 'rgba(3, 166, 120, 0.5)','white','http://img5.imgtn.bdimg.com/it/u=1850818307,2690142634&fm=26&gp=0.jpg')";

			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();
		?>
		
		
	</body>
</html>