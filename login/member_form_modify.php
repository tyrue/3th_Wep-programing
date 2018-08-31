<?
    session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="euc-kr">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/member.css" rel="stylesheet" type="text/css" media="all">
<script>
   function check_id()
   {
     window.open("check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
   }

   function check_nick()
   {
     window.open("check_nick.php?nick=" + document.member_form.nick.value,
         "NICKcheck",
          "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
   }

   function check_input()
   {
      if (!document.member_form.pass.value)
      {
          alert("비밀번호를 입력하세요");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value)
      {
          alert("비밀번호확인을 입력하세요");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value)
      {
          alert("이름을 입력하세요");    
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.nick.value)
      {
          alert("닉네임을 입력하세요");    
          document.member_form.nick.focus();
          return;
      }

      if (!document.member_form.hp2.value || !document.member_form.hp3.value )
      {
          alert("휴대폰 번호를 입력하세요");    
          document.member_form.nick.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value)
      {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      document.member_form.submit();
   }

   function reset_form()
   {
      document.member_form.id.value = "";
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.nick.value = "";
      document.member_form.hp1.value = "010";
      document.member_form.hp2.value = "";
      document.member_form.hp3.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
	  
      document.member_form.id.focus();

      return;
   }
</script>
</head>
<?
    include "../lib/dbconn.php"; // DB 접속
    // 세션 변수 $userid(접속자 아이디)와 아이디가 일치하는 레코드의 정보를 가져와 $row에 저장
    $sql = "select * from member where id='$userid'";
    $result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);
    // explod() 함수(p.345), 휴대폰 번호 분리
    $hp = explode("-", $row[hp]);
    $hp1 = $hp[0];
    $hp2 = $hp[1];
    $hp3 = $hp[2];
    // 이메일 주소 분리
    $email = explode("@", $row[email]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysql_close(); // DB 접속 종료
?>
<body>
<div id="wrap">
  <? include "../lib/top_login2.php"; ?>
  <div><a href="../index.php"><img src="../img/top.png" border="0"></a></div>
  <div id="menu">
	<? include "../lib/top_menu2.php"; ?>    
  </div>  <!-- end of menu --> 
  
  <div id="content">
	<div id="col1">
		<div id="left_menu">
<?
			include "../lib/left_menu.php";
?>
		</div>
	</div> <!-- end of col1 -->

	<div id="col2">
        <form  name="member_form" method="post" action="modify.php"> 
		<div id="title">
			<img src="../img/title_member_modify.gif">
		</div>


		<div id="form_join">
			<div id="join1">
			<ul>
			<li>* 아이디</li>
			<li>* 비밀번호</li>
			<li>* 비밀번호 확인</li>
			<li>* 이름</li>
			<li>* 닉네임</li>
			<li>* 휴대폰</li>
			<li>&nbsp;&nbsp;&nbsp;이메일</li>
			</ul>
			</div>
			<div id="join2"><ul>
            <!-- DB에서 가져온 기존 내용을 <input>태그의 value값에 입력 -->
			<li><?= $row[id] ?></li>
			<li><input type="password" name="pass" value="<?= $row[pass] ?>"></li>
			<li><input type="password" name="pass_confirm" value="<?= $row[pass] ?>"></li>
			<li><input type="text" name="name" value="<?= $row[name] ?>"></li>
			<li><div id="nick1"><input type="text" name="nick" value="<?= $row[nick] ?>"></div><div id="nick2" ><a href="#"><img src="../img/check_id.gif" onclick="check_nick()"></a></div></li>
			<li><input type="text" class="hp" name="hp1" value="<?= $hp1 ?>"> 
             - <input type="text" class="hp" name="hp2" value="<?= $hp2 ?>"> - <input type="text" class="hp" name="hp3" value="<?= $hp3 ?>"></li>
			<li><input type="text" id="email1" name="email1" value="<?= $email1 ?>"> @ <input type="text" name="email2" 
			           value="<?= $email2 ?>"></li>
			</ul>
			</div>
			<div class="clear"></div>
			<div id="must"> * 는 필수 입력항목입니다.^^</div>
		</div>
        <!-- 저장하기 클릭 시 132행 action속성에 명시된 modify.php로 이동 -->
        <!-- modify.php가 시랳ㅇ되면서 해당 레코드 정보를 수정된 회원정보로 업데이트 -->
		<div id="button"><a href="#"><img src="../img/button_save.gif"  onclick="check_input()"></a>&nbsp;&nbsp;
		                 <a href="#"><img src="../img/button_reset.gif" onclick="reset_form()"></a>
		</div>
	    </form>
	</div>
  </div>
</div>

</body>
</html>
