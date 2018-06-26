<?php
  require_once(__DIR__."/../PHP/HeadGenerator.php");
  require_once(__DIR__."/../PHP/HeaderGenerator.php");
  require_once(__DIR__."/../PHP/SemestersGenerator.php");
  require_once(__DIR__."/../PHP/PageGenerator.php");

  $page_title = "Semestr III";
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
$menus = array("Strona Główna", "Edukacja", "Hobby");
  $semester_prefix = "";
  $semesters = array(
    "M1.1" =>["SEMESTR I", "semesterI.php"],
    "M1.2" =>["SEMESTR II", "semesterII.php"],
    "M1.3" => ["SEMESTR III", "semesterIII.php"],
    "M1.4" => ["SEMESTR IV", "semesterIV.php"],
    "M1.5" => ["SEMESTR V", "semesterV.php"]
  );
  $headergenerator = new HeaderGenerator;
  $header = $headergenerator->Header($hobbies, $hobby_prefix, $semesters, $semester_prefix, $index_prefix, $menus);

  $math_subjects = array(
    "Metody_Probabilistyczne_i_Statystyka" => array(
          array("Obliczanie prawdopodobieństwa.",
                "Kombinatoryka."
          ),
          array("Więcej na temat kombinatoryki.",
                "Więcej na temat przestrzeni probabilistycznych."
          ),
          array(
            "Miara Lebesgue'a:",
            "Istnieje miara $ \lambda: B(\mathbb{R}) \\rightarrow [0,\infty] $ o tej własności, że $
            \lambda((a,b)) = b-a$"
          ))
  );

  $comp_subjects = array(
    "Bazy_Danych_i_Systemy_Informacyjne" => array(
          array("Algebry Relacji.",
                "Podstaw SQL."
          ),
          array("Więcej na temat SQL.",
                "Nauczyć się nierelacyjnych baz danych."
          )),
    "Technologia_Programowania" => array(
          array("Dokładniej poznałem język Java.",
                "Nauczyłem się podstawowych wzorców projektowych."
          ),
          array("Poznać więcej wzorców projektowych.",
                "Poznać jeszcze dokładniej Javę."
          )),
    "Architektura_Komputerów_i_Systemy_Operacyjne" => array(
          array("Dokładniej poznałem język C.",
                "Permutacji."
          ),
          array("Więcej na temat grafów.",
                "Dokładniej poznałem system Linux."
          ))
  );
  $error = false;
  if(!isset($_GET["what"])){
    $error = false;
  }elseif ($_GET["what"] == "error") {
    $error = true;
  }


  $semester = new SemestersGenerator("Semestr III", "Zima 16/17");
  $math_content = $semester->MathSubject($math_subjects);
  $comp_content = $semester->CompSubject($comp_subjects, count($math_subjects));
  $semester_content = $semester->GenerateSemesterContent($math_content, $comp_content, $error);

  $page = new PageGenerator;
  $created_page = $page->createPage($head, $header, $semester_content);

  echo $created_page;
?>
