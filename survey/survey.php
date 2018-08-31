<html>
 <head>
  <title> 설문조사 </title>
  <link rel="stylesheet" href="../css/survey.css" type="text/css">	
  <meta charset="euc-kr">
  <script>
      function update()
      {
        var vote; // 투표값
        var length = document.survey_form.composer.length; // 문항수
        // 라디오 버튼이 선택되어 있는지 확인
        for (var i=0; i<length; i++) // 문항 수 만큼 반복
        {
           if (document.survey_form.composer[i].checked == true)
           {  // 선택된 라디오 버튼이라면 vote 라디오 버튼의 value값을 입력한 후 빠져나옴
                vote= document.survey_form.composer[i].value;
                break;
           }
           // 하나만 선택할 수 있으므로 찾으면 계속할 필요가 없음
        }

        if (i == length) // 문항을 선택하지 않으면 경고창 출력
        {
           alert("문항을 선택하세요!");
           return;
        }
        // 새 창을 열고, update.php 실행
        // 이 때 선택한 문항이 저장된 vote값을 update.php의 변수 $composer에 전달
        window.open("update.php?composer="+vote , "survey", 
              "left=230, top=250, width=230, height=250, status=no, scrollbars=no");
    }

  	  function result()
    {
         window.open("result.php" , "survey", 
              "left=230, top=250, width=230, height=250, status=no, scrollbars=no");
    }
</script>

 </head> 
<body>
  <!-- 설문조사하려는 질문과 문항 등을 화면에 표싷해주는 form  -->
  <form name=survey_form method=post > 
    <table border=0 cellspacing=0 cellpdding=0 width='200' align='center'>
      <input type=hidden name=kkk value=100>
        <tr height=40>
          <td><img src="../img/bbs_poll.gif"></td>
        </tr>
        <tr height=1 bgcolor=#cccccc><td></td></tr>
       <tr height=7><td></td></tr>
       <tr><td><b> ♬ 가장 짜증나는 몬스터는?</b></td></tr>
       <!-- 각 문항을 선택할 수 있는 라디오 버튼과 해당 문항을 화면에 표시 -->
       <tr><td><input type=radio name='composer' value='ans1' >1. 크리퍼</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans2' >2. 엔더맨</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans3' >3. 거미</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans4' >4. 스켈레톤</td></tr>
       <tr height=7><td></td></tr>
       <tr height=1 bgcolor=#cccccc><td></td></tr>
       <tr>
       <tr height=7><td></td></tr>
       <tr> <!-- 투표하기 클릭 시 버튼과 연결된 자바스크립트 함수 update(7~29행)가 실행 -->
         <td align=middle><img src="../img/b_vote.gif" border="0"  style='cursor:hand' 
            onclick=update()></a>
            <!-- 결과보기 -->
           <img src="../img/b_result.gif" border="0"  style='cursor:hand' 
               onclick=result()></a></td></tr>
    </table>
  </form>
</body>
</html>
