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

	$file_name[0]   = $row[file_name_0];
	$file_name[1]   = $row[file_name_1];
	$file_name[2]   = $row[file_name_2];

	$file_type[0]   = $row[file_type_0];
	$file_type[1]   = $row[file_type_1];
	$file_type[2]   = $row[file_type_2];

	$file_copied[0] = $row[file_copied_0];
	$file_copied[1] = $row[file_copied_1];
	$file_copied[2] = $row[file_copied_2];

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
		if ($file_copied[$i]) 
		{
			$fileinfo = GetImageSize("./data/".$file_copied[$i]);
			$file_width[$i] = $fileinfo[0];
			$file_height[$i] = $fileinfo[1];
			$file_type[$i]  = $fileinfo[2];

			if ($file_width[$i] > 785)
				$file_width[$i] = 785;
		}
		else
		{
			$file_width[$i] = "";
			$file_height[$i] = "";
			$file_type[$i]  = "";
		}
	}
	$new_hit = $item_hit + 1;
	$sql = "update $table set hit=$new_hit where num=$num";   // �� ��ȸ�� ������Ŵ
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
			alert("������ �Է��ϼ���!");    
			document.ripple_form.ripple_content.focus();
			return;
		}
		document.ripple_form.submit();
    }

    function del(href) 
    {
        if(confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n���� �����Ͻðڽ��ϱ�?")) {
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
			<img src="../img/title_download.gif">
		</div>

		<div id="view_comment"> &nbsp;</div>
		<div id="view_title">
			<div id="view_title1"><?= $item_subject ?></div><div id="view_title2"><?= $item_nick ?> | ��ȸ : <?= $item_hit ?>  
			                      | <?= $item_date ?> </div>	
		</div>

		<div id="view_content">
<?
	for ($i=0; $i<3; $i++)
	{		
		if ($userid && $file_copied[$i])
		{
			$show_name = $file_name[$i];
			$real_name = $file_copied[$i];
			$real_type = $file_type[$i];
			$file_path = "./data/".$real_name;
			$file_size = filesize($file_path);

			echo "�� ÷������ : $show_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       <a href='download.php?table=$table&num=$num&real_name=$real_name&show_name=$show_name&file_type=$real_type'>[����]</a><br>";
		}

		if ($file_copied[$i])
		{
			$f_name = $file_copied[$i];
			$f_name = "./data/".$f_name;
			$f_width = $file_width[$i];
			
			echo "<img src='$f_name' width='$f_width'>"."<br><br>";
		}		
	}	
?>
			<?= $item_content ?>
		</div>

		<div id="ripple">
<?		// [����] ��ũ�� ���Ҿ� ������ ����, �ۼ��� ���� ȭ�鿡 ǥ��
		// parent �ʵ尪�� ���α��� ���ڵ� �Ϸù�ȣ($item_num)�� ������ ���ڵ带 �˻��Ͽ�
		// ���� $rippe_num �� ����
	    $sql = "select * from down_ripple where parent='$item_num'";
	    $ripple_result = mysql_query($sql);
		// �˻��� ������ ����� $ripple_result���� mysql_fetch_array() �Լ��� ���� �����͸� ������
		// ����� ������ ������ŭ �ݺ��Ͽ� ������ �ϳ��� ȭ�鿡 ���
		while ($row_ripple = mysql_fetch_array($ripple_result))
		{	// �迭 ���·� ������ �����͸� ������ ������ ����
			$ripple_num     = $row_ripple[num];
			$ripple_id      = $row_ripple[id];
			$ripple_nick    = $row_ripple[nick];
			$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
			$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
			$ripple_date    = $row_ripple[regist_day];
?>
			<div id="ripple_writer_title"> <!-- DB���� ������ ������ ȭ�鿡 ǥ�� -->
			<ul>
			<li id="writer_title1"><?=$ripple_nick?></li>
			<li id="writer_title2"><?=$ripple_date?></li>
			<li id="writer_title3">			
		      <? // �������̰ų� ������ �ۼ����� ��� [����] ��ũ�� ���� ���� ǥ��
			  	 // Ŭ�� �� delete_ripple.php �� ����
					if($userid=="admin" || $userid==$ripple_id)
			          echo "<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>[����]</a>"; 
			  ?>
			</li>
			</ul>
			</div>
			<div id="ripple_content"><?=$ripple_content?></div>
			<div class="hor_line_ripple"></div>
<?			
		}
?>			<!-- ������ �Է��ϴ� �κа� <���۾���> ��ư -->
			<form  name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">  
			<div id="ripple_box">
				<div id="ripple_box1"><img src="../img/title_comment.gif"></div>
				<div id="ripple_box2"><textarea rows="5" cols="65" name="ripple_content"></textarea>
				</div>
			<!-- <���۾���> Ŭ�� �� ������ �Է��ߴ��� Ȯ��(63~72��) -->
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