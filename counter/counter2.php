<?
include "../lib/dbconn.php";
$sum=0;
$todayc = date("Y-m-d");  // ������ '��-��-��-��-��'�� ����
$sql="select * from counter where date='$todayc'";
$result=mysql_query($sql, $connect);
$row=mysql_fetch_array($result);

if(!$row){
	$sql0="insert into counter(date, count) values('$todayc', 1)";
	mysql_query($sql0, $connect);
}else{
	$sql1="update counter set count=count+1 where date='$todayc'";
	mysql_query($sql1, $connect);
}

$sql="select * from counter where date='$todayc'";
$result=mysql_query($sql, $connect);
$row=mysql_fetch_array($result);
$count=$row[count];

$sqlt="select * from counter";
$resultt=mysql_query($sqlt, $connect);
while($rowt=mysql_fetch_array($resultt)){
	$sum+=$rowt[count];
}
?>
<table boreder = 1 width = 300>
<tr><td>
���� �湮�� �� : <?=number_format($count)?><br>
��ü �湮�� �� : <?=number_format($sum)?>
</tr></td>