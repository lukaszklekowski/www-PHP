<?php
  require_once(__DIR__."/../PHP/HeadGenerator.php");
  require_once(__DIR__."/../PHP/HeaderGenerator.php");
  require_once(__DIR__."/../PHP/SemestersGenerator.php");
  require_once(__DIR__."/../PHP/PageGenerator.php");

  $page_title = "Semestr IV";
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
    "Wprowadzenie_do_Teorii_Grafów" => array(
          array("Poznałem budowę grafów.",
                "Dowiedziałem się co to graf Hamiltona."
          ),
          array("Algorytmu przeszukania grafów.",
                "Więcej na temat zastosowań grafów."
          ),
          array(
            "Wzór Eulera:",
            "Niech $ v = v(G) $, $ \\epsilon = \\epsilon(G) $ i $ \phi = \phi(G) $, wówczas: $$ v - \\epsilon + \phi = 2 $$"
          )),
    "Podstawy_Marketingu" => array(
          array("Zasady które kierują rynkiem.",
                "Jak działa reklama."
          ),
          array("Więcej na temat marketingu.",
                "Więcej na temat praw rządzacych rynkiem."
          )),
    "Komunikacja_Społeczna" => array(
          array("Roli mediów w społeczeństwie.",
                "Zmian które zaszły w społeczeństwie."
          ),
          array("Socjologii.",
                "Psychologii społecznej."
          ))
  );

  $comp_subjects = array(
    "Technologie_Sieciowe" => array(
          array("Zasady działania HTTP.",
                "Zasady działania sieci."
          ),
          array("Poszerzyć swoją wiedzę na temat HTTP.",
                "Poszerzyć swoją wiedzę na temat CRC."
          )),
    "Algorytmy_Metaheurystyczne" => array(
          array("Algorytmu wyszukiwania tabu.",
                "Algorytmu wyżarzania."
          ),
          array("Innych algorytmów metaheurystycznych.",
                "Algorytmów metaheurystycznych."
          )),
    "Języki_i_Paradygmaty_Programowania" => array(
          array("Języka Haskell.",
                "Języka Scheme."
          ),
          array("Nauczyć się więcej na temat języków funkcyjnych.",
                "Nauczyc się więcej na temat Prologa."
          )),
    "Algorytmy_i_Struktury_Danych" => array(
          array("Podstawowe algorytmy sortowania",
                "Podstawowe struktury danych."
          ),
          array("Lepiej obliczać złożoność obliczeniową.",
                "Poznać więcej algorytmów sortowania."
          ))
  );

  $error = false;
  if(!isset($_GET["what"])){
    $error = false;
  }elseif ($_GET["what"] == "error") {
    $error = true;
  }


  $semester = new SemestersGenerator("Semestr IV", "Lato 16/17");
  $math_content = $semester->MathSubject($math_subjects);
  $comp_content = $semester->CompSubject($comp_subjects, count($math_subjects));
  $semester_content = $semester->GenerateSemesterContent($math_content, $comp_content, $error);

  $page = new PageGenerator;
  $created_page = $page->createPage($head, $header, $semester_content);

  echo $created_page;
?>
