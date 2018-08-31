<?
   function latest_article($table, $loop, $char_limit) 
   {
		include "dbconn.php";
		// DB 테이블의 레코드를 일련번호를 기준으로 내림차순 정렬
		// limit 옵션을 이용하여 표시할 수 있는 최근 글의 개수($loop)만큼 
		// 등록된 글을 가져와 $result에 저장
		$sql = "select * from $table order by num desc limit $loop";
		$result = mysql_query($sql, $connect);
// 최근에 작성된 글의 제목을 mysql_fetch_array() 함수를 통해 가져와 메인화면에 출력
		while ($row = mysql_fetch_array($result))
		{	
			$num = $row[num]; // 레코드의 일련 번호
			$len_subject = strlen($row[subject]); // 글 제목의 길이를 저장
			$subject = $row[subject]; // 제목
			// 글 제목의 글자수가 표시할 수 있는 최대 글자수보다 크면
			if ($len_subject > $char_limit)
			{   // 초과된 글자를 삭제한 후 $subject에 저장
				$subject = mb_substr($row[subject], 0, $char_limit, 'euc-kr');
				// 그 후 문자열 연결 연산자로 $subject와 ...을 연결
				$subject = $subject."...";
			}			
			
			$regist_day = substr($row[regist_day], 0, 10);
			// 글 제목을 메인 화면에 표시
			// 글 제목을 클릭하면 해당 게시물의 글 내용 보기 페이지로 이동하도록 연결
			echo "      
				<div class='col1'><a href='./$table/view.php?table=$table&num=$num'>$subject</a></div>"; 
				if(time() - strtotime($regist_day) <= 60 * 60 * 24 * 2){
		    echo "<img src='./img/n.png'/>";
			}				
				echo" <div class='col2'>$regist_day</div>	<div class='clear'></div>";
		}		
		mysql_close();
   }
?>