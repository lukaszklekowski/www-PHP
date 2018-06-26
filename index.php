<?php
  require_once(__DIR__."/PHP/HeadGenerator.php");
  require_once(__DIR__."/PHP/HeaderGenerator.php");
  require_once(__DIR__."/PHP/IndexGenerator.php");
  require_once(__DIR__."/PHP/PageGenerator.php");

  $page_title = "Moja eduakcja";
  $style_prefix = "./styles/";
  $js_prefix = "./js/";

  $headgenerator = new HeadGenerator;
  $head = $headgenerator->Head($page_title, $style_prefix, $js_prefix);

  $hobby_prefix = "./hobby/";
  $hobbies = array("guitar.php", "football.php");
  $hobbies = array(
    "M2.1" => ["Gitara" ,"guitar.php"],
    "M2.2" => ["Piłka Nożna", "football.php"]
  );
  $index_prefix = "";

  $semester_prefix = "./edu/";
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

  $menus = array("Strona Główna", "Edukacja", "Hobby");
  $headergenerator = new HeaderGenerator;
  $header = $headergenerator->Header($hobbies, $hobby_prefix, $semesters, $semester_prefix, $index_prefix, $menus);

  $image_path = "./photos/img_avatar.png";
  $about_me = "Mam na imię Łukasz i mam 21 lat, oraz jestem studentem trzeciego roku
               na Politechnice Wrocławskiej. Obecnie studiuję informatykę na Wydziale
               Podstawowych Problemów Techniki. Moim hobby są piłka nożna oraz gra na gitarze.
               Na tej stronie znajdziesz informacje o mojej dotychczasowej nauce na studiach oraz
               parę informacji o moich wyżej wymienionych hobby.";

  $index = new IndexGenerator;
  $index_content = $index->Index($about_me,$error);

  $page = new PageGenerator;
  $created_page = $page->createPage($head, $header, $index_content);

  echo $created_page;
?>
