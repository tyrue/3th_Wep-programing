<html>
 <head>
  <title> �������� </title>
  <link rel="stylesheet" href="../css/survey.css" type="text/css">	
  <meta charset="euc-kr">
  <script>
      function update()
      {
        var vote; // ��ǥ��
        var length = document.survey_form.composer.length; // ���׼�
        // ���� ��ư�� ���õǾ� �ִ��� Ȯ��
        for (var i=0; i<length; i++) // ���� �� ��ŭ �ݺ�
        {
           if (document.survey_form.composer[i].checked == true)
           {  // ���õ� ���� ��ư�̶�� vote ���� ��ư�� value���� �Է��� �� ��������
                vote= document.survey_form.composer[i].value;
                break;
           }
           // �ϳ��� ������ �� �����Ƿ� ã���� ����� �ʿ䰡 ����
        }

        if (i == length) // ������ �������� ������ ���â ���
        {
           alert("������ �����ϼ���!");
           return;
        }
        // �� â�� ����, update.php ����
        // �� �� ������ ������ ����� vote���� update.php�� ���� $composer�� ����
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
  <!-- ���������Ϸ��� ������ ���� ���� ȭ�鿡 ǥ�����ִ� form  -->
  <form name=survey_form method=post > 
    <table border=0 cellspacing=0 cellpdding=0 width='200' align='center'>
      <input type=hidden name=kkk value=100>
        <tr height=40>
          <td><img src="../img/bbs_poll.gif"></td>
        </tr>
        <tr height=1 bgcolor=#cccccc><td></td></tr>
       <tr height=7><td></td></tr>
       <tr><td><b> �� ���� ¥������ ���ʹ�?</b></td></tr>
       <!-- �� ������ ������ �� �ִ� ���� ��ư�� �ش� ������ ȭ�鿡 ǥ�� -->
       <tr><td><input type=radio name='composer' value='ans1' >1. ũ����</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans2' >2. ������</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans3' >3. �Ź�</td></tr>
       <tr height=5><td></td></tr>
       <tr><td><input type=radio name='composer' value='ans4' >4. ���̷���</td></tr>
       <tr height=7><td></td></tr>
       <tr height=1 bgcolor=#cccccc><td></td></tr>
       <tr>
       <tr height=7><td></td></tr>
       <tr> <!-- ��ǥ�ϱ� Ŭ�� �� ��ư�� ����� �ڹٽ�ũ��Ʈ �Լ� update(7~29��)�� ���� -->
         <td align=middle><img src="../img/b_vote.gif" border="0"  style='cursor:hand' 
            onclick=update()></a>
            <!-- ������� -->
           <img src="../img/b_result.gif" border="0"  style='cursor:hand' 
               onclick=result()></a></td></tr>
    </table>
  </form>
</body>
</html>
