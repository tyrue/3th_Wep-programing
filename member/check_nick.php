<meta charset="euc-kr">
<?
   if(!$nick) 
   {
      echo("�г����� �Է��ϼ���.");
   }
   else
   {
      include "../lib/dbconn.php";
 
      $sql = "select * from member where nick='$nick' ";

      $result = mysql_query($sql, $connect);
      $num_record = mysql_num_rows($result);

      if ($num_record)
      {
         echo "�г����� �ߺ��˴ϴ�.<br>";
         echo "�ٸ� �г����� ����ϼ���.<br>";
      }
      else
      {
         echo "��밡���� �г����Դϴ�.";
      }
    
      mysql_close();
   }
?>

