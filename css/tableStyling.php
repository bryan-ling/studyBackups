<?php
session_start();
header("Content-type: text/css");
$tableName = "allTables";
$unit = $_SESSION["color"];
$colorOne = $colorTwo = $textColor = $image = "red";

/*connect to server*/
	$servername = "localhost";
	$username = "root";
	$password = "Shark123";
	$database="study";
	$conn = new mysqli($servername, $username, $password, $database);
	$main=$_SESSION["color"];
	
	
	if($conn->connect_error){
		die($conn->connect_error); 
	}
	
/*set colors*/
$insert = "SELECT tableName, colorOne, colorTwo, textColor,image FROM ".$tableName;
$result = $conn->query($insert);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	if($row["tableName"] === $main){
		$colorOne = $row["colorOne"];
		$colorTwo = $row["colorTwo"];
		$textColor = $row["textColor"];
		$image = $row["image"];
	}
} 
}
	
	
	
	
?>

*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Ubuntu Condensed', sans-serif;
	
}
.titleColor{
	background-color:<?=$colorOne."!important"?>;
}
.colorOne{
	background-color:<?=$colorOne?>;
}
.colorTwo{
	background-color:<?=$colorTwo."!important"?>;
}
.colorBorder{
	border-color:<?=$colorOne?>;
}
.colorBorderTwo{
	border-color:<?=$colorTwo?>;
}
.colorText{
	color: <?=$textColor?>;
	border-color: <?=$textColor?>;
}
html{
	height: 100%;
}
body{
	height: 100%;
}

.background{
	background-image: url("<?=$image?>");
	background-color: black;
	width: 100%;
	padding-top: 40px;
	background-size: cover;
	background-attachment: fixed;
	background-position: center center;
	min-height: 100%;
	poition: relative;
	display: block;
	top: 0;
    left: 0;

}

h1{
	text-align: center;
	text-transform: uppercase;
	font-size: 40px;
	border: solid 5px white;
	width: 500px;
	margin: auto;
	display: block;
	}
.ShowAnswersButton{
	width: 100px;
	height: 100px;
	border-radius: 100%;
	border-width: 5px;
	border-style: solid;
	position: fixed;
	right: 5px;
	top: 5px;
	background-color: white;
	cursor: pointer;
	
}
.ShowQuestionsButton{
	width: 100px;
	height: 100px;
	border-radius: 100%;
	border-width: 5px;
	border-style: solid;
	position: fixed;
	left: 5px;
	top: 5px;
	cursor: pointer;
}

.ShowAllQuestionsButtonClick{
	background-color:  white!important;
}
.titles{
	text-align: center;
	text-transform: uppercase;
	font-weight: bold;
	font-size: 30px;
	padding: 0;
	height: 0;
	width: 500px;
	
}
.subtitles{
	text-align: center;
	font-weight: bold;
	padding: 0;
	height: 0;
}
table{
	width: 500px;
	margin:auto;
	margin-top: 15px;
	display: block;
	
}
td{
	background-color: white;
	font-size: 18px;
	height: 100px;
	padding-left: 2%;
	width: 250px;
	
}
.answers{
	opacity: 0;
	background-color: white;
	
}
.answersall{
	opacity: 1;
	background-color: white;
	
}
.questions{
	opacity: 1;
	background-color: white;
	
}
.questionsall{
	opacity: 0;
	background-color: white;
	
}
.answers:hover{
	opacity: 1;
}
.questions:hover{
	opacity: 1;
}
/*indents*/
span{
	margin-left: 40px;
}
img{
	width: 170px;
	
}

.Units{
	 margin:auto;
	 padding-left: 10%;
	 padding-right: 10%;
	 position: relative;
	 margin-bottom: 30px;
	 display:block;
	 width: 500px;


}

.UnitsRow{ 
  margin-top: 10px;
}
.UnitSelect{
	width: 40px;
	height: 40px;
	border-radius: 100%;
	border-width: 4px;
	border-style: solid;
	background-color: white;
	float:left;
	margin-right: 10px;
	cursor: pointer;
}
.UnitOneUnselect{
	background-color:<?=$colorTwo?>;
}
.UnitWords p{
  color: <?=$textColor?>;
  font-size: 25px;
  padding-top: 5px;
  margin-left: 10px;


}

.HideUnit{
	display: none;
	
}



.editing{
	display: none;
}

.shower{
	display: block;
}
.less{
	background-color: red;
	color: white;
	width: 25px;
	height: 25px;
	position: relative;
	border-radius: 100%;
	border: 0;
	text-align: center;
	
}
.tableData{
	top: -43px;
}
.tableHead{
	top: -5px;
}
.tableTitle{
	top: -13px;
}
.headBorder{
	border-style:solid;
	border-width: 3px;
	width: 500px;
}
.headBorder2{
	border-style:solid;
	border-width: 7.5px 3px;
	width: 248px;
}
.moveUp{
	width: 25px;
	height: 25px;
	position: relative;
	border: 0;
	border-radius: 100%;
	cursor: pointer;
}
.moveDown{
	width: 25px;
	height: 25px;
	position: relative;
	border: 0;
	border-radius: 100%;
	cursor: pointer;
}

.enter{
	margin-top: -5px;
}
.enter:first-child{
	margin-top: 0;
}

.titleMargin{
	margin-top: 10px;
}
.titleMargin:first-child{
	margin-top: 0;
}

.editButton{
	width: 100px; 
	height: 100px;
	position: fixed;
	width: 100px;
	top: 323px; /*215*/
	left: 5px;
	border-radius: 100%;
	border: 0;
	color: <?=$textColor?>;
	background-color: <?=$colorOne?>;
	font-size: 18px;
	
	
}
.editSaveButton{
	width: 100px; 
	height: 100px;
	position: fixed;
	width: 100px;
	top: 430px;
	left: 5px;
	border-radius: 100%;
	border: 0;
	color: <?=$textColor?>;
	background-color: <?=$colorTwo?>;
	font-size: 30px;
	border-width: 5px;
	border-style: solid;
	border-color:<?=$colorOne?>;
	cursor: pointer;
	
}
.editSaveButton:focus {outline:0;}
button:focus {outline:0;}
button:hover{
	cursor: pointer;
}

.add{
	padding-bottom: 7px;
	width: 50px; 
	height: 50px;
	position: relative;
	color: <?=$textColor?>;
	background-color: <?=$colorOne?>;
	font-size: 30px;
	border: 0;
	border-radius: 100%;
	margin-right: 20px;
}
.addHead{
	width: 50px; 
	height: 50px;
	position: relative;
	color: <?=$textColor?>;
	background-color: <?=$colorOne?>;
	font-size: 10px;
	border: 0;
	border-radius: 100%;
	padding-bottom: 2px;
	top: -12px;
	margin-right: 20px;
}
.addTitle{
	width: 50px; 
	height: 50px;
	position: relative;
	color: <?=$textColor?>;
	background-color: <?=$colorOne?>;
	font-size: 10px;
	border: 0;
	border-radius: 100%;
	padding-bottom: 2px;
	top: -12px;
	
}
.addButtons{
	width: 198px;
	margin: auto;
	display: block;
}

.bright{
	transition: filter 0.3s ease; 
}
.bright:hover{
	filter: brightness(150%);
	transition: filter 0s ease; 
}
.editColors{
	background-color: <?=$colorTwo?>;
	color: <?=$textColor?>;
	display: block; 
	position: fixed; 
	z-index: 100; 
	 right: 0;
    left: 0;
    margin-right: auto;
    margin-left: auto;
    width: 600px;
	top: 250px;
	line-height: 40px;
	font-size: 20px;
	display: none;

	
}
.editColors h1{
	border: 0;
	margin-bottom: 15px;
	text-transform: none;
	background-color: <?=$colorOne?>;
	width: 596px;
	margin: 2px;
	
	
}
.editColors form{
	margin-left: 40px;
	margin-top: 20px;
}
.editColors #save{
	width: 60px; 
	height: 60px;
	border-radius: 100%;
	border: 0;
	color: <?=$textColor?>;
	background-color: <?=$colorOne?>;
	font-size: 20px;
	cursor: pointer;
	margin: auto;
	display: block;
	margin-top: 10px;
	text-align: center;
	margin-bottom: 15px;
}
#closeColors{
	width: 40px; 
	height: 40px;
	color: white;
	background-color: red;
	border-radius: 100%;
	font-size: 20px;
	textalign: center;
	position: fixed;
	right: 541px;
	top: 252px;
	padding-left: 15px;
	padding-top: 5px;
	cursor: pointer;
	z-index: 101;
	display: none;
}
.editColors #save:focus {outline:0;}

.colorsClose{
	display: none;
}

.openColors{
	width: 100px; 
	height: 100px;
	position: fixed;
	top: 215px;
	left: 5px;
	border-radius: 100%;
	color: <?=$textColor?>;
	background-color: <?=$colorTwo?>;
	font-size: 18px;
	border: 0;
}






