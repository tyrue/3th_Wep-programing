<? 
	session_start(); 
	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);
    $row = mysql_fetch_array($result);       
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];
	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i]) 
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			if ($image_width[$i] > 785)
				$image_width[$i] = 785;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}
	$new_hit = $item_hit + 1;
	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="euc-kr">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board4.css" rel="stylesheet" type="text/css" media="all">
<script>
	function check_input()
	{
		if (!document.ripple_form.ripple_content.value)
		{
			alert("내용을 입력하세요!");    
			document.ripple_form.ripple_content.focus();
			return;
		}
		document.ripple_form.submit();
    }

    function del(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }
</script>
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
			<img src="../img/title_greet.gif">
		</div>

		<div id="view_comment"> &nbsp;</div>
		<div id="view_title">
			<div id="view_title1"><?= $item_subject ?></div><div id="view_title2"><?= $item_nick ?> | 조회 : <?= $item_hit ?>  
			                      | <?= $item_date ?> </div>	
		</div>

		<div id="view_content">
<?
	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i])
		{
			$img_name = $image_copied[$i];
			$img_name = "./data/".$img_name;
			$img_width = $image_width[$i];
			
			echo "<img src='$img_name' width='$img_width'>"."<br><br>";
		}
	}
?>
			<?= $item_content ?>
		</div>

		<div id="ripple">
<?		// [삭제] 링크와 더불어 덧글의 내용, 작성일 등을 화면에 표시
		// parent 필드값이 메인글의 레코드 일련번호($item_num)와 동일한 레코드를 검색하여
		// 변수 $rippe_num 에 저장
	    $sql = "select * from greet_ripple where parent='$item_num'";
	    $ripple_result = mysql_query($sql);
		// 검색된 덧글이 저장된 $ripple_result에서 mysql_fetch_array() 함수를 통해 데이터를 가져옴
		// 저장된 덧글의 개수만큼 반복하여 덧글을 하나씩 화면에 출력
		while ($row_ripple = mysql_fetch_array($ripple_result))
		{	// 배열 형태로 가져온 데이터를 각각의 변수에 저장
			$ripple_num     = $row_ripple[num];
			$ripple_id      = $row_ripple[id];
			$ripple_nick    = $row_ripple[nick];
			$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
			$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
			$ripple_date    = $row_ripple[regist_day];
?>
			<div id="ripple_writer_title"> <!-- DB에서 가져온 정보를 화면에 표시 -->
			<ul>
			<li id="writer_title1"><?=$ripple_nick?></li>
			<li id="writer_title2"><?=$ripple_date?></li>
			<li id="writer_title3">			
		      <? // 관리자이거나 덧글의 작성자인 경우 [삭제] 링크를 덧글 옆에 표시
			  	 // 클릭 시 delete_ripple.php 로 연결
					if($userid=="admin" || $userid==$ripple_id)
			          echo "<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>[삭제]</a>"; 
			  ?>
			</li>
			</ul>
			</div>
			<div id="ripple_content"><?=$ripple_content?></div>
			<div class="hor_line_ripple"></div>
<?			
		}
?>			<!-- 덧글을 입력하는 부분과 <덧글쓰기> 버튼 -->
			<form  name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">  
			<div id="ripple_box">
				<div id="ripple_box1"><img src="../img/title_comment.gif"></div>
				<div id="ripple_box2"><textarea rows="5" cols="65" name="ripple_content"></textarea>
				</div>
			<!-- <덧글쓰기> 클릭 시 내용을 입력했는지 확인(63~72행) -->
				<div id="ripple_box3"><a href="#"><img src="../img/ok_ripple.gif"  onclick="check_input()"></a></div>
			</div>
			</form>
		</div> <!-- end of ripple -->

		<div id="view_button">
				<a href="list.php?table=<?=$table?>&page=<?=$page?>"><img src="../img/list.png"></a>&nbsp;
<? 
	if($userid && ($userid==$item_id))
	{
?>
				<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>"><img src="../img/modify.png"></a>&nbsp;
				<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')"><img src="../img/delete.png"></a>&nbsp;
<?
	}
?>
<? 
	if($userid)
	{
?>
				<a href="write_form.php?table=<?=$table?>"><img src="../img/write.png"></a>
<?
	}
?>
		</div>
		<div class="clear"></div>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
