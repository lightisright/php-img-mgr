<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Bootstrap Theme Simply Me</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="res/bootstrap.min.css">
  <link href="res/montserrat.css" rel="stylesheet">
  <script src="res/jquery.min.js"></script>
  <script src="res/bootstrap.min.js"></script>
  <style>
  body {
      font: 20px Montserrat, sans-serif;
      line-height: 1.8;
      color: #f5f6f7;
  }
  p {font-size: 16px;}
  .margin {margin-bottom: 45px;}
  .bg-1 { 
      background-color: #000000; 
      color: #ffffff;
  }
  .bg-2 { 
      background-color: #474e5d; /* Dark Blue */
      color: #ffffff;
  }
  .bg-3 { 
      background-color: #ffffff; /* White */
      color: #555555;
  }
  .bg-4 { 
      background-color: #2f2f2f; /* Black Gray */
      color: #fff;
  }
  .container-fluid {
      padding-top: 30px;
      padding-bottom: 30px;
      height: 100%;
  }
  .navbar {
      padding-top: 10px;
      padding-bottom: 10px;
      border: 0;
      border-radius: 0;
      margin-bottom: 0;
      font-size: 1em;
      letter-spacing: 0.1em;
  }
  .navbar-nav  li a:hover {
      color: #1abc9c !important;
  }
  #dirlst { color: gray; }

html,body{height:100%;}

.container {
    height:100%;
}

.container-fluid {
    height:100%;
}

.img-responsive {
    max-height: 90%;
}
  </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Photo viewer</a>
    </div>
    <!--<div class="collapse navbar-collapse" id="myNavbar">-->
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a id="prev" href="#">&lt;</a></li>
        <li><a id="next" href="#">&gt;</a></li>
        <li><a id="print" href="#">Print</a></li>
        <li><a id="showonphotoframe" href="#">Frame &gt;</a></li>
        <li><a id="albummenu" href="#">Albums</a></li>
        <li><a id="del" href="#">Del</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- First Container -->
<div class="container-fluid bg-1 text-center">
	<select name="dirlst" id="dirlst"></select>
	<img style="display: none" class="img-responsive center-block" id="img" name="img" src="home.png"/>
	<p id="imginfo"></p>
</div>

<!-- Second Container -->
<!--
<div class="container-fluid bg-2 text-center">
  <h3 class="margin">What Am I?</h3>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
  <a href="#" class="btn btn-default btn-lg">
    <span class="glyphicon glyphicon-search"></span> Search
  </a>
</div>
-->
<!-- Third Container (Grid) -->
<!--
<div class="container-fluid bg-3 text-center">    
  <h3 class="margin">Where To Find Me?</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      <img src="birds1.jpg" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4"> 
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      <img src="birds2.jpg" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4"> 
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      <img src="birds3.jpg" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
  </div>
</div>
-->
<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>Bootstrap Theme Made By <a href="http://www.w3schools.com">www.w3schools.com</a></p> 
</footer>

<script type="text/javascript">

imglst = new Array();
curimg = 0;

/* directory listing */
dirlst = function() {
	var options = $("#dirlst");
	$.getJSON("dirlst.php", function(result) {
		$.each(result, function() {
			options.append($("<option />").val(this.dirID).text(this.dirname));
		});
	});
}

$('#albummenu').click( function() { 
	//dirlst();
	$('#img').css('display','none');
	$('#dirlst').css('display','inline');
});

/* image listing */
$('#dirlst').change( function() {
	imglst = new Array();
	curimg = 0;
	$.getJSON("imglst.php?dir="+$('#dirlst').val(), function(result) {
		$.each(result, function() {
			imglst.push(this.filename);
		});
		curimg=0; $('#img').attr('src', imglst[curimg]);
		$('#img').css('display','block');
		$('#dirlst').css('display','none');
	});
});

/* image browsing */
$('#next, #img').click( function() { curimg=(curimg<imglst.length-1)?curimg+1:0; $('#img').attr('src', imglst[curimg]); });
$('#prev').click( function() { curimg=(curimg>0)?curimg-1:imglst.length-1; $('#img').attr('src', imglst[curimg]); });

/* image deletion */
$('#del').click( function() { 	
	$.getJSON("delete.php?dir="+$('#dirlst').val()+"&id="+imglst[curimg], function(result) {
		$('cmd').push(result.text);
	});
 });

/* image printing */
$('#print').click( function() { 	
	$.getJSON("print.php?dir="+$('#dirlst').val()+"&id="+imglst[curimg], function(result) {
		$('cmd').push(result.text);
	});
 });
 
/* start slideshow on photoframe */
$('#showonphotoframe').click( function() { 	
	$.getJSON("showonphotoframe.php?dir="+$('#dirlst').val(), function(result) {
		$('cmd').push(result.text);
	});
 });
 
$(document).ready( dirlst() );

</script>


</body>

</html>
