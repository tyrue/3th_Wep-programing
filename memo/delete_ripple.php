<?
      include "../lib/dbconn.php";
// delete.php와 동일
      $sql = "delete from memo_ripple where num=$num";
      mysql_query($sql, $connect);
      mysql_close();

      echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	  ";
?>


