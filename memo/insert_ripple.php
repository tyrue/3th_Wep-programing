<?
   session_start();
?>
<meta charset="euc-kr">
<?
   if(!$userid) {
     echo("
	   <script>
	     window.alert('�α��� �� �̿��ϼ���.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }
   
   if(!$ripple_content) {
     echo("
	   <script>
	     window.alert('������ �Է��ϼ���.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }
   
   include "../lib/dbconn.php";       // dconn.php ������ �ҷ���

   $sql = "select * from member where id='$userid'";
   $result = mysql_query($sql, $connect);
   $row = mysql_fetch_array($result);

   $name = $row[name];
   $nick = $row[nick];

   $regist_day = date("Y-m-d (H:i)");  // ������ '��-��-��-��-��'�� ����

   // ���ڵ� ���� ���
   // parent �ʵ忡 $num�� ����, $num���� ������ �޸� ���α��� �Ϸù�ȣ�� ����Ǿ� ����
   $sql = "insert into memo_ripple (parent, id, name, nick, content, regist_day) ";
   $sql .= "values($num, '$userid', '$name', '$nick', '$ripple_content', '$regist_day')";    
   
   mysql_query($sql, $connect);  // $sql �� ����� ��� ����

   mysql_close();                // DB ���� ����
   
   echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	";
?>

   
