<? 	
	session_start(); 
	
	$scale=5;			// �� ȭ�鿡 ǥ�õǴ� �� ��
	include "../lib/dbconn.php";

	$sql = "select * from memo order by num desc";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // ��ü �� ��

	// ��ü ������ ��($total_page) ��� 
	// ��ü ���ڵ��� ������ �� �������� ǥ���� �� �ִ� ���� ������ �������� ��
	// �������� ������ ���� ��ü ������
	if ($total_record % $scale == 0) 
		$total_page = floor($total_record/$scale);	//  floor() = �Ҽ��� ���ϸ� ����
	// �������� ������ �� + 1�� ��ü ������
	else
		$total_page = floor($total_record/$scale) + 1;
 
	if (!$page)                 // ��������ȣ($page)�� 0 �� ��
		$page = 1;              // ������ ��ȣ�� 1�� �ʱ�ȭ
 
	// ǥ���� ������($page)�� ���� $start ���  
	$start = ($page - 1) * $scale;      
	// �� ��ȣ ���
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
			<div id="memo_writer"><span >�� <?= $usernick ?></span></div>
			<div id="memo1"><textarea rows="6" cols="95" name="content"></textarea></div>
			<!-- �޸��ϱ� Ŭ�� �� 60�� form�� action �Ӽ��� ��õ� insert.php�� ���� -->
			<!-- �����忡 �Էµ� ������ �����ͺ��̽� ���̺� memo�� ���� -->
			<div id="memo2"><input type="image" src="../img/memo_button.gif"></div>
		</form>	
		</div> <!-- end of memo_row1 -->
<?		
	// ���� �������� ������ �۰� �� �ۿ� ���� ������ ���(p.370)
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {  // mysql_data_seek = ��ü ���ڵ�($result) �߿� Ư�� ����($start)�� �ش��ϴ� ���ڵ带 ����Ű�� �Լ�
      mysql_data_seek($result, $i);       
      $row = mysql_fetch_array($result);       
	  
	  $memo_id      = $row[id];
	  $memo_num     = $row[num];
      $memo_date    = $row[regist_day];
	  $memo_nick    = $row[nick];
	  // ���α� ����($row[content])�� �� �ٲް� ������ HTML �±׷� ����
	  // \n -> <br>, " " -> &nbsp
	  $memo_content = str_replace("\n", "<br>", $row[content]);
	  $memo_content = str_replace(" ", "&nbsp;", $memo_content);
?>		<!-- ���� ���� ��ȣ, �г���, �ۼ���, ������ ��� -->
		<div id="memo_writer_title"> 
		<ul> 
		<li id="writer_title1"><?= $number ?></li>
		<li id="writer_title2"><?= $memo_nick ?></li>
		<li id="writer_title3"><?= $memo_date ?></li>
		<li id="writer_title4"> 
		      <? // $userid�� �����ڳ� �ۼ����� ���� [����]��ũ�� ǥ��
					if($userid=="admin" || $userid==$memo_id)
			          echo "<a href='delete.php?num=$memo_num'>[����]</a>"; 
			  ?>
		</li>
		</ul>
		</div>
		<div id="memo_content"><?= $memo_content ?>
		</div>
		<div id="ripple"> 
			<div id="ripple1">����</div>
			<div id="ripple2">
<? // DB ���̺��� parent �ʵ尪�� ������ ���α� ��ȣ�� ���� ������ ������ $ripple_result �� �����Ѵ�.
   
	    $sql = "select * from memo_ripple where parent='$memo_num'";
	    $ripple_result = mysql_query($sql);
   // mysql_fetch_array �Լ��� ���ڵ忡 ����� ������ ������ ������
   // �� �̻� ������ ���ڵ尡 ���������� �ݺ�
		while ($row_ripple = mysql_fetch_array($ripple_result))
		{ // DB���� ������ ������ ������ �ش��ϴ� ������ ����		  
			$ripple_num     = $row_ripple[num];
			$ripple_id      = $row_ripple[id];
			$ripple_nick    = $row_ripple[nick];
		  // ������ ������ �� �ٲް� ������ HTML�±׷� ġȯ�Ͽ� ����
			$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
			$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
			$ripple_date    = $row_ripple[regist_day];
?>
				<div id="ripple_title">
				<ul> <!-- ������ �ۼ��� ����� �г��Ӱ� �ۼ��� ��� -->
				<li><?= $ripple_nick ?> &nbsp;&nbsp;&nbsp; <?= $ripple_date ?></li>
				<li id="mdi_del">
					<? // �����ڿ� ������ �ۼ��� ����� ���� ������ [����]��ũ ���
						if($userid=="admin" || $userid==$ripple_id)
				            echo "<a href='delete_ripple.php?num=$ripple_num'>����</a>";
					?>
				</li>
				</ul>
				</div> <!-- ������ ���� ��� -->
				<div id="ripple_content"> <?= $ripple_content ?></div>
<?
		}
?>
				<form  name="ripple_form" method="post" action="insert_ripple.php"> 
				<input type="hidden" name="num" value="<?= $memo_num ?>"> 
				<div id="ripple_insert">
				    <div id="ripple_textarea">
						<textarea rows="3" cols="80" name="ripple_content"></textarea>
					</div> <!-- ���ۿ� �Էµ� ������ �����ͺ��̽� ���̺� mem_ripple�� ���� -->
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
?> <!-- ������ ǥ�� + ��ũ ���� -->
			<div id="page_num"> �� ���� &nbsp;&nbsp;&nbsp;&nbsp; 
<?
   // �Խ��� ��� �ϴܿ� ������ ��ũ ��ȣ ���
   for ($i=1; $i<=$total_page; $i++)
   { // $i �� ���� ǥ���ϴ� �������� $page�� ������
		if ($page == $i)     // ���� ������ ��ȣ ��ũ ����
		{
			echo "<b> $i </b>"; // ���� �۾��� ������ ��ȣ ���
		}
		else // �׷��� ������ �ش� ������ ��ȣ�� ����ϰ� ��ũ�� ����
		{ 
			echo "<a href='memo.php?page=$i'> $i </a>";
		}      
   }
?>			
			&nbsp;&nbsp;&nbsp;&nbsp;���� ��</div>
		 </div> <!-- end of ripple -->
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
