<?
  session_start();
  unset($_SESSION['userid']);     // 저장한 세션 변수를 삭제
  unset($_SESSION['username']);
  unset($_SESSION['usernick']);
  unset($_SESSION['userlevel']);
  // 메인화면으로 이동
  echo("
       <script>
          location.href = '../index.php'; 
         </script>
       ");
?>
