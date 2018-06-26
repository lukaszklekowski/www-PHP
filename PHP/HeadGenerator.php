<?php

$HEAD =<<<EOT
<head>
<title>{{TITLE}}</title>
<meta charset="UTF-8">
  {{STYLE}}
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name='author' content='Łukasz Klekowski'>
<script type="text/x-mathjax-config">
   MathJax.Hub.Config({
     tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]},
     CommonHTML: { linebreaks: { automatic: true } },
     "HTML-CSS": { linebreaks: { automatic: true } },
     SVG: { linebreaks: { automatic: true } }
   })
 </script>
 <script async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script src='{{JS PREFIX}}js.js'></script>
<script src='{{JS PREFIX}}localStorage.js'></script>
</head>

EOT;


  class HeadGenerator{
    private  $styles = array("compressedHomePage.css");


    function Head($title, $style_prefix, $js_prefix){
      global $HEAD;
      $s = $HEAD;
      $style = "<link rel=\"stylesheet\" type=\"text/css\" href=\"{{STYLE PREFIX}}css/{{STYLE}}\">\n";

      $X = [];
      for ($i = 0; $i < count($this->styles); $i++){
        $X[]= str_replace(["{{STYLE PREFIX}}", "{{STYLE}}"], [$style_prefix, $this->styles[$i]], $style);
      }
      $s = str_replace("{{STYLE}}", join("\n",$X), $s);
      $s = str_replace("{{JS PREFIX}}", $js_prefix, $s);
      $s= str_replace("{{TITLE}}", $title, $s);

      return preg_replace('/^\h*\v+/m', '', $s);
    }
  }
?>
