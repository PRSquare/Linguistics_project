<?php
    include "connect.php";
    $ID_Conf = mysqli_query($connect,"SELECT MAX(`ID_conf`) AS 'ID_conf' FROM `conferences`");
    $ID_Conf = mysqli_fetch_assoc($ID_Conf);
    $_SESSION['ID_conf'] = $ID_Conf["ID_conf"];
    function orgcomitet(){
        include "connect.php";
        $list='';
        $SpisokORGCOM = mysqli_query($connect,"SELECT `ID_per`, `name_per_".$_SESSION["lang"]."` , `photo_per`, `link_per_".$_SESSION["lang"]."`, `position_".$_SESSION["lang"]."`  FROM `committee`");
        for($i=1;($row = mysqli_fetch_assoc($SpisokORGCOM)) != false;$i++){
            if($row['photo_per']==''){
                $img = "/img/logo/logo3.png";
            }
            else{
                $img = $row['photo_per'];
            }
            $list .="<div class='org-block-info'>
                <div class='org-block-info-card'>
                    <img class='org-img rounded-0' src='/adminPanels/$img' alt='".$row['name_per_'.$_SESSION["lang"]]."'>
                    <div class = 'org-footer'>
                            <a href = '".$row['link_per_'.$_SESSION["lang"]]."'><h4>".$row['name_per_'.$_SESSION["lang"]]."</h4></a>
                            <p class = 'orgcom__position'>".$row['position_'.$_SESSION["lang"]]."</p>
                        </div>
					</div>
				</div>";
            }
        echo $list;
    }
    function listLASTconf () {
        include "connect.php";
        //$year = mysqli_query($connect,"SELECT * FROM `years` WHERE `ID_year` <".$Date["ID_year"]);
        $CONFBD = mysqli_query($connect, "SELECT conf.`ID_conf`, conf.`Name_conf_".$_SESSION["lang"]."`, conf.`ID_year`, conf.`main_photo`, dat.`date_from`, dat.`text_ru` FROM `conferences` conf LEFT JOIN `dates` dat ON conf.`ID_conf` = dat.`ID_conf` WHERE conf.`ID_conf` <= " .$_SESSION['ID_conf']." AND `text_ru` LIKE 'Конференция%' AND DATE(`date_from`) <= CURDATE() ORDER BY `ID_conf` ASC LIMIT 5");
        //поправки
        while(($row = mysqli_fetch_assoc($CONFBD)) != false){
        $year = explode("-", $row['date_from']);
        if($row['main_photo']==''){
        $img = "/img/logo/logo2.png";
        }
        else{
        $img = "/adminPanels/".$row['main_photo'];
        }
        $string = mb_substr($row['Name_conf_'.$_SESSION["lang"]],0,50,'UTF-8')."...";
        $CONF.="<div class='list-last-conf'>
        <img class='list-last-conf-img' src='$img' alt=''>
        <div class='conf-last-info' ><div class='size-last-konf'>
        <h4 style='color:#EB176D; font-size:20px;'>".$year[0]." ".name('y')."</h4>
        <a href='blog.php?year=".$row['ID_year']."'><h4>".$string."</h4></a></div>
        
        <ul class='blog-info?".$row['Name_conf_'.$_SESSION["lang"]]."'>
        <li><a class='button but' href='blog.php?year=".$row['ID_year']."'>".name('but_more')."</a>
        </li></ul></div></div>";
        }
        echo $CONF;
        }
    function lastPHOTO (){
        include "connect.php";
        $photoBD = mysqli_query($connect,"SELECT * FROM `photo_conf` ORDER BY `ID_photo` DESC LIMIT 6");
        while(($row = mysqli_fetch_assoc($photoBD)) != false){
            $photo.= "<div class='col-sm-6 col-md-4 photo-div p-1'>
                        <a  href='/adminPanels/".$row['photo_conf']."' class='img-gal'>
                        <div class='single-img relative'>
                            <div class='single_photo'><img class='block-img rounded-0' src='/adminPanels/".$row['photo_conf']."' ></div>
                            <div class='overlay'>
                                <div class='overlay-content'>
                                    <div class='overlay-icon'>
                                        <i class='ti-plus'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>";
        }
        echo $photo;
    }
    function archive (){
        include "connect.php";
        
        $yearBD = mysqli_query($connect,"SELECT * FROM `years` WHERE `ID_year` = ".$_SESSION["year"]);
        while(($roww = mysqli_fetch_assoc($yearBD)) != false){
            
            $confYear = $roww["year"];
            echo "<script> echo (".$confYear.")</script>";
        }
       
        $archiveBD = mysqli_query($connect,"SELECT conf.`ID_conf`, conf.`anons_name_".$_SESSION["lang"]."`, conf.`info_anons_".$_SESSION["lang"]."`, conf.`main_photo`, dat.`date_from`, dat.`text_ru` FROM `conferences` conf LEFT JOIN `dates` dat ON conf.`ID_conf` = dat.`ID_conf` WHERE `text_ru` LIKE 'Конференция%' AND ID_year = ".$_SESSION["year"]);
        //$date = "SELECT `ID_conf`, `date_from`, `date_to` FROM `dates` WHERE `text_ru` LIKE 'Конференция%' AND `ID_conf` = $_GET[id_konf]";
        while(($row = mysqli_fetch_assoc($archiveBD)) != false){
            // $string = mb_substr($row['info'],0,200,'UTF-8'); Сокращенный текст с анонса
           if($row['main_photo']==''){
                $img = "/img/logo/logo2.png";
            }
            else{
                $img = "/adminPanels/".$row['main_photo'];
            }
            
            $archive .="<article class='konf'>
                        <div class='spisok-konf__img'>
                            <h3>".date('d.m.Y',strtotime($row['date_from']))."</h3>
                            <img class='card-img rounded-0' src='$img'>
                            <a class = 'button__konf'  href='blog-details.php?id=".$row['ID_conf']."'>".name('but_read')."</a>
                            <div class = 'spisok-konf__footer'>";
            $ID_ANONS = $row['ID_conf'];
            $ID_ANONS = (integer)$ID_ANONS;
            $archiveBD_prog = mysqli_query($connect,"SELECT * FROM `playbill` WHERE `ID_conf` = '".$ID_ANONS."'");
            while(($row__prog = mysqli_fetch_assoc($archiveBD_prog)) != false){
                $archive .="<div class = 'konf__footer'>
                    <p class = 'konf__text__button'>  ".$row__prog['name_playbill_'.$_SESSION["lang"]]."</p>";
                    if($row__prog['road_'.$_SESSION["lang"]] != ""){
                        $archive .="<a href='".$row__prog['road_'.$_SESSION["lang"]]."' class='download__program' download>
                        ".name('download')."
                        </a>";
                    }
                    $archive .=" </div>";  
            } 
            $archive .="</div></div>
                        <div class='blog_details blog_details__anons'>
                            <h3 class='text-left colorarh last__anons'> ".name('announcement_title_s')." ".$confYear."</h3>
                            <p class = 'name__konf'>".$row['anons_name_'.$_SESSION["lang"]]."</p>";
                            $info = $row['info_anons_'.$_SESSION["lang"]];
                            $plakonf=explode(PHP_EOL,$info);
	                        foreach($plakonf as $key => $val1){
		                        if($val1!=''){
			                        $archive.="\n"."<p class='describtion__konf jojo'>$val1</p>";
		                        }
                            }
                            $archive .="
                        </div>
                    </article>";
        }
        echo $archive;
    }
   

    function feedback (){
        include "connect.php";
        $feedBD = mysqli_query($connect,"SELECT * FROM `feedback` WHERE `ID_conf` =  ".$_SESSION["id_konf_blog_detalic"]);
        if($feedBD!=''){
            $feedback="<h2>".name('feed')."</h2>";
        }
        
        while(($row = mysqli_fetch_assoc($feedBD)) != false){
            if($row['feedback_'.$_SESSION["lang"]]!=''&&$row['Name_feedback_'.$_SESSION["lang"]]!=''){
                $feedback.="<div class='feedback'>
                <h4>".$row['Name_feedback_'.$_SESSION["lang"]]."</h4>"."<h5>".$row['post_'.$_SESSION["lang"]]."</h5>";
            
                $in = $row['feedback_'.$_SESSION["lang"]];
                $plak=explode(PHP_EOL,$in);
                foreach($plak as $key => $val){
                    if($val!=''){
                        $feedback.="<br>"."<p class = 'otstyp'>".$val."</p>";
                    }
                } 
            }
            $feedback.="</div>";
        }
        if($feedback!=""){
            echo $feedback.="</div>";
        }          
    }

    function docum($idKonf){
        include "connect.php";
        $idKonf =  (int) $idKonf;
        $docum="<div class='ducum'>";
        $docBD = mysqli_query($connect,"SELECT * FROM `el_collection` WHERE`ID_conf` = $idKonf ");
        while(($row = mysqli_fetch_assoc($docBD)) != false){
            if($row['Road_to_documents']!=''&&$row['Name_documents_'.$_SESSION["lang"]]!=''){
            $docum.="<div class='desc'>
                      <h5 class='comment'>".$row['Name_documents_ru']."</h5>
                      <div class='d-flex justify-content-between'><div class='d-flex align-items-center'>
                    <h3><a href='".$row['Road_to_documents_'.$_SESSION["lang"]]."'>Скачать</a></h3></div> </div>";
            }
        }
        if($docum!="<div class='ducum'>"){
            echo $docum."</div>";
        }
    }
    function video(){
        include "connect.php";
        $video="<div class='last-photo-konf-title blo-padd'><h2 class='primary-text'>".name('video')."</h2><img src='img/home/section-style.png' ></div><div class='row no-gutters '><div class='foto'>";
        $photoBD = mysqli_query($connect,"SELECT * FROM `video_conf`  WHERE `ID_conf` = ".$_SESSION["id_konf_blog_detalic"]);
        while(($row = mysqli_fetch_assoc($photoBD)) != false){
            if($row['video_conf']!=''){
                $video.="
                <iframe class='videokonf' src='https://www.youtube.com/embed/".$row['video_conf']."' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
            }
        }
        if($video!="<div class='last-photo-konf-title blo-padd'><h2 class='primary-text'>".name('video')."</h2><img src='img/home/section-style.png' ></div><div class='row no-gutters '><div class='foto'>"){
            echo $video."</div></div>";
        }
    }
    function photoconf (){
        include "connect.php";
        $photoBD = mysqli_query($connect,"SELECT * FROM `photo_conf`  WHERE`ID_conf` = ".$_SESSION["id_konf_blog_detalic"]);
        $photo="<div class='last-photo-konf-title blo-padd'><h2 class='primary-text'>".name('photo')."</h2><img src='img/home/section-style.png'></div><div class='row no-gutters'>";
        while(($row = mysqli_fetch_assoc($photoBD)) != false){
            if($row['photo_conf']!=''){
            $photo.= "
            <div class='col-sm-6 col-md-4 photo-div'>
                <a href='/adminPanels/".$row['photo_conf']."' class='img-gal'>
                <div class='single-img relative'>
                    <img class='block-img rounded-0' src='/adminPanels/".$row['photo_conf']."' >
                    <div class='overlay'>
                        <div class='overlay-content'>
                            <div class='overlay-icon'>
                                <i class='ti-plus'></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>";}
        }
        if($photo!="<div class='last-photo-konf-title blo-padd'><h2 class='primary-text'>Фотографии</h2><img src='img/home/section-style.png'></div><div class='row no-gutters'>"){
            echo $photo."</div>";
        }
    }
    function speakers(){
        include "connect.php";
        $speakerBD = mysqli_query($connect,"SELECT * FROM `speakers` WHERE `ID_conf` = ".$_SESSION["id_konf_blog_detalic"]);
        $speaker='
        <h2 class="text-center">'.name('speak').'</h2> 
        <div class="comment-list"> 
        <div class="single-comment justify-content-between d-flex">
        <div class="user justify-content-center d-flex keks ">';
        while(($row = mysqli_fetch_assoc($speakerBD)) != false){
            $speaker.='<div class="thumb speakerpaddings ">
                            <img class= "boederimg" src="/adminPanels/'.$row["photo"].'" >
                            <h3 class = "text-center">
                            <a href="'.$row["linkSP_".$_SESSION["lang"]].'">'.$row["name_".$_SESSION["lang"]].'</a>
                            </h3>
                        </div>';
        }
        echo $speaker.='</div></div>';
    }
    function sbornick(){
        include "connect.php";
        $arrayDateAnnouncement=array();
        $idconf = mysqli_query($connect,"SELECT `ID_conf` FROM `el_collection`");
        while(($row = mysqli_fetch_assoc($idconf)) != false){
            if(!in_array($row['ID_conf'], $arrayDateAnnouncement)){
                $arrayDateAnnouncement[]=$row['ID_conf'];
            }
        }
        foreach($arrayDateAnnouncement as $key => $value){
            $el_col_BD = mysqli_query($connect,"SELECT  `Name_documents_".$_SESSION["lang"]."`, `Road_to_documents`, `cover`, `link` FROM `el_collection` WHERE `ID_conf` = $arrayDateAnnouncement[$key]");
            $confBD = mysqli_query($connect,"SELECT * FROM `conferences` WHERE `ID_conf` = $arrayDateAnnouncement[$key] ");
            $row2 = mysqli_fetch_assoc($confBD);
            while(($row = mysqli_fetch_assoc($el_col_BD)) != false){
                if($row["cover"] != ""){
                    $string .= "<img src = '/adminPanels/"."".$row["cover"]."' alt = 'foto'> <h6>".$row['Name_documents_'.$_SESSION["lang"]]." </h6><a href='".$row['Road_to_documents']."'>".name('download_el')."</a><br></h6><a href='".$row['link']."'>".name('read_el')."</a><br>";
                }
                else{
                    $string .= "<img src = '".$row["cover"]."' alt = 'foto'> <h6>".$row['Name_documents_'.$_SESSION["lang"]]." </h6><a href='".$row['Road_to_documents']."'>".name('download_el')."</a><br></h6><a href='".$row['link']."'>".name('read_el')."</a><br>";
                }
                
            }
            if($row2["main_photo"]!=""){
                $imgkonf = "/adminPanels/".$row2['main_photo'];
            }
            else{
                $imgkonf = "/img/logo/logo2.png";
            }

           
            $el_coll .="<article class='konf el__colection'>
                            <div class='spisok-konf'>
                                <a href='blog-details.php?id=".$value."' class='spisok-konf'><h3>".name('conf')." ".date('Y',strtotime($row2['date']))."</h3></a>
                            </div>
                            <div class = 'cover_konf'>
                            
                            </div>
                            <div class='blog_details el_col'>
                                <div class='cover'>".$string."</div><a class='d-inline-block' href='blog-details.php?id=".$value."'></a>
                            </div>
                            </article>";
            $string='';
            }
        echo $el_coll;
    }
    function anonsDate (){
        include "connect.php";
        $arrayDateAnnouncement=array();
        $anonsBD = mysqli_query($connect,"SELECT conf.`ID_conf`, dat.`date_from`, dat.`text_ru`, conf.`anons_name_".$_SESSION["lang"]."`,  conf.`info_anons_".$_SESSION["lang"]."` FROM `conferences` conf LEFT JOIN `dates` dat ON conf.`ID_conf` = dat.`ID_conf` WHERE DATE(`date_from`) >= CURDATE() and `text_ru` LIKE 'Конференция%'");
        while(($row = mysqli_fetch_assoc($anonsBD)) != false){
            $_SESSION["ID_conf"] = $row["ID_conf"];
            if(!in_array($row['date_from'], $arrayDateAnnouncement) && count($arrayDateAnnouncement)<4){
                $arrayDateAnnouncement[]=$row['date_from'];
                
            }
        }
        if(!empty($arrayDateAnnouncement)){
            // for($i=0,$k=1;$i<count($arrayDateAnnouncement);$i++,$k++){
            //     if($k==1){
            //         $active="class='active show'";
            //     }else{
            //     $active="";
            //     }
            //     $anons.= "<li class='nav-item text-center'><a $active data-toggle='tab' href='#day$k'>
            //     </a></li>";
            // }
            $anons.="<div class='tab-content'>";
            for($i=0,$k=1;$i<count($arrayDateAnnouncement);$i++,$k++){
                if($k==1){
                    $active="active show";
                }else{
                $active="";
                }
                $anons.="<div id='day$k' class='tab-pane $active' >";
                $anonsconf = mysqli_query($connect,"SELECT conf.`ID_conf`, dat.`date_from`, conf.`anons_name_".$_SESSION["lang"]."`,  conf.`info_anons_".$_SESSION["lang"]."` FROM `conferences` conf LEFT JOIN `dates` dat ON conf.`ID_conf` = dat.`ID_conf` WHERE `date_from` = '$arrayDateAnnouncement[$i]'");
                while(($row = mysqli_fetch_assoc($anonsconf)) != false){ 
                    /*if(!empty($row['announcement_foto_speaker'])&&$row['announcement_foto_speaker']!=''){
                        $fotoanons="<img class='boederimg' src='".$row['announcement_foto_speaker']."' alt=''>";
                    } 
                    else{
                        $fotoanons="";
                    }*/
                    $in = $row['info_anons_'.$_SESSION["lang"]];

                    $anons.="<div class='blog_details jojo'><div class='no-gutters card__anons'>
                    <div class='informative__letter'>";
                    
                    $_SESION["ANONS"] = (integer)$row['ID_conf'];
                    $anonsBD_prog = mysqli_query($connect,"SELECT `ID_playbill`, `name_playbill_".$_SESSION["lang"]."`, `road_".$_SESSION["lang"]."`, `ID_conf` FROM `playbill` WHERE `ID_conf` = '".$_SESION["ANONS"]."'");
                   
                    while(($row_prog = mysqli_fetch_assoc($anonsBD_prog)) != false){
                        if ($row_prog['name_playbill_'.$_SESSION["lang"]] != ""){
                        $anons.="<div class = 'anons__prog__footer'>
                            <p class = 'Anons__text__button'>  ".$row_prog['name_playbill_'.$_SESSION["lang"]]."</p>
                                <a href='".$row_prog['road_'.$_SESSION["lang"]]."' class='download__program' download>
                                ".name('download')."
                                </a>
                            </div>";
                        }
                    }
                    $anons.="</div>
                    
                    <div class='content__anons'>

                    <a class='schedule-title' href='#'>
                    <h4 class = 'index__anons__date'>".date('d.m.Y',strtotime($arrayDateAnnouncement[$i]))."</h4>
                    <h3>".$row['anons_name_'.$_SESSION["lang"]]."</h3></a><br>";
                       
                    $plak=explode(PHP_EOL,$in);
                    foreach($plak as $key => $val){
                        if($val!=''){
                            $anons.="\n"."<p class = 'otstyp'>".$val."</p>";
                        }
                    };
                        $anons.= "</div></div></div>";
                }
           
                $anons.='</div>';
            }
        }
        else{
            $anons = "<h1>".name('no_conf')."</h1>";
        }
        echo $anons;
    }
    function contaption__title(){
        include "connect.php";
        $contaption = mysqli_query($connect, "SELECT conf.`an_conception_ru`, conf.`an_conception_en`, yer.`year` FROM `conferences` conf LEFT JOIN `years` yer ON conf.`ID_year` = yer.`ID_year` WHERE `ID_conf` = ".$_SESSION["ID_conf"]);
        while(($row = mysqli_fetch_assoc($contaption)) != false){
            $_SESSION["contaptionYear"] = $row["year"];
            $contaptionTitle = "<h1>".name('conception')." ".$row["year"]."</h1>".$row['an_conception_'.$_SESSION["lang"]];
            $plak=explode(PHP_EOL,$in);
            foreach($plak as $key => $val){
            if($val!=''){
                $contaptionTitle.="\n"."<p class = 'otstyp'>".$val."</p>";
            }
        };
    }
        
        echo $contaptionTitle;
    }
    function contaption__spaeks(){
        include "connect.php";
        $contaption_speak = "<h1 id = 'block1'>".name('speakers')."</h1><div class='contaption__spaeks__list' >";
        $contaption_speaks = mysqli_query($connect, "SELECT `ID_speak`, `ID_conf`, `name_ru`, `name_en`, `photo`, `linkSP_ru`, `linkSP_en`, `info_ru`, `info_en` FROM `speakers` WHERE `ID_conf` = ".$_SESSION["ID_conf"]);
        while(($row = mysqli_fetch_assoc($contaption_speaks)) != false){
            $contaption_speak.= "<div class='contaption__spaek'>
            <a href='#spic' class = 'spik' id = '".$row["ID_speak"]."'>
                <img src='adminPanels/" .$row["photo"]."' alt=''>
                <h4>".$row["name_".$_SESSION["lang"]]."</h4>
                <p>".$row["info_".$_SESSION["lang"]]."</p>
            </a>
            </div>";
        }
        $contaption_speak .= "</div>";
        echo $contaption_speak;
    }
    // Забираем данные для модального окна спикеров
    include "connect.php";
    if(isset($_POST["idSpeak"])){
        $contaption_speaks = mysqli_query($connect, "SELECT `name_ru`, `name_en`, `linkSP_ru`, `linkSP_en`, `info_ru`, `info_en` FROM `speakers` WHERE `ID_speak` = ".$_POST["idSpeak"]);
        $contaption_speaks = mysqli_fetch_assoc($contaption_speaks);
        $arr = array("name" => $contaption_speaks["name_".$_COOKIE["lang"]],"linkSP" => $contaption_speaks["linkSP_".$_COOKIE["lang"]],"info" => $contaption_speaks["info_".$_COOKIE["lang"]]);
        echo json_encode($arr);
        //  exit();
    }


    function contaption__keyDate(){
        include "connect.php";
        if($_SESSION["lang"] == "ru"){
            mysqli_query($connect, "SET lc_time_names = ru_ru");
        }
        $contaption_keyDate = "<h2>".name('dates')."</h2>
        <div class='keysDate'>";
        $contaption_Date = mysqli_query($connect, "SELECT *, DATE_FORMAT(`date_to`, '%M %d, %Y') AS 'date_en', CONCAT(DATE_FORMAT(`date_from`, '%M %d - '), DATE_FORMAT(`date_to`, '%d,'), DATE_FORMAT(`date_from`, ' %Y')) AS 'date_two_en', DATE_FORMAT(`date_to`, 'До %d %M %Y г.') AS 'date_ru', CONCAT(DATE_FORMAT(`date_from`, '%d - '), DATE_FORMAT(`date_to`, '%d %M'), DATE_FORMAT(`date_from`, ' %Y г.')) AS 'date_two_ru' FROM `dates`  WHERE ID_conf = ".$_SESSION['ID_conf']." ORDER BY `date_from` ASC");
        while(($row = mysqli_fetch_assoc($contaption_Date)) != false){
            $contaption_keyDate .= " <div class='keyDate'>";
            if($row["date_from"] == $row["date_to"]){
                $contaption_keyDate .="<h3><span>". $row["date_".$_SESSION["lang"]]."</span></h3>";
            }
            else{
                $contaption_keyDate .="<h3><span>".$row["date_two_".$_SESSION["lang"]]."</span></h3>";
            }
            $contaption_keyDate .="<p>".$row["text_".$_SESSION["lang"]]."</p>
							</div>";
        }
        $contaption_keyDate .= "</div>";
        echo $contaption_keyDate;
    }

    function next__conference(){
        include "connect.php";
        if($_SESSION["lang"] == "ru"){
            mysqli_query($connect, "SET lc_time_names = ru_ru");
        }
        $next__conference = "<div class='next__conference__content'>
        <h2 class = 'next__conference__title'>".name('nextconf')."</h2>
        <h2 class = 'next__conference__date'>";
        //поправки
        $nextContaptionDate = mysqli_query($connect, "SELECT *, DATE_FORMAT(`date_to`, '%M %d, %Y') AS 'date_en', CONCAT(DATE_FORMAT(`date_from`, '%M %d - '), DATE_FORMAT(`date_to`, '%d,'), DATE_FORMAT(`date_from`, ' %Y')) AS 'date_two_en', DATE_FORMAT(`date_to`, '%d %M %Y г.') AS 'date_ru', CONCAT(DATE_FORMAT(`date_from`, '%d - '), DATE_FORMAT(`date_to`, '%d %M'), DATE_FORMAT(`date_from`, ' %Y г.')) AS 'date_two_ru' FROM `dates` WHERE `text_ru` LIKE 'Конференция%' AND `ID_conf` = ".$_SESSION['ID_conf']);
        $nextContaptionDate = mysqli_fetch_assoc($nextContaptionDate);
            if($nextContaptionDate["date_from"] == $nextContaptionDate["date_to"]){
                echo $_SESSION["ID_conf"];
                $next__conference.= $nextContaptionDate["date_".$_SESSION["lang"]];
            }
            else if($nextContaptionDate["date_from"] != $nextContaptionDate["date_to"]){
                $next__conference.= $nextContaptionDate["date_two_".$_SESSION["lang"]];
            }
            else{
                $next__conference = ""; 
            }
        $next__conference.= "</h2>
        </div>";
        echo $next__conference;
    }

    function bread (){
        include "connect.php";
        $cur_url = $_SERVER['REQUEST_URI'];
        $from = "/";
        $to = "?";
        
        function getStringBetween($str,$from,$to)
        {
        $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
        return substr($sub,0,strpos($sub,$to));
        }
        
        $urls = getStringBetween($cur_url,$from,$to);
        
        if ($urls == ""){
        $urls = trim($cur_url, "/");
        }
        
        $crumbs["Путь"][] = name('main');
        $crumbs["Адрес"][] = 'index.php';
        
        if (!empty($urls) && $cur_url != '/') {
        
        switch ($urls) {
        case 'blog.php' :
        $adress_goda = mysqli_query($connect,"SELECT `year` FROM `years` WHERE `ID_year` = ".$_SESSION["year"]);
        $row2 = mysqli_fetch_assoc($adress_goda);
        $crumbs["Путь"][] = name('arch')." "."$row2[year]";
        $crumbs["Адрес"][] = "blog.php?year=$_GET[year]";
        break;
        case 'el_collection.php' :
        $crumbs["Путь"][] = name('collect');
        $crumbs["Адрес"][] = "el_collection.php";
        break;
        case 'blog-details.php' :
        $adress = mysqli_query($connect,"SELECT `ID_conf`, `Name_conf_".$_SESSION["lang"]."`, `ID_year` FROM `conferences` WHERE `ID_conf` = ".$_SESSION["id_konf_blog_detalic"]);
        $row = mysqli_fetch_assoc($adress);
        $adress_goda = mysqli_query($connect,"SELECT `year` FROM `years` WHERE `ID_year` = ".$row["ID_year"] );
        $row2 = mysqli_fetch_assoc($adress_goda);
        $crumbs["Путь"][] = name('arch')." "."$row2[year]";
        $crumbs["Путь"][] = $row['Name_conf_'.$_SESSION["lang"]];
        $crumbs["Адрес"][] = "blog.php?year=$row[ID_year]";
        $crumbs["Адрес"][] = "blog-details.php?id=$row[ID_conf]";
        break;
        }
        
        }
        for($i=0 ; $i < count($crumbs['Путь']) ;$i++ ){
        
        echo "<a href = '".$crumbs['Адрес'][$i]."'>". $crumbs['Путь'][$i]."</a>";
        }  
    }
    
    
?>