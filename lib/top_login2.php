<div id="top_login">
<?
    if(!$userid)
	{
?>
          <a href="../login/login_form.php">�α���</a> | <a href="../member/member_form.php">ȸ������</a>
<?
	}
	else
	{
?>
		<?=$usernick?> | 
		<a href="../login/logout.php">�α׾ƿ�</a> | <a href="../login/member_form_modify.php">��������</a>
<?
	}
?>
	 </div>
