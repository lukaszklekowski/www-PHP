<?php
  require_once(__DIR__."/../PHP/HeadGenerator.php");
  require_once(__DIR__."/../PHP/HeaderGenerator.php");
  require_once(__DIR__."/../PHP/HobbyGenerator.php");
  require_once(__DIR__."/../PHP/PageGenerator.php");

  $page_title = "Piłka Nożna";
  $style_prefix = "../styles/";
  $js_prefix = "../js/";
  $headgenerator = new HeadGenerator;
  $head = $headgenerator->Head($page_title, $style_prefix, $js_prefix);

  $hobby_prefix = "";
  $hobbies = array(
    "M2.1" => ["Gitara" ,"guitar.php"],
    "M2.2" => ["Piłka Nożna", "football.php"]
  );

  $index_prefix = "../";

  $semester_prefix = "../edu/";
  $semesters = array(
    "M1.1" =>["SEMESTR I", "semesterI.php"],
    "M1.2" =>["SEMESTR II", "semesterII.php"],
    "M1.3" => ["SEMESTR III", "semesterIII.php"],
    "M1.4" => ["SEMESTR IV", "semesterIV.php"],
    "M1.5" => ["SEMESTR V", "semesterV.php"]
  );

  $error = false;
  if(!isset($_GET["what"])){
    $error = false;
  }elseif ($_GET["what"] == "error") {
    $error = true;
  }

  $headergenerator = new HeaderGenerator;
  $menus = array("Strona Główna", "Edukacja", "Hobby");
  $header = $headergenerator->Header($hobbies, $hobby_prefix, $semesters, $semester_prefix, $index_prefix, $menus);

  $image_path = "../photos/";
  $images = array("pilka.png", "manutd.png");

  $desc1 = "Moim kolejnym hobby jest piłka nożna. Interesuję się nią od dziecka.
            Zawsze gdy tylko przytrafia się okazja, korzystam z niej aby choć trochę
            zagrać. Częrpę z niej bardzo dużo radości. Jest to bardzo dobry sposób
            na odreagowanie, wyluzowanie czy na to aby choć na chwilę zapomnieć o problemach.";
  $desc2 = "Moim ulubionym klubem jest Mancherster United. Kibicuję im odkąd pamiętam. Od
            odejścia sir Alexa Fegusona nie idzie im najlepiej, lecz mam nadzieję, że od
            kolejnego sezonu będzie lepiej - zdanie wypowiadane przez każdego kibica każdego klubu co każdy sezon.";

  $desc_arr = array($desc1, $desc2);

  $hobby = new HobbyGenerator("Piłka Nożna");
  $hobby_content = $hobby->hobby($image_path, $images, $desc_arr, $error);

  $page = new PageGenerator;
  $created_page = $page->createPage($head, $header, $hobby_content);

  echo $created_page;
?>
