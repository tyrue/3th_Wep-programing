# 마인크래프트 게임 팬 카페(Minecraft game fan cafe)

## 1. 개요

게임 마인크래프트에 대한 정보와 나만의 노하우, 자신의 활동 내역과 회원들 간의 자유롭게 소통할 수 있는 팬 카페를 제작하였다.

홈페이지에 대한 주제를 선정하는 중에, 그 중 우리도 좋아하고 대중적인 게임 ‘마인크래프트’을 선택하였고, 이 게임에 대한 팬 카페를 만들기로 하였다. 



## 2. 구현

**2-1.** **주요기능**

**1)** **홈으로 이동**

  ![image](https://user-images.githubusercontent.com/20302410/51963708-cda82d00-24a7-11e9-932a-f1832d09a955.png)

 모든 메뉴에서 해당 버튼을 누르면 메인 화면으로 이동한다.

**2)** **달력****,** **시계****,** **방문자 수 기록**  

![image](https://user-images.githubusercontent.com/20302410/51963714-d13bb400-24a7-11e9-950d-d0600b1080fc.png)

달력 : 현재 날짜를 노란색으로 표시하여 며칠이고 무슨 요일인지 알 수 있게 하였다.

시계 : 매 초마다 새로 갱신되어 실시간으로 현재 시간을 알 수 있다.

방문자 수 : 오늘의 방문자 수와 지금까지 누적된 전체 방문자 수를 표시한다.

**3)** **메인화면 및 모든 게시판에서 새로운 글에 대한** **new** **표시**

![image](https://user-images.githubusercontent.com/20302410/51963796-fd573500-24a7-11e9-9f2e-72e98818d3b1.png)



![image](https://user-images.githubusercontent.com/20302410/51963806-021be900-24a8-11e9-89a9-1ec5f10401b2.png)

작성된 날짜를 기준으로 2일 이내의 글은 제목 옆에 new아이콘이 뜨게 하였다.

**4)** **파일 다운로드 기능 제공**

자료실에서 첨부파일을 다운로드 할 수 있다.

![image](https://user-images.githubusercontent.com/20302410/51963810-0516d980-24a8-11e9-93ee-75844f905a12.png)



**2-2.** **프로그램구조**

**⓵** **기본구조**

 ![image](https://user-images.githubusercontent.com/20302410/51963867-32638780-24a8-11e9-8d62-cd94606bf511.png)

**⓶** **회원가입**

​![image](https://user-images.githubusercontent.com/20302410/51963868-32fc1e00-24a8-11e9-8735-08cc1a363ac1.png)

**⓷** **로그인**

![image](https://user-images.githubusercontent.com/20302410/51963871-34c5e180-24a8-11e9-9ae1-c1425ba678c2.png)



**⓸** **게시글 및 덧글**

![image](https://user-images.githubusercontent.com/20302410/51963875-37283b80-24a8-11e9-910e-98cfbf9b5fb6.png)

​     

**⓹** **페이지**

![image](https://user-images.githubusercontent.com/20302410/51963876-38596880-24a8-11e9-93cb-6ad9c6ded3cf.png)



## 3.  메인 화면

![image](https://user-images.githubusercontent.com/20302410/51964113-d6e5c980-24a8-11e9-96e0-aaba3997fa28.png)

카페 대문 왼쪽에 오늘 방문자 수, 전체 방문자 수, 달력을 배치하였다. 그리고 아래쪽에 자유게시판과 게임정보 게시판의 글을 연동하여 빠르게 볼 수 있도록 하였다.

