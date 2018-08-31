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
list($tday, $sweek) = explode('-', date('t-w', $time));  // 총 일수, 시작요일 
$tweek = ceil(($tday + $sweek) / 7);  // 총 주차 
$lweek = date('w', strtotime($year_cal.'-'.$month_cal.'-'.$tday));  // 마지막요일 

$holiday_array = array
     (
      "1"=>array("1"=>"신정", "22"=>"구정", "23"=>"구정", "24"=>"구정"),
      "2"=>array(),
      "3"=>array("1"=>"삼일절"),
      "4"=>array("5"=>"식목일"),
      "5"=>array("5"=>"어린이날", "28"=>"석가탄신일"),
      "6"=>array("6"=>"현충일"),
      "7"=>array(),
      "8"=>array("15"=>"광복절"),
      "9"=>array("29"=>"추석", "30"=>"추석"),
      "10"=>array("1"=>"추석", "3"=>"개천절"),
      "11"=>array(),
      "12"=>array("25"=>"성탄절")
     );

?>
<html>
<head><title>::WELLSTUDY::</title>
<link rel="stylesheet" type="text/css" href="../bbs_file/style.css">
</head>
<body topmargin=0>
<table cellpadding=0 cellspacing=0 width="0" align=left border=0 height="0">
<tr><td>
<!--제목-->
<table cellpadding=5 cellspacing=0 width="0" align=center height="0">
<tr>

 <td align=center><font style="text-decoration:none;font-size:12px;font-weight:bold"><?=$year_cal?>년 <?=$month_cal?>월</font></td>

</tr>

</table>
</td></tr>
<tr height=2><td></td></tr>
<tr><td>
<!--내용-->
<table width='15' cellpadding='3' cellspacing='1' border='0' align=center height="15"> 
 <tr> 
 <th align=center bgcolor="#7abae4">일</th> 
 <th align=center bgcolor="#7abae4">월</th> 
 <th align=center bgcolor="#7abae4">화</th> 
 <th align=center bgcolor="#7abae4">수</th> 
 <th align=center bgcolor="#7abae4">목</th> 
 <th align=center bgcolor="#7abae4">금</th> 
 <th align=center bgcolor="#7abae4">토</th> 
 </tr> 

 <? for ($n=1,$i=0; $i<$tweek; $i++) { ?> 
 <tr> 


  <? for ($k=0; $k<7; $k++) { ?> 

  <td align=center style="border:solid 1px #7abae4"> 
   <?
   if ($k =="0") //일요일
   {
   $color="red";
   }
   elseif ($k =="6") //토요일
   {
   $color="blue";
   }
   else // 평일
   {
   $color="black";
   }
   ?>
   <? if (!(($i == 0 && $k < $sweek) || ($i == $tweek-1 && $k > $lweek))) { ?> 
    <?
    if ($n==date("d")) //오늘
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
  <br><!--td채우기-->

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

function getTimeStamp() { // 24시간제
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