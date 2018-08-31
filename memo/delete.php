<?
   include "../lib/dbconn.php";
// 기본키인 num 필드 값이 $num인 레코드를 삭제
// 기본키를 이용해 삭제하려는 메인글에 해당하는 레코드를 삭제
   $sql = "delete from memo where num = $num";
   mysql_query($sql, $connect);

   mysql_close();
// 낙서장 페이지로 이동
   echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	";
?>

