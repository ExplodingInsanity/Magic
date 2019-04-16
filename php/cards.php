<html> 
<head> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Magic</title>
</head>
<body bgcolor="#7F879C">
<form action="cards.php" method="GET" id="mainForm">
<?php 
echo '<input type="hidden" name="offset" ';
if(isset($_GET['offset'])) echo 'value="'.$_GET['offset'].'"/>';
else echo 'value="0"/>';
?>
<select name="set" onchange="this.form.submit()" style="width:100%;">
<?php
include('../dbconnection.php');
$allSets = mysqli_query($connection,"Select * from nsets");
while($set = mysqli_fetch_assoc($allSets)){
	echo '<option value="'.$set['Ncode'].'"';
	if(isset($_GET['set']) && $_GET['set'] == $set['Ncode']) echo ' selected';
	echo '>'.$set['Nname'].' ('.$set['Ndate'].')</option>';
}
?>
</select>
</form>
<?php
if(isset($_GET['offset']) && (int)($_GET['offset']) > 0) echo '<button onclick="getback()">previous page</button>';
else echo '<button onclick="getback()" disabled>previous page</button>';
if(isset($_GET['set'])) $count = mysqli_fetch_array(mysqli_query($connection,"select count(Nid) from ncards where Nset = \"".$_GET['set']."\""))[0];
if(isset($_GET['offset']) && (int)($_GET['offset'])+25 > $count) echo '<button onclick="getnext()">next page</button>';
else echo '<button onclick="getnext()">next page</button>';
?>
<?php
if(isset($_GET['set'])) $query = "Select * from nsets where Ncode = \"".$_GET['set']."\"";
else $query = "Select * from nsets";
$setRes = mysqli_query($connection,$query);
$set = mysqli_fetch_assoc($setRes);

echo '<h1>'.$set['Nname'].' ('.$set['Ndate'].')</h1>';

$query = "SELECT * FROM ncards WHERE Nset=\"".$set['Ncode']."\"";
$result = mysqli_query($connection,$query);
if(isset($_GET['offset'])){
$num = (int)$_GET['offset'];
while($num > 0) { $card = mysqli_fetch_assoc($result); $num--;}
}

for($i=1; $i<=25; $i++){
$card = mysqli_fetch_assoc($result);
if($card) echo '<img src="../media/'.$card['Nset'].'/'.$card['Nid'].'.full.jpg" width="25%" alt="">';
}
?>
<script>
	function getnext(){
		console.log("da");
		var num = parseInt($('input[name=offset]').val());
		num+=25;
		$('input[name="offset"]').val(num);
		$('#mainForm').submit();
	};
	function getback(){
		console.log("da");
		var num = parseInt($('input[name=offset]').val());
		num-=25;
		if(num < 0) num = 0;
		$('input[name=offset]').val(num);
		$('#mainForm').submit();
	};
</script>
</body>
</html>
