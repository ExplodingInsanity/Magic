<html> 
<head> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Magic</title>
</head>
<body>
<?php include('../dbconnection.php'); ?>


<form action="deckbuilder.php" method="GET" id="mainForm">
<ol>
<?php
	$n = 0;
	while(isset($_GET['set'.($n+1)]) && $_GET['set'.($n+1)]!="") $n++;
	$allSets = mysqli_query($connection,"Select * from nsets");
for($i = 1; $i <= $n+1; $i++){
echo '<li><div>Expansion:
	<select name="set'.$i.'" onchange="this.form.submit()" style="width:33%;"><option value=""></option>';
	mysqli_data_seek($allSets, 0);
		while($set = mysqli_fetch_assoc($allSets)){
			echo '<option value="'.$set['Ncode'].'"';
			if(isset($_GET['set'.$i]) && $_GET['set'.$i] == $set['Ncode']) 
				echo ' selected';
			echo '>'.$set['Nname'].' ('.$set['Ndate'].')</option>';
		}
		echo'</select>
		Card:
	<select name="card'.$i.'" onchange="this.form.submit()" style="width:33%;"><option value=""></option>';
	if(isset($_GET['set'.$i])) 
			{
				if($_GET['set'.$i] == $_GET['set'.($i-1)]) mysqli_data_seek($allCards, 0);
				else $allCards = mysqli_query($connection,'Select * from ncards where Nset="'.$_GET['set'.$i].'"');
			while($card = mysqli_fetch_assoc($allCards)){
					echo '<option value="'.$card['Nid'].'"';
					if(isset($_GET['card'.$i]) && $_GET['card'.$i] == $card['Nid']) 
						 echo ' selected';
					echo '>'.$card['Nname'].'</option>';
			}
		}
		echo '</select>';
		if(isset($_GET['card'.$i]) && $_GET['card'.$i]!="")echo '<img src="../media/'.$_GET['set'.$i].'/'.$_GET['card'.$i].'.full.jpg" style="width:15%;">';
	echo '<br></div></li>';
}
?>
</ol>
</select>
</form>

share:
<textarea readonly style="width: 100%; overflow:auto;"><?php 
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo $actual_link;
?></textarea>
</body>
</html>