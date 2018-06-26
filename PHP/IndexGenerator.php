<?php

require_once(__DIR__."/CommentGenerator.php");

$INDEX =<<<EOT
{{ERROR}}
<div class="body-container">
  <div class="image">
   <img id="myimage" src="" alt="">
  </div>
  <div class="content">
    <p>
      {{ABOUT}}
    </p>
 </div>
</div>
<div class="body-container">
  <h2 class="semester">Komentarze</h2>
   {{ADD COMM}}
  {{COMM}}
</div>
<script src='../js/js.js'></script>
<script src='../js/localStorage.js'></script>
<script>
  var myImg = new ImageLoader("myimage", "myPhoto", "../photos/img_avatar.png", "avatar");
  myImg.loadImage();
</script>
EOT;

$ERROR =<<<EOT
  <div class="body-container">
    <p class="error">Zła captcha</p>
  </div>
EOT;

class IndexGenerator{
  function Index($about_me, $error){
    global $INDEX, $ERROR;

    $commentGenerator = new CommentGenerator("Index");
    $c = $commentGenerator->createComment("");
    $comm = $commentGenerator->showComm();
    if($comm != ""){
      $comm = "<div>
      <div class = \"comen\">\n".
"      ".$comm."
      </div>
      </div>";
    }
    if($error == false){
      $s = (string) str_replace(["{{ABOUT}}","{{ADD COMM}}","{{COMM}}","{{ERROR}}"], [$about_me, $c, $comm, "" ], $INDEX);

    }else{
      $s = (string) str_replace(["{{ABOUT}}","{{ADD COMM}}","{{COMM}}","{{ERROR}}"], [$about_me, $c, $comm, $ERROR], $INDEX);

    }

    return preg_replace('/^\h*\v+/m', '', $s);
  }
}
?>
