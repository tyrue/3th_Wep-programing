<?
   function latest_article($table, $loop, $char_limit) 
   {
		include "dbconn.php";
		// DB ���̺��� ���ڵ带 �Ϸù�ȣ�� �������� �������� ����
		// limit �ɼ��� �̿��Ͽ� ǥ���� �� �ִ� �ֱ� ���� ����($loop)��ŭ 
		// ��ϵ� ���� ������ $result�� ����
		$sql = "select * from $table order by num desc limit $loop";
		$result = mysql_query($sql, $connect);
// �ֱٿ� �ۼ��� ���� ������ mysql_fetch_array() �Լ��� ���� ������ ����ȭ�鿡 ���
		while ($row = mysql_fetch_array($result))
		{	
			$num = $row[num]; // ���ڵ��� �Ϸ� ��ȣ
			$len_subject = strlen($row[subject]); // �� ������ ���̸� ����
			$subject = $row[subject]; // ����
			// �� ������ ���ڼ��� ǥ���� �� �ִ� �ִ� ���ڼ����� ũ��
			if ($len_subject > $char_limit)
			{   // �ʰ��� ���ڸ� ������ �� $subject�� ����
				$subject = mb_substr($row[subject], 0, $char_limit, 'euc-kr');
				// �� �� ���ڿ� ���� �����ڷ� $subject�� ...�� ����
				$subject = $subject."...";
			}			
			
			$regist_day = substr($row[regist_day], 0, 10);
			// �� ������ ���� ȭ�鿡 ǥ��
			// �� ������ Ŭ���ϸ� �ش� �Խù��� �� ���� ���� �������� �̵��ϵ��� ����
			echo "      
				<div class='col1'><a href='./$table/view.php?table=$table&num=$num'>$subject</a></div>"; 
				if(time() - strtotime($regist_day) <= 60 * 60 * 24 * 2){
		    echo "<img src='./img/n.png'/>";
			}				
				echo" <div class='col2'>$regist_day</div>	<div class='clear'></div>";
		}		
		mysql_close();
   }
?>