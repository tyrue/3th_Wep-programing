<?
           session_start();
?>
<meta charset="euc-kr">
<?
   // ����ȭ�鿡�� �̸��� �Էµ��� �ʾ����� "�̸��� �Է��ϼ���"
   // �޽��� ���
   if(!$id) { // id �� pass �� �ԷµǾ����� Ȯ�� �� ��������� ���â ���
     echo("
           <script>
             window.alert('���̵� �Է��ϼ���.')
             history.go(-1)
           </script>
         ");
         exit;
   }

   if(!$pass) {
     echo("
           <script>
             window.alert('��й�ȣ�� �Է��ϼ���.')
             history.go(-1)
           </script>
         ");
         exit;
   }

   include "../lib/dbconn.php"; // DB ����

   $sql = "select * from member where id='$id'"; // ����ڰ� �Է��� ���̵�($id)�� ������ ���ڵ带 �˻��ϴ� ����� �Է�
   $result = mysql_query($sql, $connect);        // mysql_num_rows() �Լ��� �����ϸ� �˻��� ���ڵ尡 �迭 ���·� $$result�� ����
   $num_match = mysql_num_rows($result);         // $result�� ����� ���ڵ� ������ mysql_num_rows() �Լ��� �̿��Ͽ� ���� ���� �� ���� $num_match�� ����

   if(!$num_match) // �ش� ���̵� �����ͺ��̽��� member ���̺� ���K���� ������
   {
     echo("
           <script>
             window.alert('��ϵ��� ���� ���̵��Դϴ�.')
             history.go(-1)
           </script>
         ");
    }
    else          // �ش� ���̵� �����ϸ�
    {
        $row = mysql_fetch_array($result);  // �˻��� �ش� ���̵��� ���ڵ� ������ ������ $row�� ����

        $db_pass = $row[pass];              // $row���� pass �ʵ尪�� ������ $db_pass�� ����
        // ����ڰ� �Է��� ��й�ȣ $pass�� member ���̺� ����� ��й�ȣ $db_pass�� ��
        if($pass != $db_pass)               // ��й�ȣ�� �ٸ��� ���â ���
        {
           echo("
              <script>
                window.alert('��й�ȣ�� Ʋ���ϴ�.')
                history.go(-1)
              </script>
           ");

           exit;
        }
        else                                // ��й�ȣ�� ������ 
        {
           $userid = $row[id];              // ���ڵ� ������ ����� $row���� id, name, nick, level �ʵ尪�� ������
		       $username = $row[name];          // ���� $userid, $username, $usernick, $userlevel�� ����
		       $usernick = $row[nick];
		       $userlevel = $row[level];

           $_SESSION['userid'] = $userid;       // ���� ������ ó���ϴ� �� ���Ǵ� ���� ���� $_SESSION[]�� �̿뤾�Ͽ� �� ���� ������ ���
           $_SESSION['username'] = $username;   // ���� ������ ����ϸ�, �ٸ� ���������� �α��� ���θ� Ȯ���� �� �ְ� ����� ���¿� ���� �����ִ� �޴��� �ٸ��� ������ �� ����
           $_SESSION['usernick'] = $usernick;   // ex) $userid ���� ���� - �α���, $userid = NULL - �α׾ƿ�
           $_SESSION['userlevel'] = $userlevel;

           // ���� ȭ������ �̵�, index.php�� ���� ������ login���� ������ ��ġ�ϹǷ� ../ �� ����� ��� ��θ� ǥ��
           echo("
              <script>
                location.href = '../index.php';
              </script>
           ");
        }
   }          
?>
