<? 
	session_start(); 
	include "../lib/dbconn.php";
// 글 내용 보기 페이지(view.php)에서 전달된 $num값을 이용해 수정하려는 글의 레코드를 찾는다
	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);
// 저장된 글의 제목과 내용을 DB에서 가져와 각각 변수에 저장
	$row = mysql_fetch_array($result);       	
	$item_subject     = $row[subject];
	$item_content     = $row[content];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="euc-kr">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/greet.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<div id="wrap">
  <? include "../lib/top_login2.php"; ?>
  <div><a href="../index.php"><img src="../img/top.png" border="0"></a></div>
  <div id="menu">
	<? include "../lib/top_menu2.php"; ?>	
  </div>  <!-- end of menu --> 

  <div id="content">
	<div id="col1">
		<div id="left_menu">
<?
			include "../lib/left_menu.php";
?>
		</div>
	</div> <!-- end of col1 -->

	<div id="col2">        
		<div id="title">
			<img src="../img/title_greet.gif">
		</div>

		<div class="clear"></div>

		<div id="write_form_title">
			<img src="../img/write_form_title.gif"></div>
		<div class="clear"></div>
		<!-- 글 수정 페이지를 구성하는 form -->
		<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>"> 
		<div id="write_form">
			<div class="write_line"></div>
			<div id="write_row1">
				<div class="col1"> 닉네임 </div>
				<div class="col2"><?=$usernick?></div> <!-- 작성자의 닉네임을 화면에 표시 -->
			</div>
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 제목</div>
			<!-- DB에서 가져온 글 제목을 표시 -->
			<div class="col2"><input type="text" name="subject" value="<?=$item_subject?>" ></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row3"><div class="col1"> 내용   </div>
			<!-- DB에서 가져온 글 내용을 표시 -->
			<div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
			</div>
			<div class="write_line"></div>
		</div>
<!-- 완료버튼, 클릭시 50행 form의 action 속성에 명시된 insert.php가 실행되면서 수정된 글을 저장함 -->
		<div id="write_button"><input type="image" src="../img/ok.png">&nbsp;
								<a href="list.php?page=<?=$page?>"><img src="../img/list.png"></a>
		</div>
		</form>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>