<?php
  require_once(__DIR__."/../PHP/HeadGenerator.php");
  require_once(__DIR__."/../PHP/HeaderGenerator.php");
  require_once(__DIR__."/../PHP/HobbyGenerator.php");
  require_once(__DIR__."/../PHP/PageGenerator.php");

  $page_title = "Gitara";
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
  $images = array("gitara.png");

  $desc1 = "Jednym z moich hobby jest gra na gitarze. Rok temu mój współlokator
    nauczył mnie podstaw gry na gitarze i od tego czasu w to \"wsiąknąłem\".
    Nie potrafię jeszcze zbyt wiele, cały czas ćwiczę i staram się rozwijać, ale mogę
    powiedzieć już jedno: jest to bardzo dobry sposób na odprężenie się lub zrobienie sobie
    przerwy od dłuższej pracy.";

  $desc_arr = array($desc1);

  $hobby = new HobbyGenerator("Gra na gitarze");
  $hobby_content = $hobby->hobby($image_path, $images, $desc_arr, $error);

  $page = new PageGenerator;
  $created_page = $page->createPage($head, $header, $hobby_content);

  echo $created_page;
?>
