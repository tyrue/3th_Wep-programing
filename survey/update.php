<?
   include "../lib/dbconn.php";
   // ���õ� ������ �ʵ尪�� 1�� ���Ͽ� DB ���̺� survey�� ������Ʈ
   // $composer = �������� ���������� ���޵� ���� �Է�
   $sql = "update survey set $composer = $composer + 1"; 
   mysql_query($sql, $connect);

   mysql_close();
   // ���� ����� ������, �� â�� ������ ������ ���� â�� ������ ����
   Header("location:result.php");
?>

