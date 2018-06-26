<?php
  require_once(__DIR__."/../PHP/HeadGenerator.php");
  require_once(__DIR__."/../PHP/HeaderGenerator.php");
  require_once(__DIR__."/../PHP/HobbyGenerator.php");
  require_once(__DIR__."/../PHP/PageGenerator.php");

  $page_title = "Hobby";
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

  $headergenerator = new HeaderGenerator;
  $menus = array("Strona Główna", "Edukacja", "Hobby");
  $header = $headergenerator->Header($hobbies, $hobby_prefix, $semesters, $semester_prefix, $index_prefix, $menus);

  $image_path = "../photos/";
  $images = array("gitara.png");

  $desc = "Oto moje niektóre hobby, które pozwalają mi się odprężyć i zapomnieć o codzienności:";

  $hobby = new HobbyGenerator("Gra na gitarze");
  $hobby_content = $hobby->mobileHobby($hobbies, $desc);

  $page = new PageGenerator;
  $created_page = $page->createPage($head, $header, $hobby_content);

  echo $created_page;
?>
