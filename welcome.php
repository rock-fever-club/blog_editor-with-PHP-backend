<?php
    // ini_set('display_errors', 1); // set to 0 for production version
     //error_reporting(E_ALL);
     //echo  posix_getpwuid(posix_geteuid())['name'];
     include('session.php');
     include('config.php');
     if(isset($_POST['submitButton'])){ 
     	$blog_body = $_POST['myDoc']; 
	$blog_thumb = $_POST['myThumb'];
	$blog_title = $_POST['myTitle'];
	$val = mysqli_query($db, 'select * from Blogs');
	if($val == FALSE)
	{  
	   mysqli_query($db, 'CREATE TABLE Blogs(
				body VARCHAR(255) NOT NULL,
				thumb VARCHAR(70) NOT NULL,
				title VARCHAR(255) NOT NULL,
				date VARCHAR(50),
				comments INT,
				likes INT)');
	}
	$rows = mysqli_num_rows($val);
	echo $rows;
	$filepath = "./blogs/blog_".$rows.".html";
	$myfile = fopen($filepath, "w") or die("Unable to open file!");
	$txt = $blog_body."\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	$filepath = "./blogs/blog_".$rows."_thumb.txt";
	$myfile = fopen($filepath, "w") or die("Unable to open file!");
	$txt = $blog_thumb."\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	$sql = 'INSERT INTO Blogs VALUES("./blogs/blog_'.$rows.'.html","'.$filepath.'","'.$blog_title.'","'. date("Y/m/d").'", 0, 0)';
	if (!mysqli_query($db, $sql)) {
    		echo "some error is there";}
	else header('Location:blogs.php');
     }
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rich Text Editor</title>

<style type="text/css">
body{ background: url("editor_bg.jpg") no-repeat center center fixed;
  background-size: cover ;}
#compForm{background-color:rgba(0, 0, 0, 0.5 );padding-bottom:20px; margin-bottom:0px;}
blockquote{
  margin-left:40px;}
.intLink1 { cursor: pointer; margin-top:2px;}
.intLink{cursor: pointer;} 
.preview{
  width:60%;
  margin-left:20%;
  padding:12px;
  border-top: 1px #000000 solid;
  min-height:240px;
  background-color:rgba(255, 255, 255, 0.7);
 }
#toolBar1{padding-top:20px;}
#toolBar1 select { font-size:10px; }
#toolBar1, #toolBar2,.submit-btn,.my_thumb{width:60%;margin-left:20%;cursor:pointer;}
.blogTitle{
	margin-left:20%;
	margin-top:30px;
}
.submit-btn{width:60px; border:0px solid black; padding:5px;font-weight:bold;border-radius:10px; background-color:green; color:white;}

.submit-btn:hover,.submit_post:hover{background-color:#388E8E; color:white; }
#toolBar2 a{
  margin-left:5px;
  margin-right:5px;
}
#toolBar2 i:hover{
	color:white;
	}
#textBox {
  width: 60%;
  margin-left:20%;
  height: 400px;
  border: 1px #000000 solid;
  padding: 12px;
  overflow: scroll;
  margin-top:20px;
  min-height: 200px;
  background-color:rgba(255, 255, 255, 0.7);
}
.edit{margin-top:30px; width:50px;}
.my_thumb{margin-top:30px;}
.submit_post{margin-left:20%; margin-top:30px; font-weight:bold; background-color:green; cursor:pointer; border:0px solid black; border-radius:10px;padding:5px;font-size:18px;color:white;}

@media only screen and (max-width: 650px) {
	#toolBar1,#textBox,#toolBar2,.preview{width:97%; margin-left:0%;margin-right:0%;padding: 4px;
}
	#textBox{height:200px;}
	.blogTitle,.submit-btn,.my_thumb,.submit_post{margin-left:1%;}
}
</style>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
</head>
<body onload="initDoc();">
<form id = "compForm" name="compForm" method="post" action="" onsubmit="this.myDoc.value = oDoc.innerHTML;" enctype="multipart/form-data">
<input type="hidden" name="myDoc">
<input type="hidden" id = "myThumb" name="myThumb">
<div id="toolBar1">
<select onchange="formatDoc('formatblock',this[this.selectedIndex].value);">
<option selected>- formatting -</option>
<option value="h1">Title 1 &lt;h1&gt;</option>
<option value="h2">Title 2 &lt;h2&gt;</option>
<option value="h3">Title 3 &lt;h3&gt;</option>
<option value="h4">Title 4 &lt;h4&gt;</option>
<option value="h5">Title 5 &lt;h5&gt;</option>
<option value="h6">Subtitle &lt;h6&gt;</option>
<option value="p">Paragraph &lt;p&gt;</option>
<option value="pre">Preformatted &lt;pre&gt;</option>
</select>
<select onchange="formatDoc('fontname',this[this.selectedIndex].value);">
<option class="heading" selected>- font -</option>
<option>Arial</option>
<option>Arial Black</option>
<option>Courier New</option>
<option>Times New Roman</option>
<option>arial,sans-serif-light,sans-serif</option>
<option>'Montserrat', sans-serif</option>
</select>
<select onchange="formatDoc('fontsize',this[this.selectedIndex].value);">
<option class="heading" selected>- size -</option>
<option value="1">Very small</option>
<option value="2">A bit small</option>
<option value="3">Normal</option>
<option value="4">Medium-large</option>
<option value="5">Big</option>
<option value="6">Very big</option>
<option value="7">Maximum</option>
</select>
<select id="lineHeight" onchange="changeStyle('line-height', this.value)">
<option class="heading" selected>- line height -</option>
<option value="25px">25px</option>
<option value="30px">30px</option>
<option value="40px">40px</option>
<option value="50px">50px</option>
<option value="80px">80px</option>
<option value="100px">100px</option>
</select>
<select onchange="formatDoc('forecolor',this[this.selectedIndex].value);">
<option class="heading" selected>- color -</option>
<option value="red">Red</option>
<option value="blue">Blue</option>
<option value="green">Green</option>
<option value="black">Black</option>
</select>
<select onchange="formatDoc('backcolor',this[this.selectedIndex].value);">
<option class="heading" selected>- background -</option>
<option value="yellow">Yellow</option>
<option value="green">Green</option>
<option value="grey">Grey</option>
</select>
</div>
<div id="toolBar2">
<img class="intLink1" title="Clean" onclick="if(confirm('Are you sure?')){oDoc.innerHTML=sDefTxt};" src="data:image/gif;base64,R0lGODlhFgAWAIQbAD04KTRLYzFRjlldZl9vj1dusY14WYODhpWIbbSVFY6O7IOXw5qbms+wUbCztca0ccS4kdDQjdTLtMrL1O3YitHa7OPcsd/f4PfvrvDv8Pv5xv///////////////////yH5BAEKAB8ALAAAAAAWABYAAAV84CeOZGmeaKqubMteyzK547QoBcFWTm/jgsHq4rhMLoxFIehQQSAWR+Z4IAyaJ0kEgtFoLIzLwRE4oCQWrxoTOTAIhMCZ0tVgMBQKZHAYyFEWEV14eQ8IflhnEHmFDQkAiSkQCI2PDC4QBg+OAJc0ewadNCOgo6anqKkoIQA7" />
<img class="intLink1" title="Remove formatting" onclick="formatDoc('removeFormat')" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAAd0SU1FB9oECQMCKPI8CIIAAAAIdEVYdENvbW1lbnQA9syWvwAAAuhJREFUOMtjYBgFxAB501ZWBvVaL2nHnlmk6mXCJbF69zU+Hz/9fB5O1lx+bg45qhl8/fYr5it3XrP/YWTUvvvk3VeqGXz70TvbJy8+Wv39+2/Hz19/mGwjZzuTYjALuoBv9jImaXHeyD3H7kU8fPj2ICML8z92dlbtMzdeiG3fco7J08foH1kurkm3E9iw54YvKwuTuom+LPt/BgbWf3//sf37/1/c02cCG1lB8f//f95DZx74MTMzshhoSm6szrQ/a6Ir/Z2RkfEjBxuLYFpDiDi6Af///2ckaHBp7+7wmavP5n76+P2ClrLIYl8H9W36auJCbCxM4szMTJac7Kza////R3H1w2cfWAgafPbqs5g7D95++/P1B4+ECK8tAwMDw/1H7159+/7r7ZcvPz4fOHbzEwMDwx8GBgaGnNatfHZx8zqrJ+4VJBh5CQEGOySEua/v3n7hXmqI8WUGBgYGL3vVG7fuPK3i5GD9/fja7ZsMDAzMG/Ze52mZeSj4yu1XEq/ff7W5dvfVAS1lsXc4Db7z8C3r8p7Qjf///2dnZGxlqJuyr3rPqQd/Hhyu7oSpYWScylDQsd3kzvnH738wMDzj5GBN1VIWW4c3KDon7VOvm7S3paB9u5qsU5/x5KUnlY+eexQbkLNsErK61+++VnAJcfkyMTIwffj0QwZbJDKjcETs1Y8evyd48toz8y/ffzv//vPP4veffxpX77z6l5JewHPu8MqTDAwMDLzyrjb/mZm0JcT5Lj+89+Ybm6zz95oMh7s4XbygN3Sluq4Mj5K8iKMgP4f0////fv77//8nLy+7MCcXmyYDAwODS9jM9tcvPypd35pne3ljdjvj26+H2dhYpuENikgfvQeXNmSl3tqepxXsqhXPyc666s+fv1fMdKR3TK72zpix8nTc7bdfhfkEeVbC9KhbK/9iYWHiErbu6MWbY/7//8/4//9/pgOnH6jGVazvFDRtq2VgiBIZrUTIBgCk+ivHvuEKwAAAAABJRU5ErkJggg==">
<a class="intLink" title="Undo" onclick="formatDoc('undo');" ><i class="fa fa-undo" aria-hidden="true"></i></a>
<a class="intLink" title="Redo" onclick="formatDoc('redo');" ><i class="fa fa-repeat" aria-hidden="true"></i></a>
<a class="intLink" title="Bold" onclick="formatDoc('bold');" ><i class="fa fa-bold" aria-hidden="true"></i></a>
<a class="intLink" title="Italic" onclick="formatDoc('italic');" ><i class="fa fa-italic" aria-hidden="true"></i></a>
<a class="intLink" title="Underline" onclick="formatDoc('underline');" ><i class="fa fa-underline" aria-hidden="true"></i></a>
<a class="intLink" title="Left align" onclick="formatDoc('justifyleft');" ><i class="fa fa-align-left" aria-hidden="true"></i></a>
<a class="intLink" title="Center align" onclick="formatDoc('justifycenter');" ><i class="fa fa-align-center" aria-hidden="true"></i></a>
<a class="intLink" title="Right align" onclick="formatDoc('justifyright');" ><i class="fa fa-align-right" aria-hidden="true"></i></a>
<a class="intLink" title="Numbered list" onclick="formatDoc('insertorderedlist');"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
<a class="intLink" title="Dotted list" onclick="formatDoc('insertunorderedlist');"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
<img class="intLink1" title="Delete indentation" onclick="formatDoc('outdent');" src="data:image/gif;base64,R0lGODlhFgAWAMIHAAAAADljwliE35GjuaezxtDV3NHa7P///yH5BAEAAAcALAAAAAAWABYAAAM2eLrc/jDKCQG9F2i7u8agQgyK1z2EIBil+TWqEMxhMczsYVJ3e4ahk+sFnAgtxSQDqWw6n5cEADs=" />
<img class="intLink1" title="Add indentation" onclick="formatDoc('indent');" src="data:image/gif;base64,R0lGODlhFgAWAOMIAAAAADljwl9vj1iE35GjuaezxtDV3NHa7P///////////////////////////////yH5BAEAAAgALAAAAAAWABYAAAQ7EMlJq704650B/x8gemMpgugwHJNZXodKsO5oqUOgo5KhBwWESyMQsCRDHu9VOyk5TM9zSpFSr9gsJwIAOw==" />
<a class="intLink" title="Hyperlink" onclick="var sLnk=prompt('Write the URL here','https:\/\/');if(sLnk&&sLnk!=''&&sLnk!='http://'){formatDoc('createlink',sLnk)}"><i class="fa fa-link" aria-hidden="true"></i></a> 
<a class="intLink" title="Cut" onclick="formatDoc('cut');" ><i class="fa fa-scissors" aria-hidden="true"></i></a>
<a class="intLink" title="Copy" onclick="formatDoc('copy');" ><i class="fa fa-clone" aria-hidden="true"></i></a>
<a class="intLink" title="Paste" onclick="formatDoc('paste');" ><i class="fa fa-clipboard" aria-hidden="true"></i></a>
<a class="intLink image_upload" title="Add Image" onclick=""><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
<a class="intLink video_upload" title="Add youtube video" onclick="add_video()"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>

<input type="file" id="my_file" style="display: none;" accept="image/jpeg, image/jpg,image/png, image/gif"/>
<input class="height" value = "400" style="display:none; width:70px;" onkeyup = "resize_image()"/>
<input class="width" value = "400" style="display:none; width:70px;" onkeyup = "resize_image()"/>
</div>
<div id="textBox" contenteditable="true" onclick = "hide_resize()" onkeyup="update_preview()"><p></p></div>
<p><div class= "submit-btn" value="Send" onclick = "toggle_editor(1)">SEND</div></p>
<h3 style="margin-left:20%; margin-top:50px; color:green;">Preview</h3>
<div class="preview"></div>
<div class="edit submit-btn" onclick = "toggle_editor(0)">EDIT</div>
<input class="blogTitle" type="text" placeholder="Enter the title of blog..." name="myTitle" required/> 
<input type="file" class="my_thumb" title="Thumbnail" accept="image/jpeg, image/jpg,image/png, image/gif" required/>
<input class= "submit_post" type="submit" value="POST" name="submitButton"></input>
</form>
<script type="text/javascript">
var oDoc, sDefTxt,current_img;

function initDoc() {
  oDoc = document.getElementById("textBox");
  sDefTxt = oDoc.innerHTML;
  document.querySelector(".submit_post").style.display="none";	
  document.querySelector(".edit").style.display="none";	
  document.querySelector(".my_thumb").style.display="none";
  document.querySelector(".blogTitle").style.display="none";
}
function update_preview(){
  var data = oDoc.innerHTML;
  document.querySelector(".preview").innerHTML = data;
}

function formatDoc(sCmd, sValue) {
  document.execCommand(sCmd, false, sValue); 
  if(sCmd == "createlink"){
	console.log("time to change");
	var selection = document.getSelection();
	selection.anchorNode.parentElement.target = '_blank';	
	}
  oDoc.focus();
  update_preview();
}

function resize_image(){
	var height = document.querySelector(".height");
	var width = document.querySelector(".width");
	var h = height.value; var w = width.value;
	current_img.style.width = w + "%"; current_img.style.height = h + "%";
	update_preview();
}
function hide_resize(){
	document.querySelector(".height").style.display = "none";
	document.querySelector(".width").style.display = "none";
}

function toggle_editor(n){
	if(n == 1){
		document.querySelector("#toolBar1").style.display="none";
		document.querySelector("#toolBar2").style.display="none";
		document.querySelector("#textBox").style.display="none";
		document.querySelector(".preview").style.border="0px";
		document.querySelector(".submit-btn").style.display="none";
		document.querySelector(".submit_post").style.display="block";
		document.querySelector(".edit").style.display="block";
		document.querySelector(".my_thumb").style.display="block";
		document.querySelector(".blogTitle").style.display="block";
	}
	else{	document.querySelector(".preview").style.border="1px solid black";
		document.querySelector("#toolBar1").style.display="block";
		document.querySelector("#toolBar2").style.display="block";
		document.querySelector("#textBox").style.display="block";
		document.querySelector(".submit-btn").style.display="block";
		document.querySelector(".submit_post").style.display="none";
		document.querySelector(".edit").style.display="none";
		document.querySelector(".my_thumb").style.display="none";	
		document.querySelector(".blogTitle").style.display="none";
	}
}

function changeStyle( property, value ) {
    if ( window.getSelection().rangeCount ) {
        var range = window.getSelection().getRangeAt( 0 ),
            contents = range.extractContents(),
            span = document.createElement( 'span' );

        span.style[ property ] = value;
        span.appendChild( contents );
        range.insertNode( span );
        window.getSelection().removeAllRanges();
	update_preview();
    }
}

function add_video(){
	var id = prompt("Enter the id of youtube video");
	console.log(id);
	var parent = document.querySelector('#textBox');
	let p = document.createElement("iframe")
	p.style.height="50%";
	p.style.width = "100%";
	p.style.minHeight = "200px";
	p.style.textAlign="center";
	p.setAttribute('allowFullScreen', 'true')
	p.src = "https://www.youtube.com/embed/" + id;
	parent.append(p);
	update_preview();
}

$(".image_upload").click(function() {
    $("input[id='my_file']").click();
});

$( document ).ready(function(){
      $('#my_file').on('change', function(){
         var targetDiv=document.getElementById("textBox");
         var file = $(this).prop('files')[0];
	 if(file.size > 52000){
		alert("file size should be less than 51 kb");return;}
         var img=document.createElement("img");
         var reader  = new FileReader();
         targetDiv.append(img);
         reader.addEventListener("load", function () {
         img.src=reader.result;
	 img.style.height = "400px";
	 img.style.width = "400px";
	 img.addEventListener('dblclick', function (e) {
  	 //resize image
	 current_img = img;
	 var height = document.querySelector(".height");
	 var width = document.querySelector(".width");
	 height.style.display = "inline"; width.style.display = "inline";
	 current_img.style.minHeight = "200px";
	 current_img.style.minWidth = "300px";
	 console.log("resize image");
	});
	 update_preview();
         }); 
         if (file)
            reader.readAsDataURL(file);
        });

      $('.my_thumb').on('change', function(){
         var target=document.getElementById("myThumb");
         var file = $(this).prop('files')[0];
	 if(file.size > 52000){
		alert("file size should be less than 51 kb");return;}
 
         var reader  = new FileReader();
         reader.addEventListener("load", function () {
         target.value = reader.result;
	 console.log(target.value);
         }); 
         if (file)
            reader.readAsDataURL(file);
        });
   })

</script>
</body>
</html>
