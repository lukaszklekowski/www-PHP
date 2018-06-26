<?php
  require_once(__DIR__."/../PHP/HeadGenerator.php");
  require_once(__DIR__."/../PHP/HeaderGenerator.php");
  require_once(__DIR__."/../PHP/SemestersGenerator.php");
  require_once(__DIR__."/../PHP/PageGenerator.php");

  $page_title = "Semestr II";
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
    "Analiza_Matematyczna_II" => array(
          array("Podstawowych metryk.",
                "Obliczania pochodnych z wieloma zmiennymi."
          ),
          array("Zastosowania poznanych metryk.",
                "Lepiej i szybciej obliczać całki podwójne."
          ),
          array(
            "Metryka euklidesowa w $ \mathbb{R}^{3} $:",
            "$$ d(A,B) = \sqrt{(x_A - x_B)^2 + (y_A - y_B)^2 + (z_A - z_B)^2} $$"
          )),
    "Algebra_Abstrakcyjna_i_Kodowanie" => array(
          array("Operacji w ciałach.",
                "Chińskiego twierdzenia o resztach."
          ),
          array("Więcej na temat ciał i pierścieni.",
                "Dodatkowych algorytmów kodowania."
          ),
          array(
            "Działanie $ \bullet $ określone w zbiorze $ X $ jest łączne jeżeli dla dowolnych $ x,y,z \in X $ zachodzi równość:",
            "$$ (x \bullet y) \bullet z = x \bullet (y \bullet z) $$"
          )),
    "Matematyka_Dyskretna" => array(
          array("Podstaw grafów.",
                "Permutacji."
          ),
          array("Więcej na temat grafów.",
                "Więcej na temat funkcji tworzących."
          ),
          array(
            "Ciąg Fibonnaciego:",
            "$$ a_0 = 0, a_1 = 1, a_n = a_{n-1} + a_{n-2} $$ "
          )),
    "Problemy_Prawne_Informatyki" => array(
          array("Prawa licencyjnego",
                "Głównych problemów, które mogą wystąpić przy zakładaniu firmy."
          ),
          array("Więcej na temat prawa patentowego.",
                "Więcej na temat prawa licencyjnego."
          )),
    "Fizyka" => array(
          array("Podstaw fizyki relatywistycznej.",
                "Dynamiki."
          ),
          array("Fizyki kwantowej.",
                "Więcej na temat fizyki relatywistycznej."
          ))
  );

  $comp_subjects = array(
    "Kurs_Programowania" => array(
        array("Podstawy języka Java.",
              "Tworzenie GUI w Javie."
        ),
        array("Zwiększyć swoją wiedzę o Javie.",
              "Nauczyć sie więcej o języku C++."
        ))
  );
  $error = false;
  if(!isset($_GET["what"])){
    $error = false;
  }elseif ($_GET["what"] == "error") {
    $error = true;
  }

  $semester = new SemestersGenerator("Semestr II", "Lato 15/16");
  $math_content = $semester->MathSubject($math_subjects);
  $comp_content = $semester->CompSubject($comp_subjects, count($math_subjects));
  $semester_content = $semester->GenerateSemesterContent($math_content, $comp_content, $error);

  $page = new PageGenerator;
  $created_page = $page->createPage($head, $header, $semester_content);

  echo $created_page;
?>
