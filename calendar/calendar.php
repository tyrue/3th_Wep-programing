<? 
include('./lib/dbconn.php');
if(!$year_cal)
{
 $year_cal = date("Y");
}
if(!$month_cal)
{
 $month_cal = date("m");
}
if(!$day_cal)
{
 $day_cal = date("j");
}
$next_year = date("Y",strtotime($year_cal."-".$month_cal."-".$day_cal."+1 year"));
$prev_year = date("Y",strtotime($year_cal."-".$month_cal."-".$day_cal."-1 year"));

$time = strtotime($year_cal.'-'.$month_cal.'-01'); 
list($tday, $sweek) = explode('-', date('t-w', $time));  // �� �ϼ�, ���ۿ��� 
$tweek = ceil(($tday + $sweek) / 7);  // �� ���� 
$lweek = date('w', strtotime($year_cal.'-'.$month_cal.'-'.$tday));  // ���������� 

$holiday_array = array
     (
      "1"=>array("1"=>"����", "22"=>"����", "23"=>"����", "24"=>"����"),
      "2"=>array(),
      "3"=>array("1"=>"������"),
      "4"=>array("5"=>"�ĸ���"),
      "5"=>array("5"=>"��̳�", "28"=>"����ź����"),
      "6"=>array("6"=>"������"),
      "7"=>array(),
      "8"=>array("15"=>"������"),
      "9"=>array("29"=>"�߼�", "30"=>"�߼�"),
      "10"=>array("1"=>"�߼�", "3"=>"��õ��"),
      "11"=>array(),
      "12"=>array("25"=>"��ź��")
     );

?>
<html>
<head><title>::WELLSTUDY::</title>
<link rel="stylesheet" type="text/css" href="../bbs_file/style.css">
</head>
<body topmargin=0>
<table cellpadding=0 cellspacing=0 width="0" align=left border=0 height="0">
<tr><td>
<!--����-->
<table cellpadding=5 cellspacing=0 width="0" align=center height="0">
<tr>

 <td align=center><font style="text-decoration:none;font-size:12px;font-weight:bold"><?=$year_cal?>�� <?=$month_cal?>��</font></td>

</tr>

</table>
</td></tr>
<tr height=2><td></td></tr>
<tr><td>
<!--����-->
<table width='15' cellpadding='3' cellspacing='1' border='0' align=center height="15"> 
 <tr> 
 <th align=center bgcolor="#7abae4">��</th> 
 <th align=center bgcolor="#7abae4">��</th> 
 <th align=center bgcolor="#7abae4">ȭ</th> 
 <th align=center bgcolor="#7abae4">��</th> 
 <th align=center bgcolor="#7abae4">��</th> 
 <th align=center bgcolor="#7abae4">��</th> 
 <th align=center bgcolor="#7abae4">��</th> 
 </tr> 

 <? for ($n=1,$i=0; $i<$tweek; $i++) { ?> 
 <tr> 


  <? for ($k=0; $k<7; $k++) { ?> 

  <td align=center style="border:solid 1px #7abae4"> 
   <?
   if ($k =="0") //�Ͽ���
   {
   $color="red";
   }
   elseif ($k =="6") //�����
   {
   $color="blue";
   }
   else // ����
   {
   $color="black";
   }
   ?>
   <? if (!(($i == 0 && $k < $sweek) || ($i == $tweek-1 && $k > $lweek))) { ?> 
    <?
    if ($n==date("d")) //����
    {
    $color="orange";
    }
    ?>
	<? if($year_cal==2012 && $holiday_array[(int)$month_cal][$n]) $color=red; ?>
     <font color="<?=$color?>"><?=$n?></font>
    <?
    $n++
    ?>

    <? } //if?> 
  <br><!--tdä���-->

  </td> 
  <? } //for?> 

 </tr> 
 <? } //for?> 
 
</table> 
<br>
<html><head>
<script type="text/javascript">
function realtimeClock() {
  document.rtcForm.rtcInput.value = getTimeStamp();
  setTimeout("realtimeClock()", 1000);
}

function getTimeStamp() { // 24�ð���
  var d = new Date();
  var s =
    leadingZeros(d.getFullYear(), 4) + '-' +
    leadingZeros(d.getMonth() + 1, 2) + '-' +
    leadingZeros(d.getDate(), 2) + ' ' +
    leadingZeros(d.getHours(), 2) + ':' +
    leadingZeros(d.getMinutes(), 2) + ':' +
    leadingZeros(d.getSeconds(), 2);
  return s;
}

function leadingZeros(n, digits) {
  var zero = '';
  n = n.toString();
  if (n.length < digits) {
    for (i = 0; i < digits - n.length; i++)
      zero += '0';
  }
  return zero + n;
}

</script></head>
<body onload="realtimeClock()">
<form name="rtcForm">
<input type="text" name="rtcInput" size="22" readonly="readonly"/>
</form></body></html>
<br>
<? include "./counter/counter.php"; ?>

</td></tr>
</table>

</body>
</html>