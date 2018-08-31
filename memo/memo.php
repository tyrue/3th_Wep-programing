<? 	
	session_start(); 
	
	$scale=5;			// 한 화면에 표시되는 글 수
	include "../lib/dbconn.php";

	$sql = "select * from memo order by num desc";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	// 전체 레코드의 개수를 한 페이지에 표시할 수 있는 글의 개수로 나누었을 때
	// 나머지가 없으면 몫이 전체 페이지
	if ($total_record % $scale == 0) 
		$total_page = floor($total_record/$scale);	//  floor() = 소수점 이하를 절삭
	// 나머지가 있으면 몫 + 1이 전체 페이지
	else
		$total_page = floor($total_record/$scale) + 1;
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      
	// 글 번호 계산
	$number = $total_record - $start;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="euc-kr">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/memo.css" rel="stylesheet" type="text/css" media="all">
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
	</div>
	<div id="col2">  
		<div id="title">
			<img src="../img/title_memo.gif">
		</div>

		<div id="memo_row1">
       	<form  name="memo_form" method="post" action="insert.php"> 
			<div id="memo_writer"><span >▷ <?= $usernick ?></span></div>
			<div id="memo1"><textarea rows="6" cols="95" name="content"></textarea></div>
			<!-- 메모하기 클릭 시 60행 form의 action 속성에 명시된 insert.php가 실행 -->
			<!-- 낙서장에 입력된 내용이 데이터베이스 테이블 memo에 생성 -->
			<div id="memo2"><input type="image" src="../img/memo_button.gif"></div>
		</form>	
		</div> <!-- end of memo_row1 -->
<?		
	// 현재 페이지의 낙서장 글과 그 글에 속한 덧글을 출력(p.370)
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {  // mysql_data_seek = 전체 레코드($result) 중에 특정 순서($start)에 해당하는 레코드를 가리키는 함수
      mysql_data_seek($result, $i);       
      $row = mysql_fetch_array($result);       
	  
	  $memo_id      = $row[id];
	  $memo_num     = $row[num];
      $memo_date    = $row[regist_day];
	  $memo_nick    = $row[nick];
	  // 메인글 본문($row[content])의 행 바꿈과 공백을 HTML 태그로 변경
	  // \n -> <br>, " " -> &nbsp
	  $memo_content = str_replace("\n", "<br>", $row[content]);
	  $memo_content = str_replace(" ", "&nbsp;", $memo_content);
?>		<!-- 메인 글의 번호, 닉네임, 작성일, 내용을 출력 -->
		<div id="memo_writer_title"> 
		<ul> 
		<li id="writer_title1"><?= $number ?></li>
		<li id="writer_title2"><?= $memo_nick ?></li>
		<li id="writer_title3"><?= $memo_date ?></li>
		<li id="writer_title4"> 
		      <? // $userid가 관리자나 작성자일 때만 [삭제]링크를 표시
					if($userid=="admin" || $userid==$memo_id)
			          echo "<a href='delete.php?num=$memo_num'>[삭제]</a>"; 
			  ?>
		</li>
		</ul>
		</div>
		<div id="memo_content"><?= $memo_content ?>
		</div>
		<div id="ripple"> 
			<div id="ripple1">덧글</div>
			<div id="ripple2">
<? // DB 테이블에서 parent 필드값이 낙서장 메인글 번호와 같은 덧글을 가져와 $ripple_result 에 저장한다.
   
	    $sql = "select * from memo_ripple where parent='$memo_num'";
	    $ripple_result = mysql_query($sql);
   // mysql_fetch_array 함수로 레코드에 저장된 덧글의 정보를 가져옴
   // 더 이상 가져올 레코드가 없을때까지 반복
		while ($row_ripple = mysql_fetch_array($ripple_result))
		{ // DB에서 가져온 정보를 각각에 해당하는 변수에 저장		  
			$ripple_num     = $row_ripple[num];
			$ripple_id      = $row_ripple[id];
			$ripple_nick    = $row_ripple[nick];
		  // 덧글의 내용은 행 바꿈과 공백을 HTML태그로 치환하여 저장
			$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
			$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
			$ripple_date    = $row_ripple[regist_day];
?>
				<div id="ripple_title">
				<ul> <!-- 덧글을 작성한 사람의 닉네임과 작성일 출력 -->
				<li><?= $ripple_nick ?> &nbsp;&nbsp;&nbsp; <?= $ripple_date ?></li>
				<li id="mdi_del">
					<? // 관리자와 덧글을 작성한 사람일 때만 덧글의 [삭제]링크 출력
						if($userid=="admin" || $userid==$ripple_id)
				            echo "<a href='delete_ripple.php?num=$ripple_num'>삭제</a>";
					?>
				</li>
				</ul>
				</div> <!-- 덧글의 내용 출력 -->
				<div id="ripple_content"> <?= $ripple_content ?></div>
<?
		}
?>
				<form  name="ripple_form" method="post" action="insert_ripple.php"> 
				<input type="hidden" name="num" value="<?= $memo_num ?>"> 
				<div id="ripple_insert">
				    <div id="ripple_textarea">
						<textarea rows="3" cols="80" name="ripple_content"></textarea>
					</div> <!-- 덧글에 입력된 내용이 데이터베이스 테이블 mem_ripple에 저장 -->
					<div id="ripple_button"><input type="image" src="../img/memo_ripple_button.png"></div>
				</div>
				</form>

			</div> <!-- end of ripple2 -->
  		    <div class="clear"></div>
			<div class="linespace_10"></div>
<?
		$number--;
	 }
	 mysql_close();
?> <!-- 페이지 표시 + 링크 연결 -->
			<div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp; 
<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   { // $i 가 현재 표싷하는 페이지인 $page와 같으면
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<b> $i </b>"; // 굵은 글씨로 페이지 번호 출력
		}
		else // 그렇지 않으면 해당 페이지 번호를 출력하고 링크를 연결
		{ 
			echo "<a href='memo.php?page=$i'> $i </a>";
		}      
   }
?>			
			&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶</div>
		 </div> <!-- end of ripple -->
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
