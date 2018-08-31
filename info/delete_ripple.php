<?
      include "../lib/dbconn.php";
      // 덧글의 일련번호를 이용하여 해당 레코드를 삭제
      $sql = "delete from info_ripple where num=$ripple_num";
      mysql_query($sql, $connect);
      mysql_close();
      // 글 내용 보기 페이지로 이동
      echo "
	   <script>
	    location.href = 'view.php?table=$table&num=$num';
	   </script>
	  ";
?>
