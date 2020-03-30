<?php 
	
	ini_set('display_errors', 1); // set to 0 for production version
	error_reporting(E_ALL);
	$n = 0;
	$body = array();
	$thumb = array();
	$title = array();
	$date = array();
	$comments = array();
	$likes = array();
	function load_data(){	
		include('config.php');
		$result = mysqli_query($db, 'SELECT * FROM Blogs');
		global $n;
		$n = mysqli_num_rows($result);
		$i = 0;
		while($row = mysqli_fetch_assoc($result)){
			$GLOBALS['title'][$i] = $row['title'];
			$GLOBALS['body'][$i] = $row['body'];
			$GLOBALS['thumb'][$i] = $row['thumb'];
			$GLOBALS['date'][$i] = $row['date'];
			$GLOBALS['comments'][$i] = $row['comments'];
			$GLOBALS['likes'][$i] = $row['likes'];
			$i++;
			}
	
	}
	load_data();
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blogs</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<style>
body{background-color:rgba(0, 0, 0, 0.1);}
.container{
	width:70%;
	margin-left:15%;
	margin-top:20px;
}
.container img{width:100%; height:300px;}
.blog_window{
	float:left;
	width: 40%;
	height:420px;
	margin-left:5%;
	margin-right:2%;
	margin-bottom:40px;
	margin-top:50px;
	min-width:300px;
	color:black;
	font-size:20px;
	border:0px solid green;
	padding:10px;
	border-top:4px solid black;
	background-color:white;
	}

.blog_title{margin-top:20px; text-align:center;font-family: 'Montserrat', sans-serif;text-align:left;}

.blog_thumb{
	border-bottom:2px solid red;}
.blogDetails{color:rgba(0, 0, 0, 0.5); font-size:14px; text-align:left;}
@media only screen and (max-width: 1138px) {
	.blog_window{
		width: 480px;
		margin-left:8%;
		margin-right:10%;
}

@media only screen and (max-width: 650px) {
	.blog_window{
		width: 400px;
		margin-bottom:20px;
		margin-left:1%;
	}
	.container img{height:200px;}
	.blog_window{height:320px;}
	
}

@media only screen and (max-width: 520px) {
	.blog_window{
		width: 95%;
		margin-bottom:20px;
		margin-left:0%;
		margin-right:5%;
}
	.container{
		width:95%;
		margin-left:2.5%;
		}
}
</style>
</head>
<body>
<div class="container">
	<?php for($i = 0; $i < $GLOBALS['n']; $i++){?>
	<a href = "/fullblog.php?n=<?php print $i;?>" target="_blank"><div class="blog_window">
		<img class="blog_thumb" src = "<?php print file_get_contents($GLOBALS['thumb'][$i])?>"/>
		<div class="blog_title"><div class="blogDetails"> <?php print $GLOBALS['date'][$i]?> | <?php print $GLOBALS['likes'][$i]?> likes | <?php print $GLOBALS['comments'][$i]?> comments</div><div style="margin-top:10px;"><?php print($GLOBALS['title'][$i])?></div></div>
	</div></a>
	<?php }?>
</div>
<script type="text/javascript">

</script>
</body>
</html>
