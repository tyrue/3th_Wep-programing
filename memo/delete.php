<?
   include "../lib/dbconn.php";
// �⺻Ű�� num �ʵ� ���� $num�� ���ڵ带 ����
// �⺻Ű�� �̿��� �����Ϸ��� ���αۿ� �ش��ϴ� ���ڵ带 ����
   $sql = "delete from memo where num = $num";
   mysql_query($sql, $connect);

   mysql_close();
// ������ �������� �̵�
   echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	";
?>

