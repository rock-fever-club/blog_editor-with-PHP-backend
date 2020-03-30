<?php
	ini_set('display_errors', 1); // set to 0 for production version
        error_reporting(E_ALL);
	set_time_limit(0);
	include('config.php');
    	//echo $_GET['n'];
     	$n = 0;$m = 0;
	$body = array();
	$thumb = array();
	$title = array();
	$date = array();
	$comments = array();
	$likes = array();
	$commentName = array();
	$commentBody = array();
	$commentEmail = array();
	$commentdate = array();
	$currentBlog = intval($_GET['n']);
	function load_data(){	
		$result = mysqli_query($GLOBALS['db'], 'SELECT * FROM Blogs');
		$GLOBALS['n'] = mysqli_num_rows($result);
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
		$i = 0;
		if($GLOBALS['comments'][$GLOBALS['currentBlog']] != 0){
			$t = mysqli_query($GLOBALS['db'], 'SELECT * FROM blog_'.$GLOBALS['currentBlog'].'_comments');
			$GLOBALS['m'] = mysqli_num_rows($t);
			$j = 0;	
			while($row1 = mysqli_fetch_assoc($t)){
			$GLOBALS['commentName'][$i] = $row1['name'];
			$GLOBALS['commentBody'][$i] = $row1['body'];
			$GLOBALS['commentEmail'][$i] = $row1['email'];
			$GLOBALS['commentDate'][$i] = $row1['date'];
			$i++;
			}
		}
	}
	load_data();
	if(isset($_POST['submitButton'])){ 
		$email = $_POST['email'];
		$name = $_POST['name'];
		$comment_body = $_POST['comment'];
		$val = mysqli_query($GLOBALS['db'], 'SELECT * FROM blog_'.$GLOBALS['currentBlog'].'_comments');

		if($val == False){
			mysqli_query($GLOBALS['db'], 'CREATE TABLE blog_'.$GLOBALS['currentBlog'].'_comments(
					body VARCHAR(255) NOT NULL,
					email VARCHAR(70) NOT NULL,
					name VARCHAR(255) NOT NULL,
					date VARCHAR(50))');}
		
		$sql = 'INSERT INTO blog_'.$GLOBALS['currentBlog'].'_comments VALUES("'.$GLOBALS['comment_body'].'","'.$GLOBALS['email'].'","'.$GLOBALS['name'].'","'.date("Y/m/d").'")';
		echo  'UPDATE Blogs SET comments ='.strval($GLOBALS['comments'][$GLOBALS['currentBlog']] + 1).' WHERE title = "'.$GLOBALS['title'][$GLOBALS['currentBlog']].'"';
		mysqli_query($GLOBALS['db'], 'UPDATE Blogs SET comments ='.strval($GLOBALS['comments'][$GLOBALS['currentBlog']] + 1).' WHERE title = "'.$GLOBALS['title'][$GLOBALS['currentBlog']].'"');
		if (!mysqli_query($GLOBALS['db'], $sql)) {
    		echo "some error is there";}
		else header("Location:fullblog.php?n=".$GLOBALS['currentBlog']."#comments");	
	}
	if (isset($_GET['likes'])) {
		mysqli_query($GLOBALS['db'], 'UPDATE Blogs SET likes ='.strval($GLOBALS['likes'][$GLOBALS['currentBlog']] + 1).' WHERE title = "'.$GLOBALS['title'][$GLOBALS['currentBlog']].'"');
		header("Location:fullblog.php?n=".$GLOBALS['currentBlog']."#comikes");
	}
?>

<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

.container{
	  width:700px;
	  margin-left:25%;
	  padding:12px;
	  border-top: 1px #000000 solid;
	  background-color:white;
}
.blog_body{border-bottom: 1px #000000 solid; margin-bottom:30px;}
.general{
	  width:700px;
	  margin-left:25%;
	  padding:10px;
	  margin-top:50px;
	  font-size:14px;	
}
.thumb{
	width:100%;
	height:400px;
}
.title{
	margin-bottom:20px;
	margin-top:5px;
 	font-family: 'Montserrat', sans-serif;
	font-weight:400;
	font-size:42px;
}

.comment-section{
	border-top:2px solid black;
}
.no-comments{
	margin-top:25px;
 	font-family: 'Montserrat', sans-serif;
	font-weight:400;
	font-size:20px;
}
.do-comment{
	font-weight:bold;
	margin-top:40px;
	font-size:20px;
}
.comment-box{margin-top:20px;}
.comment-area{
	width:100%;
	height:180px;
	padding:20px;
}
.thumb{margin-bottom:50px;}
.comikes{margin-bottom:20px; margin-top:30px; display:inline-block;}
.comikes div{float:left; margin-right:15px;}

.comikes i{margin-right:3px; font-size:20px;}

.name,.email{width:50%; height:30px;}
.name:focus,.email:focus, textarea:focus{border:2px solid green;}
.post-btn{margin-top:10px; width:100%; height:40px; background-color:#f5b029;border:0px; border-radius:20px;cursor:pointer;}

.comments{border:1px solid #388E8E; margin-top:20px;padding:10px;}
.commentDetails{font-family:'Montserrat', sans-serif; font-size:18px; width:auto; border-bottom:1px solid black;  display:inline-block; padding-bottom:5px;}
.commentBody{font-size:16px; margin-top:20px;}
@media only screen and (max-width: 980px) {
	.container,.general{
		width:80%; margin-left:10%;margin-right:2.5%;padding: 4px;
}
}
@media only screen and (max-width: 500px) {
	.container,.general{
		width:95%; margin-left:0%;margin-right:2.5%;padding: 4px;

}
	.thumb{height:250px;}
}
</style>
</head>
<body onload = "set()">
	<div class="general">Posted On: <?php print $GLOBALS['date'][$GLOBALS['currentBlog']]?><div style="float:right;"><i class="fa fa-comments" aria-hidden="true"></i> 
		<?php print $GLOBALS['comments'][$GLOBALS['currentBlog']]?></div> <div style="float:right;margin-right:20px;"><i style="color:red;" class="fa fa-heart" aria-hidden="true"></i>
		<?php print $GLOBALS['likes'][$GLOBALS['currentBlog']]?></div> 
	</div>
	<div class="container">
		<div class="blog_body">
			<div class="title"><?php print $GLOBALS['title'][$GLOBALS['currentBlog']]?></div>
			<div class="thumb"><img style="width:100%; height:100%;" class="blog_thumb" src = "<?php print file_get_contents($GLOBALS['thumb'][$GLOBALS['currentBlog']])?>"/></div>
			<?php print file_get_contents($GLOBALS['body'][$GLOBALS['currentBlog']]);?>
		</div>
		<div class="comikes" id="comikes">
			<div ><i class="fa fa-comments" aria-hidden="true"></i> <?php print $GLOBALS['comments'][$GLOBALS['currentBlog']]?></div> 
			<div ><a href="<?php print 'fullblog.php?n='.$GLOBALS['currentBlog'].'&likes=true' ?>"><i style="color:red;" class="fa fa-heart" aria-hidden="true"></i></a> <?php print $GLOBALS['likes'][$GLOBALS['currentBlog']]?></div>
		</div>

		<div class="comment-section" id="comments"><?php if($GLOBALS['comments'][$GLOBALS['currentBlog']] == 0){?>
			<div class="no-comments">No Comments</div>
		<?php }else{ for($i = 0 ; $i < $GLOBALS['m']; $i++){?>
			<div class="comments">
				<div class="commentDetails"><?php print $GLOBALS['commentName'][$i]?>&nbsp;|&nbsp;<?php print $GLOBALS['commentDate'][$i]?></div>			
				<div class="commentBody"><?php print $GLOBALS['commentBody'][$i]?></div>
			</div>
		<?php }}?>
			<div class="do-comment">Leave A Comment</div>
			<form method="post" action="">
				<div class="comment-box"><textarea name = "comment" class="comment-area" placeholder="type your reply here..." required></textarea></div>
				<div class="commentor-details"><input class="name" name = "name" placeholder="name" required/><input name = "email" class="email" placeholder="email" onkeyup = "checkMail()" required/>
				</div>
				<input class="post-btn" type="submit" value="Post Comment"name='submitButton' disabled/>
			</form>
		</div>

	</div>
</body>
<script>
	function set(){
		var x = document.getElementsByTagName('iframe');
		console.log(x);
		for(var i = 0; i < x.length; i++ )		
			x[i].style.height = "400px";
	
	}
	
	function myFunction1(){
		var x = document.getElementsByTagName('iframe');
		console.log(x);
		for(var i = 0; i < x.length; i++ )		
			x[i].style.height = "250px";
	}
	function myFunction2(){
		var x = document.getElementsByTagName('iframe');
		console.log(x);
		for(var i = 0; i < x.length; i++ )		
			x[i].style.height = "400px";
	}
	function checkMail(){
		var data = document.querySelector(".email");
		if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(data.value)){
			data.style.border = "2px solid green";
			document.querySelector('.post-btn').disabled = false;
		}
		else{data.style.border = "2px solid red"; document.querySelector('.post-btn').disabled = true;}

}
	var x = window.matchMedia("(max-width: 500px)")
	myFunction1(x) // Call listener function at run time
	x.addListener(myFunction1) // Attach listener function on state changes 
	
	var y = window.matchMedia("(max-width: 980px)")
	myFunction2(y) // Call listener function at run time
	y.addListener(myFunction2) // Attach listener function on state changes 
	
</script>
</html>
