<? session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="euc-kr">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/member.css" rel="stylesheet" type="text/css" media="all">
</head>

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
        <form  name="member_form" method="post" action="login.php">  <!-- 로그인 페이지를 구성하는 form, <로그인>을 클릭하면 30행의 action에 명시된 login.php가 실행된다. -->
		<div id="title">
			<img src="../img/title_login.gif">
		</div>
       
		<div id="login_form">
		     <img id="login_msg" src="../img/login_msg.gif">
			 <div class="clear"></div>

			 <div id="login1">
				<img src="../img/login1.png">
			 </div>
			 <div id="login2">
				<div id="id_input_button">
					<div id="id_pw_title">
						<ul>
						<li><img src="../img/id_title.gif"></li>
						<li><img src="../img/pw_title.gif"></li>
						</ul>
					</div>
					<div id="id_pw_input">
						<ul>
						<li><input type="text" name="id" class="login_input"></li>				<!-- 로그인 페이지에서 사용자가 입력한 아이디와 비밀벊홓는 login.php로 전달 -->
						<li><input type="password" name="pass" class="login_input"></li>  <!-- <input> 태그의 name 속성값에 해당하는 $id, $pass로 저장된다. -->
						</ul>						
					</div>
					<div id="login_button">
						<input type="image" src="../img/login_button.gif">
					</div>
				</div>
				<div class="clear"></div>

				<div id="login_line"></div>
				<div id="join_button"><img src="../img/no_join.gif">&nbsp;&nbsp;&nbsp;&nbsp;<a href="../member/member_form.php"><img src="../img/join_button.gif"></a></div>
				<!-- 버튼 클릭 시 회원가입 페이지로 이동  -->
			 </div>			 
		</div> <!-- end of form_login -->

	    </form>
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>