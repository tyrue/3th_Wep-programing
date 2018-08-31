<?
           session_start();
?>
<meta charset="euc-kr">
<?
   // 이전화면에서 이름이 입력되지 않았으면 "이름을 입력하세요"
   // 메시지 출력
   if(!$id) { // id 와 pass 가 입력되었는지 확인 후 비어있으면 경고창 출력
     echo("
           <script>
             window.alert('아이디를 입력하세요.')
             history.go(-1)
           </script>
         ");
         exit;
   }

   if(!$pass) {
     echo("
           <script>
             window.alert('비밀번호를 입력하세요.')
             history.go(-1)
           </script>
         ");
         exit;
   }

   include "../lib/dbconn.php"; // DB 접속

   $sql = "select * from member where id='$id'"; // 사용자가 입력한 아이디($id)를 가지는 레코드를 검색하는 명령을 입력
   $result = mysql_query($sql, $connect);        // mysql_num_rows() 함수를 실행하면 검색된 레코드가 배열 형태로 $$result에 저장
   $num_match = mysql_num_rows($result);         // $result에 저장된 레코드 개수를 mysql_num_rows() 함수를 이용하여 구한 다음 그 값을 $num_match에 저장

   if(!$num_match) // 해당 아이디가 데이터베이스의 member 테이블에 존쟇하지 않으면
   {
     echo("
           <script>
             window.alert('등록되지 않은 아이디입니다.')
             history.go(-1)
           </script>
         ");
    }
    else          // 해당 아이디가 존재하면
    {
        $row = mysql_fetch_array($result);  // 검색한 해당 아이디의 레코드 정보를 가져와 $row에 저장

        $db_pass = $row[pass];              // $row에서 pass 필드값을 가져와 $db_pass에 저장
        // 사용자가 입력한 비밀번호 $pass와 member 테이블에 저장된 비밀번호 $db_pass를 비교
        if($pass != $db_pass)               // 비밀번호가 다르면 경고창 출력
        {
           echo("
              <script>
                window.alert('비밀번호가 틀립니다.')
                history.go(-1)
              </script>
           ");

           exit;
        }
        else                                // 비밀번호가 같으면 
        {
           $userid = $row[id];              // 레코드 정보가 저장된 $row에서 id, name, nick, level 필드값을 가져와
		       $username = $row[name];          // 각각 $userid, $username, $usernick, $userlevel에 저장
		       $usernick = $row[nick];
		       $userlevel = $row[level];

           $_SESSION['userid'] = $userid;       // 세션 변수를 처리하는 데 사용되는 전역 변수 $_SESSION[]을 이용ㅎ하여 네 개의 세션을 등록
           $_SESSION['username'] = $username;   // 전역 변수로 등록하면, 다른 페이지에서 로그인 여부를 확읺할 수 있고 사용자 상태에 따라 보여주는 메뉴를 다르게 설정할 수 있음
           $_SESSION['usernick'] = $usernick;   // ex) $userid 값이 존재 - 로그인, $userid = NULL - 로그아웃
           $_SESSION['userlevel'] = $userlevel;

           // 메인 화면으로 이동, index.php는 현재 폴더인 login보다 상위에 위치하므로 ../ 을 사용해 상대 경로를 표시
           echo("
              <script>
                location.href = '../index.php';
              </script>
           ");
        }
   }          
?>
