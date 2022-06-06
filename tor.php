<?php
#function get_db($sql){
// MySQL과 연동하기 위한 커넥션 생성
$dbConn = mysqli_connect("127.0.0.1", "root", "!@#jung4609",
"nba_db") or die("실패 시 출력할 문구");

// MySQL에서 데이터를 가져오기 위한 쿼리문 작성
$sql = "select f_name,l_name,position from player_info 
        where team_id='tor';";
$sql2="select * from coach where team_id='tor'; ";

// ResultSet에 $dbConn과 $sql을 인자값으로 전달
$rs = mysqli_query($dbConn, $sql);
$rs2= mysqli_query($dbConn, $sql2);

// 데이터를 담을 배열을 생성
$articles = array();
$coaches= array();
while (true) {
	$article = mysqli_fetch_assoc($rs);
    
    // 더 이상 불러올 row가 없을 때 break
    if ($article == null) {
    	break;
    }
    $articles[] = $article;
}
//$mysqli -> close();

while (true) {
	$coach = mysqli_fetch_assoc($rs2);
    
    // 더 이상 불러올 row가 없을 때 break
    if ($coach == null) {
    	break;
    }
    $coaches[] = $coach;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width">
    <meta name="author" content="18011881">
    <meta name="description" content="NBA STAT GRAPHS">
    <meta name="keywords" content="NBA, BASKETBALL,cSTAT">
    <title>NBA STAT</title>

    <!-- style -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.css">

    <!-- chart -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script	src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >

    <!-- 파비콘 -->
    <link rel="shortcut icon" href="icon/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="icon/favicon-152.png">
    <link rel="icon" href="path/to/favicon.png">
    <link rel="icon" href="icon/favicon-16.png" sizes="16x16"> 
    <link rel="icon" href="icon/favicon-32.png" sizes="32x32"> 
    <link rel="icon" href="icon/favicon-48.png" sizes="48x48"> 
    <link rel="icon" href="icon/favicon-64.png" sizes="64x64"> 
    <link rel="icon" href="icon/favicon-128.png" sizes="128x128">

    <!-- 웹 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Brush+Script" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">

    <!-- HTLM5shiv ie6~8 -->
    <!--[if lt IE 9]> 
        <script src="js/html5shiv.min.js"></script>
        <script type="text/javascript">
            alert("현재 당신이 보는 브라우저는 지원하지 않습니다. 최신 브라우저로 업데이트해주세요!");
        </script>
    <![endif]-->
    <style>
        /* reset */
        /* 여백 초기화 */
        body,div,ul,li,dl,dd,dt,ol,h1,h2,h3,h4,h5,h6,input,fieldset,legend,p,select,table,th,td,tr,textarea,button,form,figure,figcaption{margin:0;padding:0;}

        /* a 링크 초기화 */
        a {color: #222; text-decoration: none;}
        a:hover {color: #2698cb;}

        /* 폰트 초기화 */
        body, input, textarea, select, button, table {font-family: 'Nanum Gothic', AppleSDGothicNeo-Regular,'Malgun Gothic','맑은 고딕',dotum,'돋움',sans-serif; color: #222; font-size: 13px; line-height: 1.6;}
        
        /* 폰트 스타일 초기화 */
        em,address {font-style: normal;}

        /* 블릿기호 초기화 */
        ul,li,ol {list-style: none;}

        /* 제목 태그 초기화 */
        h1,h2,h3,h4,h5,h6 {font-size: 13px; font-weight: normal;}
        
        /*테이블 초기화*/
        table,th,td{border: 1px solid #444444;width:100%;padding: 5px; }
        tr{ }
        /* IR 효과 */
        .ir_pm {display:block; overflow:hidden; font-size:0; line-height:0; text-indent:-9999px;} /* 의미있는 이미지의 대체 텍스트를 제공하는 경우(Phark Method) */
        .ir_wa {display:block; overflow:hidden; position:relative; z-index:-1; width:100%; height: 100%;} /* 의미있는 이미지의 대체 텍스트로 이미지가 없어도 대체 텍스트를 보여주고자 할 때(WA IR) */
        .ir_su {overflow: hidden; position:absolute; width:0; height:0; line-height:0; text-indent:-9999px;} /* 대체 텍스트가 아닌 접근성을 위한 숨김 텍스트를 제공할 때 */
        
        /* style */
        /* 레이아웃 */
        body {background: url(img/header_bg.jpg) repeat-x center top;}
        #header {  }
        #nav {background-color: #f6fdff;}
        #title {background-color: #eaf7fd;}
        #contents .container {border-right: 1px solid #dbdbdb; border-left: 1px solid #dbdbdb;}
        #cont_left {float: left; width: 250px;}
        #cont_center {
            overflow: hidden; 
            margin-right: 400px; 
            min-height: 1300px; 
            border-right: 1px solid #dbdbdb;
            border-left: 1px solid #dbdbdb;
        }
        #cont_center .container{
            width:100%;
            height: 60%;
        }
        #cont_center img{
            width:100%;
            height: 40%;
        }
        #cont_right {position: absolute; right: 0; top: 0px; width: 400px;}
        #footer {border-top: 1px solid #dbdbdb;position: right;}

        /* 컨테이너 */        .container {position: relative; width: 1200px; margin: 0 auto; /* background: rgba(0,0,0,0.3) */}

        /* 헤더 */
        .header {height: 327px;}
        .header .header_menu {text-align: right;}
        .header .header_menu a {color: #fff; padding: 8px 0 6px 10px; display: inline-block; transition: color 0.3s ease; font-family: 'Abel', sans-serif;}
        .header .header_menu a:hover {color: #ccc;}
        
        .header .header_tit { text-align: center; text-transform: uppercase; margin-top: 25px; font-family: 'Abel', sans-serif;}
        .header .header_tit h1 {
            font-size: 30px; 
            color: #fff; 
            background: red; 
            display: inline-block; 
            padding: 5px 30px 5px 30px; 
            letter-spacing: 2px; 
            font-weight: 900;
            transition: box-shadow 0.25s ease-in-out;
        }
        .header .header_tit h1:hover {
            box-shadow: 
                inset -9em 0 0 0 blue, 
                inset 9em 0 0 0 blue;
        }
        .header .header_tit a {
            font-size: 16px; 
            color: #fff; 
            background: blue;  
            display: inline-block; 
            padding: 10px 20px 10px 20px; 
            margin-top: -7px; 
            transition: box-shadow 0.3s ease-in-out;
        }
        .header .header_tit a:hover {
            box-shadow: 
                0 0 0 5px rgba(75,154,191,0.9) inset,
                0 0 0 100px rgba(0,0,0,0.1) inset;
        }
        
        .header .header_icon {text-align: center; margin-top: 20px; padding-bottom: 45px;}
        .header .header_icon li {display: inline; margin: 0 2px;}
        .header .header_icon li a {
            position: relative;
            background-color:transparent;
            border-radius: 50%;
            width: 45px; 
            height: 45px;  
            color: #fff;
            display: inline-block;
            font-size: 35px;
            line-height: 60px;
            transition: all 0.3s ease;
        }
        .header .header_icon li a span {
            position: absolute; 
            opacity: 0;
            left: 50%; top: -40px;
            transform: translateX(-50%);
            font-size: 12px;
            line-height: 1.6;
            background: #3192bf; 
            padding: 3px 9px;
            border-radius: 6px 0;
            transition: all 0.3s ease;
        }
        .header .header_icon li a span:before {
            content: '';
            position: absolute;
            left: 50%; bottom: -5px;
            margin-left: -5px;
            border-top: 5px solid #3192bf;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
        }
        .header .header_icon li a:hover span {
            opacity: 1;
            top: -33px;
        }
        .header .header_icon li a:hover {
            box-shadow: 
                0 0 0 3px rgba(75,154,191,0.9) inset,
                0 0 0 100px rgba(0,0,0,0.1) inset;
        }
        
        /* 전체 메뉴 */
        .nav {overflow: hidden; padding: 25px 0; display: none;}
        .nav > div {float: left; width: 40%;}
        .nav > div:last-child {width: 20%;}
        .nav > div ol {overflow: hidden;}
        .nav > div li {float: left; width: 50%; position: relative; padding-left: 8px; box-sizing: border-box;}
        .nav > div:last-child li {width: 100%;}
        .nav > div li a {position: relative;}
        .nav > div li:before {
            content: '';
            width: 3px; height: 3px;
            background-color: #25a2d0;
            border-radius: 50%;
            position: absolute; left: 0; top: 8px;
        }
        .nav > div h3 {
            font-size: 18px; 
            color: #25a2d0; 
            font-weight: bold; 
            margin-bottom: 4px;
        }
        .nav > div li a:after {
            content: '';
            display: inline-block;
            width: 0;
            height: 1px;
            position: absolute;
            bottom: 0;
            left: 0;
            background: #25a2d0;
            transition: all .2s ease-out;
        }
        .nav > div li:hover a:after {width: 100%;}
        
        /* 타이틀 */
        .title {position: relative; text-align: center; }
        .title h2 {font-family: 'Nanum Brush Script', cursive; font-size: 39px; color: #0093bd; padding: 5px 0;}
        .title .btn {
            position: absolute; right: 0; top: 5px;
            width: 60px; 
            height: 60px; 
            line-height: 60px; 
            background: #3192bf; 
            color: #fff;
            font-size: 35px; 
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        .title .btn:hover {
            box-shadow: 
                0 0 0 3px rgba(75,154,191,0.9) inset,
                0 0 0 100px rgba(0,0,0,0.1) inset;
        }
        
        /* 컨텐츠 영역 */
        .column {padding: 15px; border-bottom: 1px solid #dbdbdb;}
        .column .col_tit {font-size: 20px; color: #2f7fa6; padding-bottom: 5px;}
        .column .col_desc {
            border-bottom: 1px dashed #dbdbdb; 
            padding-bottom: 15px; margin-bottom: 15px;  
            color: #878787;
            line-height: 18px;
        }
        .column.col1 {} 
        .column.col2 {} 
        .column.col3 {border-bottom: 0;} 
        .column.col4 {} 
        .column.col5 {} 
        .column.col6 {border-bottom: 0;} 
        .column.col7 {} 
        .column.col8 {} 
        .column.col9 {border-bottom: 0;} 
        
        /* 메뉴 */
        .menu li {position: relative;}
        .menu li a {
            font-size: 16px; text-transform: uppercase; 
            color: #878787; border-bottom: 1px solid #dbdbdb; 
            padding: 10px; 
            display: block;  
            transition: box-shadow 0.34s ease; 
            background: 0.34s ease;
        }
        .menu li a i {position: absolute; right: 10px; top: 15px;}
        .menu li a:hover {
            box-shadow: inset 180px 0 0 0 rgba(36,130,174,0.7); 
            color: #fff; 
            background: rgba(36,130,174,0.9);
        }

        /* mediaquery */
        /* 화면 너비 0~1220px */
        
        @media (max-width: 1220px){
            .container {width: 100%;}
            .row {padding: 0 15px;}
            /* #cont_center {min-height: 1350px;} */
	        /* #contents .container {border: 0;} */
            
            /* .title .btn {right: 15px;} */
        }
        
        /* 화면 너비 0~1024px */
        @media (max-width: 1024px){
            #cont_right {width: 200px;}
            #cont_center {min-height: 1350px;margin-right: 200px;}
        
        }
        
        /* 화면 너비 0~960px */
        @media (max-width: 960px){
            #cont_center {margin-right: 0; border-right: 0;}
            #cont_right {position: static; width: 100%; border-top: 1px solid #dbdbdb;}
            .nav > div {float: none; width: 100%;}
            .nav > div:last-child {width: 100%;}
            .nav > div li {width: 33.333%;}
            .nav > div:last-child li {width: 33.333%;}
            .nav > div ol {margin-bottom: 10px;}
        }
        
        /* 화면 너비 0~768px */
        @media (max-width: 768px){
            #cont_left {float: none; width: 100%;}
	        #cont_center {border-left: 0;}
            .header .header_icon li a {
                width: 30px; 
                height: 30px;  
            }
        }
        
        /* 화면 너비 0~600px */
        @media (max-width: 600px){
            .header {height: auto;}

            .nav > div li {width: 50%;}
	        .nav > div:last-child li {width: 50%;}
            
            /* .header .header_tit {display: none;} */
            /* .header .header_icon {display: none;} */
            .title .btn {display: none;}
            .column.col1 .col_tit {display: none;}
            .column.col1 .col_desc {display: none;}
            .column.col1 .menu li a i {display: none;}
            .column.col1 {padding: 0; border-bottom: 0;}
            .column.col1 .menu ul {overflow: hidden;}
            .column.col1 .menu li {float: left; width: 33.33333%; text-align: center; border-right: 1px solid #dbdbdb; box-sizing: border-box;}
            .column.col1 .menu li:nth-child(3n) {border-right: 0;}
            .column.col1 .menu li a {color: #fff; text-shadow: 0 0 5px rgba(0,0,0,0.7);}
            .column.col1 .menu li a:hover {box-shadow: none; background: rgba(36,130,174,0.3);}
            .column.col2 {background: #fff;}
	        .column.col4 {border-top: 1px solid #dbdbdb;}
        }
        
        /* 화면 너비 0~480px */
        @media (max-width: 480px){

        }

        /* 화면 너비 0~320px */
        @media (max-width: 320px){

        }
    </style>
</head>
<body>
    
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="header">
                    <div class="header_menu">
                       
                    </div>
                    <!-- //header_menu -->
                    <div class="header_tit">
                    <a href="home.php"><h1>NBA STAT</h1></a><br>
                        <a href="http://nba.com">SOURCE</a>
                    </div>
                    <!-- //header_tit -->
                    <div class="header_icon">
                    <ul>
                            <li><a href="bos.php?year=16_17"><img src="img/BOS.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="bkn.php?year=16_17"><img src="img/BKN.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="nyk.php?year=16_17"><img src="img/NYK.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="tor.php?year=16_17"><img src="img/TOR.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="phi.php?year=16_17"><img src="img/PHI.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="chi.php?year=16_17"><img src="img/CHI.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="cle.php?year=16_17"><img src="img/CLE.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="det.php?year=16_17"><img src="img/DET.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="ind.php?year=16_17"><img src="img/IND.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="mil.php?year=16_17"><img src="img/MIL.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="atl.php?year=16_17"><img src="img/ATL.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="cha.php?year=16_17"><img src="img/CHA.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="mia.php?year=16_17"><img src="img/MIA.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="orl.php?year=16_17"><img src="img/ORL.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="was.php?year=16_17"><img src="img/WAS.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="den.php?year=16_17"><img src="img/DEN.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="min.php?year=16_17"><img src="img/MIN.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="okc.php?year=16_17"><img src="img/OKC.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="por.php?year=16_17"><img src="img/POR.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="uta.php?year=16_17"><img src="img/UTA.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="gsw.php?year=16_17"><img src="img/GSW.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="lac.php?year=16_17"><img src="img/LAC.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="lal.php?year=16_17"><img src="img/LAL.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="pho.php?year=16_17"><img src="img/PHO.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="sac.php?year=16_17"><img src="img/SAC.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="dal.php?year=16_17"><img src="img/DAL.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="hou.php?year=16_17"><img src="img/HOU.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="mem.php?year=16_17"><img src="img/MEM.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="nop.php?year=16_17"><img src="img/NOP.svg" class="img-normal" alt="normal image"></a></li>
                            <li><a href="san.php?year=16_17"><img src="img/SAN.svg" class="img-normal" alt="normal image"></a></li>                            
                        </ul>
                    </div>
                    <!-- //header_icon -->
                    
                    <!-- 
                        https://developers.facebook.com/tools/debug/
                        https://cards-dev.twitter.com/validator
                    -->
                </div>
            </div>
        </div>
    </header>

   
    <!-- <article id="title">
		<div class="container">
			<div class="title">
				<h2>"나는 퍼블리셔다."</h2>

			</div>
		</div>
	</article> -->
	<!-- //title -->
   
    <main>
        <section id="contents">
            <div class="container">
				<h2 class="ir_su">반응형 사이트 컨텐츠</h2>
                <section id="cont_left">
                    <h3 class="ir_su">메뉴 및 게시판 컨텐츠 영역</h3>
                    <article class="column col1">
                        <h4 class="col_tit">Toronto Raptors</h4>
                        <h4 class="col_tit">                            <script>
                                const params= new URLSearchParams(location.search);
                                document.write('Season ');
                                document.write(params.get('year'));
                            </script>
                        </h4>
                        <img src="img/TOR.svg" class="img-normal" alt="normal image"></a>
						<p class="col_desc">

                        </p>
						<!-- 메뉴 -->
						<div class="menu">
							<ul>
								<li><a href="?year=16_17">16_17 <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
								<li><a href="?year=17_18">17_18 <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
								<li><a href="?year=18_19">18_19 <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
								<li><a href="?year=19_20">19_20 <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
								<li><a href="?year=20_21"> 20_21<i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
							
                            </ul>
						</div>
						<!--//메뉴 -->
                    </article>
                    <!-- //col1 -->
                    <article class="column col2">
                        <h4 class="col_tit">Coach</h4>       
						<!-- <p class="col_desc">Team head coach & Owners name</p> -->
                        <table >                              
                            <?php foreach ($coaches as $article) {?>

                                <tr>
                                    <th><?= $article['head_coach']?></th>
                                    <th>Head Coach</th>

                                </tr>   
                                <tr>
                                    <th><?= $article['owner']?></th>
                                    <th>Owner</th>
                                </tr>
                            

                            <?php } ?> 
                        </table>
                        <!--  -->
                        <!-- //-->
                    </article>
                    <!-- //col2 -->
                    <article class="column col3">
                        <h4 class="col_tit">Roaster</h4>
						<p class="col_desc">Click Player's Name</p>
                        <table > 
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    
                                </tr>
                                
                                <?php foreach ($articles as $article) {?>
                                    
                                    <tr>
                                        
                                      
                                    <th><a href="player.php?f_name=<?= $article['f_name']?>&l_name=<?= $article['l_name']?>" >
                                                                <?= $article['f_name']?> <?= $article['l_name']?></a></th>
                                    
                                        <th><?= $article['position']?></th>

                                    </tr>
                                
                                    
                                <?php } ?>  
                            </table>
                        <!--  -->
                        <!-- //-->
                    </article>
                    <!-- //col3 -->
                </section>
                <!-- //cont_left -->
                <section id="cont_center">
                    <h3 class="ir_su">반응형 사이트 가운데 컨텐츠</h3>
                    <article class="column col4">
                        <h4 class="col_tit">Monthly Wins/Games </h4>
						<p class="col_desc">이 곳은 설명 부분입니다.</p>
                        <div class="chart-container pie-chart">
								<canvas id="win_chart"></canvas>
						</div>     
						<!--  -->
                        <!-- //-->
                    </article>
                    <!-- //col4 -->
                    <article class="column col5">
                        <!-- <p class="col_desc">이 곳은 설명 부분입니다.</p> -->
                        <h4 class="col_tit">Monthly Points</h4>
                        <div class="chart-container pie-chart">
								<canvas id="pie_chart"></canvas>
						</div>       
                        <!--  -->
                        <!-- //-->
                    </article>
                    <!-- //col5 -->
                    <article class="column col6">
                        <h4 class="col_tit">Monthly Rebounds</h4>
                        <div class="chart-container pie-chart">
								<canvas id="doughnut_chart"></canvas>
							</div>
						<!-- <p class="col_desc">이 곳은 설명 부분입니다.</p> -->
                        <div class="container">
                        
                        <!-- <img src="img/2021_playoff.jpg" class="img-normal" alt="normal image"> -->
						</div>
						<!--  -->
                        <!-- //-->
                    </article>
                    <!-- //col6 -->
                </section>
                <!-- //cont_center -->
                <section id="cont_right">
                    <h3 class="ir_su">반응형 사이트 오른쪽 컨텐츠</h3>
                    <article class="column col7">
                        <h4 class="col_tit">Monthly Assists</h4>
						<!-- <p class="col_desc">이 곳은 설명 부분입니다.</p> -->
                        <div class="chart-container pie-chart">
								<canvas id="bar_chart"></canvas>
							</div>
                        <!--  -->
                        <!-- //-->
                    </article>
                    <!-- //col7 -->
                    <article class="column col8">
                        <h4 class="col_tit">Monthly Blocks</h4>
						<!-- <p class="col_desc">이 곳은 설명 부분입니다.</p> -->
                        <div class="chart-container pie-chart">
								<canvas id="bar_chart2"></canvas>
							</div>
                        <!--  -->
                        <!-- //-->
                    </article>
                    <!-- //col8 -->
                    <article class="column col9">
                        <h4 class="col_tit">Monthly Steals</h4>
						<!-- <p class="col_desc">이 곳은 설명 부분입니다.</p> -->
                        <div class="chart-container pie-chart">
								<canvas id="bar_chart3"></canvas>
							</div>
                        <!--  -->
                        <!-- //-->
                    </article>
                    

                    
                    <!-- //col9 -->
                </section>
                <!-- //cont_right -->
            </div>
        </section>
        <!-- //contents -->
    </main>
    
    <footer id="footer">

    </footer>
    <!-- //footer -->
    
    <!-- JavaScript Libraries -->
    <script src="js/jquery.min_1.12.4.js"></script>
    <script src="js/modernizr-custom.js"></script>

</body>
</html>



<script>
	
$(document).ready(function(){

    if(params.get('year')=='16_17')
			season='team_all_game.game_date>=\'16-10-25\' and team_all_game.game_date<=\'17-4-15\'';			
    if(params.get('year')=='17_18')
			season='team_all_game.game_date>=\'17-10-17\' and team_all_game.game_date<=\'18-4-14\'';		
	if(params.get('year')=='18_19')
			season='team_all_game.game_date>=\'18-10-16\' and team_all_game.game_date<=\'19-4-13\'';	
	if(params.get('year')=='19_20')
			season='team_all_game.game_date>=\'16-10-22\' and team_all_game.game_date<=\'20-8-15\'';
	if(params.get('year')=='20_21')
			season='team_all_game.game_date>=\'20-12-22\' and team_all_game.game_date<=\'21-5-18\'';
    
    var url =window.location.pathname;
    // alert(url);
    var path=url.split('/');
    // alert(path[1]);
    // alert(path[2]);
    var file=path[2].split('.');
    // alert(file[0]);
	var team_id=file[0];
        // alert(season);
	$.ajax({
			url:"team_data.php",
			method:"POST",
			data:{action:'fetch',season: season, team_id: team_id},
			dataType:"JSON",
			success:function(data)
			{   
                var win = [];
				var month = [];
				var pts = [];
				var rbd = [];
				var ast = [];
				var blk = [];
				var stl = [];
                var color=[];
	

				for(var count = 0; count < data.length; count++)
				{
                    win.push(data[count].win);
					month.push(data[count].month);
					pts.push(data[count].pts);
					rbd.push(data[count].rbd);
					ast.push(data[count].ast);
					blk.push(data[count].blk);
					stl.push(data[count].stl);
					color.push(data[count].color);
				}
				var win_data = {
					labels:month,
					datasets:[
						{
							// label:'Vote',
							backgroundColor:color,
							color:'#fff',
							data:win
						}
					]
				};
				var pts_data = {
					labels:month,
					datasets:[
						{
							// label:'Vote',
							backgroundColor:color,
							color:'#fff',
							data:pts
						}
					]
				};
				var rbd_data = {
					labels:month,
					datasets:[
						{
							//label:'Vote',
							backgroundColor:color,
							color:'#fff',
							data:rbd
						}
					]
				};
				var ast_data = {
					labels:month,
					datasets:[
						{
							//label:'Vote',
							backgroundColor:color,
							color:'#fff',
							data:ast
						}
					]
				};
				var blk_data = {
					labels:month,
					datasets:[
						{
							//label:'Vote',
							backgroundColor:color,
							color:'#fff',
							data:blk
						}
					]
				};

				var stl_data = {
					labels:month,
					datasets:[
						{
							//label:'Vote',
							backgroundColor:color,
							color:'#fff',
							data:stl
						}
					]
				};
				var options = {    
                    legend: {
                    display: false
                    },
					responsive:true,
					scales:{         

						yAxes:[{
							ticks:{
                                min:0
							}
						}],
                        xAxes:[{
                            ticks:{
                                fontSize:10,
                                autoSkip: false,
                                maxRotation: 90,
                                minRotation: 90,
                                labelString: 'Month'

                            }
                        }]
					}
				};
                var group_chart0 = $('#win_chart');

                var graph0 = new Chart(group_chart0, {
                    type:'bar',
                    data:win_data,
                    options:options
                });
				var group_chart1 = $('#pie_chart');

				var graph1 = new Chart(group_chart1, {
					type:'bar',
					data:pts_data,
					options:options
				});

				var group_chart2 = $('#doughnut_chart');

				var graph2 = new Chart(group_chart2, {
					type:'bar',
					data:rbd_data,
					options:options
				});

				var group_chart3 = $('#bar_chart');

				var graph3 = new Chart(group_chart3, {
					type:'bar',
					data:ast_data,
					options:options
				});

				var group_chart4 = $('#bar_chart2');

				var graph4 = new Chart(group_chart4, {
					type:'bar',
					data:blk_data,
					options:options
				});
                var group_chart5 = $('#bar_chart3');

                var graph5 = new Chart(group_chart5, {
                    type:'bar',
                    data:stl_data,
                    options:options
                });
			}
		})


});

</script>
