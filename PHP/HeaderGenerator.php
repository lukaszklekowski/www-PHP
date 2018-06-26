<?php

$HEADER =<<<EOT
<header class="head">
  <div class = "dim">
    <div class="head_container">
      <div class="site_name">
        <h1>{{SITE NAME}}</h1>
      </div>
      <div class="site_desc">
        <h3>{{SITE DESCRIPTION}}</h3>
      </div>
    </div>
    <nav class="mob-navigation">
        <ul class="mob-menu">
          <li id="mob-menu-item" class="mob-menu-item">
            <p>MENU</p>
            <div id="mob-dropdown-content" class="mob-dropdown-content">
              <a href="{{INDEX PREFIX}}index.php">{{MENU I}}</a>
              <a href="{{SEMESTER PREFIX}}semesters.php">{{MENU II}}</a>
              <a href="{{HOBBY PREFIX}}hobbies.php">{{MENU III}}</a>
            </div>
          </li>
        </ul>
    </nav>
    <nav id="navigation" class="navigation">
        <ul class="menu">
          <li class="menu_item">
                <a href="{{INDEX PREFIX}}index.php">{{MENU I}}</a>
          </li>
          <li class="menu_item">
              <a>{{MENU II}}</a>
              <div class="dropdown-content">
                  {{M1.1}}
                  {{M1.2}}
                  {{M1.3}}
                  {{M1.4}}
                  {{M1.5}}
              </div>
          </li>
          <li class="menu_item">
            <a>{{MENU III}}</a>
            <div class="dropdown-content">
              {{M2.1}}
              {{M2.2}}
            </div>
          </li>
        </ul>
    </nav>
  </div>
</header>
<nav id="nav" class="scroll-nav">
  <ul class="scroll-menu">
    <li class="scroll-menu-item">
         <a href="{{INDEX PREFIX}}index.php">{{MENU I}}</a>
    </li>
    <li class="scroll-menu-item">
      <a>{{MENU II}}</a>
      <div class="scroll-dropdown-content">
          {{M1.1}}
          {{M1.2}}
          {{M1.3}}
          {{M1.4}}
          {{M1.5}}
      </div>
    </li>
    <li class="scroll-menu-item">
      <a>{{MENU III}}</a>
      <div class="scroll-dropdown-content">
        {{M2.1}}
        {{M2.2}}
      </div>
    </li>
  </ul>
</nav>

EOT;

  class HeaderGenerator{

    function __construct(){
      $this->name = "Łukasz Klekowski";
      $this->desc = "Moja przygoda z edukacją";
    }

    function Header($hobbies, $hobby_prefix, $semesters, $semesters_prefix, $index_prefix, $menus){
      global $HEADER;
      $menu_semesters = "<a href=\"{{SEMESTER PREFIX}}{{SEMESTER}}\">{{SEMESTER NAME}}</a>";
      $menu_hobby = "<a href=\"{{HOBBY PREFIX}}{{HOBBY}}\">{{HOBBY NAME}}</a>";
      $s = $HEADER;

      foreach ($semesters as $key => $value) {
        $mkey = "{{" . $key . "}}";
        $item = (string) str_replace(["{{SEMESTER PREFIX}}", "{{SEMESTER}}", "{{SEMESTER NAME}}"],[$semesters_prefix, $value[1], $value[0]], $menu_semesters);
        $s = (string) str_replace($mkey, $item, $s);
      }


      foreach ($hobbies as $key => $value) {
        $mkey = "{{" . $key . "}}";
        $item = (string) str_replace(["{{HOBBY PREFIX}}", "{{HOBBY}}", "{{HOBBY NAME}}"],[$hobby_prefix, $value[1], $value[0]], $menu_hobby);
        $s = (string) str_replace($mkey, $item, $s);
      }

      $s = str_replace("{{SITE NAME}}", $this->name, $s);
      $s = str_replace("{{SITE DESCRIPTION}}", $this->desc, $s);
      $s = str_replace(["{{MENU I}}", "{{MENU II}}", "{{MENU III}}"], [$menus[0], $menus[1], $menus[2]], $s);
      $s = str_replace(["{{INDEX PREFIX}}","{{HOBBY PREFIX}}","{{SEMESTER PREFIX}}"], [$index_prefix, $hobby_prefix, $semesters_prefix], $s);

      return preg_replace('/^\h*\v+/m', '', $s);
    }
  }


?>
