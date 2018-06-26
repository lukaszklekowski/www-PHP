<?php
  require_once(__DIR__."/../PHP/HeadGenerator.php");
  require_once(__DIR__."/../PHP/HeaderGenerator.php");
  require_once(__DIR__."/../PHP/SemestersGenerator.php");
  require_once(__DIR__."/../PHP/PageGenerator.php");
  require_once(__DIR__."/../webdb/vendor/autoload.php");
  require_once(__DIR__."/../webdb/generated-conf/config.php");

  // use Monolog\Logger;
  // use Monolog\Hnadler\StreamHandler;
  //
  // $defaultLogger = new Logger('defaultLogger');
  // $defaultLogger->pushHandler(new StreamHandler('/var/log/propel.log', Logger::WARNING));
  //
  // $serviceContainer->setLogger('defaultLogger', $defaultLogger);
  $page_title = "Semestr I";
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
    "Analiza_Matematyczna_I" =>  array(
          array("Dowiedziałem się co to szerego potęgowy.",
                "Nauczyłem się całkować."
          ),
          array("Mogę nauczyć się terorii funkcji zmiennej zespolonej.",
                "Chciałbym nauczyć się wyliczać ekstrema funkcji o dwóch lub więcej zmiennych."
          ),
          array(
            "Podstawowy wzór Rachunku Różniczkowgo i Całkowego",
            "$$\\frac{d}{dx} \int\limits_{a}^{x} f(t) dt = f(x)$$"
          )),
    "Logika_i_Struktury_Formalne" => array(
          array("Rachunków na zbiorach.",
                "Co to jest tautologia."
          ),
          array("Więcej na temat struktur formalnych.",
                "Więcej na temat policzalności zbiorów."
          ),
          array(
            "Różnowartościowość funkcji - iniekcja",
            "$$(\\forall_{x,y})(f(x) = f(y) \\rightarrow x = y)$$"
          )),
    "Algebra_z_Geometrią_Analityczną" => array(
          array("Co to są grupy, pierścienie i ciała.",
                "Co to jest wartość własna odwzorowania liniowego."
          ),
          array("Własności macierzy hermitowskich.",
                "Ortogonalizacji."
          ),
          array(
            "Wzór Eulera",
            "$$ e^{i t} = \cos(t) + i\sin(t)$$"
          ))
  );

  $comp_subjects = array(
    "Wstęp_do_Informatyki_i_Programowania" => array(
        array("Podstawowych pojęć informatycznych.",
              "Podstaw języka C."
        ),
        array("Więcej na temat języka C.",
              "Operacji na wskaźnikach."
        ))
  );
  $error = false;
  if(!isset($_GET["what"])){
    $error = false;
  }elseif ($_GET["what"] == "error") {
    $error = true;
  }

  $semester = new SemestersGenerator("Semestr I", "Zima 15/16");
  $math_content = $semester->MathSubject($math_subjects);
  $comp_content = $semester->CompSubject($comp_subjects, count($math_subjects));
  // $commentary = $semester->ShowComm();
  $semester_content = $semester->GenerateSemesterContent($math_content, $comp_content, $error);

  $page = new PageGenerator;
  $created_page = $page->createPage($head, $header, $semester_content);

  echo $created_page;
?>
