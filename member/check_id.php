<meta charset="euc-kr">
<?
   if(!$id) 
   {
      echo("���̵� �Է��ϼ���.");
   }
   else
   {
      include "../lib/dbconn.php";
 
      $sql = "select * from member where id='$id' ";

      $result = mysql_query($sql, $connect);
      $num_record = mysql_num_rows($result);

      if ($num_record)
      {
         echo "���̵� �ߺ��˴ϴ�!<br>";
         echo "�ٸ� ���̵� ����ϼ���.<br>";
      }
      else
      {
         echo "��밡���� ���̵��Դϴ�.";
      }
    
      mysql_close();
   }
?>

