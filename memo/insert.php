<? session_start(); ?>
<meta charset="euc-kr">
<? // 로그인 시 실행되는 세션 변수 $userid가 NULL 일 경우 경고창을 띄우고 이전 페이지로 이동
	if(!$userid) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}
// 글을 입력하지 않으면 경고창 출력 후 이전 페이지로 이동
	if(!$content) {
		echo("
	   <script>
	     window.alert('내용을 입력하세요.')
	     history.go(-1)
	   </script>
		");
	 exit;
	}

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	include "../lib/dbconn.php";       // dconn.php 파일을 불러옴
// 아이디에 해당되는 정보를 DB에서 가져와 이름과 닉네임 가져오기
    $sql = "select * from member where id='$userid'";
    $result = mysql_query($sql, $connect);
	$row = mysql_fetch_array($result);
	$name = $row[name];
	$nick = $row[nick];
// 메인글과 관련된 정보를 insert 명령을 사용하여 DB에 저장
	$sql = "insert into memo (id, name, nick, content, regist_day) ";
	$sql .= "values('$userid', '$name', '$nick', '$content', '$regist_day')";

	mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

	mysql_close();                // DB 연결 끊기
// 낙서장 페이지로 이동
	echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	";
?>

  
