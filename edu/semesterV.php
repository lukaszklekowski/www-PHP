<?php
  require_once(__DIR__."/../PHP/HeadGenerator.php");
  require_once(__DIR__."/../PHP/HeaderGenerator.php");
  require_once(__DIR__."/../PHP/SemestersGenerator.php");
  require_once(__DIR__."/../PHP/PageGenerator.php");

  $page_title = "Semestr V";
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
    "Kryptografia" => array(
          array("Podstawowe szyfry blokowe.",
                "Szyfry strumieniowe."
          ),
          array("Dowiedzieć się więcej na temat szyfrów.",
                "Poznać dokładniej poznane szyfry."
          ),
          array(
              "Funkcja Eulera:",
              "$$ \phi(n) = (p - 1)(q - 1) $$"
          )),
    "Wprowadzenie_do_Topologii_i_Teorii_Miar" => array(
          array("Poznałem metryki.",
                "Podstaw teorii miar."
          ),
          array("Zastosowań metryk.",
                "Więcej na temat topologii."
          ),
          array(
            "Ciągłość funkcji wg. Cauchy",
            "$$ |x_0 - x| < \delta \Rightarrow |f(x_0) - f(x)| < \\epsilon $$"
          ))
  );

  $comp_subjects = array(
    "Programowanie_Zespołowe" => array(
          array("Języka Elixir.",
                "Problemów które można napotkać podczas pracy w zespole."
          ),
          array("Chciałbym poznać dokładniej język Elixir.",
                "Lepszej organizacji pracy."
          )),
    "Metody_Wytwarzania_Oprogramowania" => array(
          array("Sposoby wytwarzania oprogramowania.",
                "Zarządzanie Zasobami."
          ),
          array("Lepszej komunikacji w zespole.",
                "Lepiej szacować czas."
          )),
    "Obliczenia_Naukowe" => array(
          array("Obliczanie układów liniowych za pomocą macierzy.",
                "Poznanie standardu IEEE 754."
          ),
          array("Więcej na temat fraktali.",
                "Pisanie programów bezpieczych numerycznie."
          )),
    "Języki_Formalne_i_Techniki_Translacji" => array(
          array("Wykazywanie własności języka.",
                "Budowanie automatów."
          ),
          array("Poznać lepiej budowę kompilatora.",
                "Budować szybciej parsery."
          ))
  );
  $error = false;
  if(!isset($_GET["what"])){
    $error = false;
  }elseif ($_GET["what"] == "error") {
    $error = true;
  }


  $semester = new SemestersGenerator("Semestr V", "Zima 17/18");
  $math_content = $semester->MathSubject($math_subjects);
  $comp_content = $semester->CompSubject($comp_subjects, count($math_subjects));
  $semester_content = $semester->GenerateSemesterContent($math_content, $comp_content, $error);

  $page = new PageGenerator;
  $created_page = $page->createPage($head, $header, $semester_content);

  echo $created_page;
?>
