<?
   include "../lib/dbconn.php";
   // 선택된 문항의 필드값에 1을 더하여 DB 테이블 survey에 업데이트
   // $composer = 설문조사 페이지에서 전달된 값이 입력
   $sql = "update survey set $composer = $composer + 1"; 
   mysql_query($sql, $connect);

   mysql_close();
   // 설문 결과를 보여줌, 새 창을 열었기 때문에 따로 창을 열지는 않음
   Header("location:result.php");
?>

