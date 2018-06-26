<?php
  require_once(__DIR__."/../PHP/HeadGenerator.php");
  require_once(__DIR__."/../PHP/HeaderGenerator.php");
  require_once(__DIR__."/../PHP/SemestersGenerator.php");
  require_once(__DIR__."/../PHP/PageGenerator.php");

  $page_title = "Moja Edukacja";
  $style_prefix = "../styles/";
  $js_prefix = "../js/";
  $headgenerator = new HeadGenerator;
  $head = $headgenerator->Head($page_title, $style_prefix, $js_prefix);

  $hobby_prefix = "../hobby/";
  $hobbies = array(
    "M2.1" => ["Gitara" ,"guitar.php"],
    "M2.2" => ["Piłka Nożna", "football.php"]
  );
  $index_prefix = "../";

  $semester_prefix = "";
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

  $desc = "  Oto moje kursy w których brałem udział przez ostatnie 3 lata pogrupowane w odpowiednie semestry";

  $semester = new SemestersGenerator("", "");
  $semester_content = $semester->mobileSemesterGenerator($semesters, $desc);

  $page = new PageGenerator;
  $created_page = $page->createPage($head, $header, $semester_content);

  echo $created_page;
?>
