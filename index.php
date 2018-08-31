<?
	session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<title> Home </title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body>
<div id="wrap">
	<div>
	<? include "./lib/top_login1.php"; ?>
	<div><a href="index.php"><img src="./img/top.png" border="0"></a></div>    
	</div>  <!-- end of header -->

	<div id="menu">
	<? include "./lib/top_menu1.php"; ?>	
	</div>  <!-- end of menu --> 	
	<? include "./calendar/calendar.php"; ?>

<div id="main_img"><img src="./img/title_main.png" align = center> </div>


        <? include "./lib/func.php"; ?>
		<div id="latest">
			<div id="latest1">
				<div id="title_latest1"><a href="./free/list.php"> <img src="./img/title_free.gif"></a></div>
	  			<div class="latest_box">

				<? latest_article("free", 10, 30); ?>
				</div>
			</div>
			<div id="latest2">
				<div id="title_latest2"><a href="./info/list.php"> <img src="./img/title_info.gif"></a></div>
	  			<div class="latest_box">
				<? latest_article("info", 10, 30); ?>
				</div>
			</div>						

  </div> <!-- end of content -->
</div> <!-- end of wrap -->
</body>
</html>
