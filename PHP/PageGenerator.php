<?php

$PAGE =<<<EOT
<!DOCTYPE HTML>
<html lang="pl">
{{HEAD}}
<body>
{{HEADER}}
  {{CONTENT}}
</body>
</html>
EOT;


  class PageGenerator{

    function createPage($head, $header, $content){
      global $PAGE;
      $s = (string)str_replace(["{{HEAD}}", "{{HEADER}}", "{{CONTENT}}"], [$head, $header, $content], $PAGE);
      return preg_replace('/^\h*\v+/m', '', $s);
    }
  }
 ?>
