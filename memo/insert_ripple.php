<?
   session_start();
?>
<meta charset="euc-kr">
<?
   if(!$userid) {
     echo("
	   <script>
	     window.alert('로그인 후 이용하세요.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }
   
   if(!$ripple_content) {
     echo("
	   <script>
	     window.alert('내용을 입력하세요.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }
   
   include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

   $sql = "select * from member where id='$userid'";
   $result = mysql_query($sql, $connect);
   $row = mysql_fetch_array($result);

   $name = $row[name];
   $nick = $row[nick];

   $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

   // 레코드 삽입 명령
   // parent 필드에 $num을 저장, $num에는 덧글이 달린 메인글의 일련번호가 저장되어 있음
   $sql = "insert into memo_ripple (parent, id, name, nick, content, regist_day) ";
   $sql .= "values($num, '$userid', '$name', '$nick', '$ripple_content', '$regist_day')";    
   
   mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

   mysql_close();                // DB 연결 끊기
   
   echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	";
?>

   
