<?php
require_once(__DIR__."/CommentGenerator.php");


$HOBBY =<<<EOT
{{ERROR}}
<div class="body-container">
  <div class= "semester">
    <h3>{{HOBBY}}</h3>
  </div>
      {{HOBBIES}}
</div>
<div class="body-container">
  <h2 class="semester">Komentarze</h2>
    {{ADD COMM}}
  {{COMM}}
</div>
<script src='../js/js.js'></script>
EOT;

$ERROR =<<<EOT
  <div class="body-container">
    <p class="error">Zła captcha</p>
  </div>
EOT;

$HOBBY_MOBILE =<<<EOT
<div class="body-container">
  <div class="content">
    <p>
    {{DESCRIPTION}}
    </p>
    <label class="hobby-semseters" for="toggle-55">
        {{M2.1}}
    </label>
    <input type="checkbox" id="toggle-55">
    <label class="hobby-semseters" for="toggle-54">
      {{M2.2}}
    </label>
    <input type="checkbox" id="toggle-54">
  </div>
</div>
<script src='../js/js.js'></script>
EOT;


class HobbyGenerator{

  function __construct($hobby){
    $this->hobby = $hobby;
  }

  function hobby($images_path, $images, $descriptions, $error){
    global $HOBBY, $ERROR;
    $temp = "";
    $s = str_replace("{{HOBBY}}", $this->hobby, $HOBBY);
    for($i=0; $i<count($images); $i++){
            $temp.= " <div class=\"image\">\n";
            $temp.= "    <img src=".$images_path.$images[$i]." alt=\"logo\">\n";
            $temp.= "  </div>\n";
            $temp.= "  <div class=\"content\">\n";
            $temp.= "    <p>\n";
            $temp.= "       ".$descriptions[$i]."\n";
            $temp.= "    </p>\n";
            $temp.= "  </div>\n";
          }
    $commentGenerator = new CommentGenerator($this->hobby);
    $c = $commentGenerator->createComment("hobby/");
    $comm = $commentGenerator->showComm();
    if($comm != ""){
      $comm = "<div>
      <div class = \"comen\">\n".
"      ".$comm."
      </div>
      </div>";
    }
    if($error == false){
      $s = str_replace(["{{HOBBIES}}","{{ADD COMM}}", "{{COMM}}","{{ERROR}}"], [$temp,$c,$comm,""], $s);

    }else{
      $s = str_replace(["{{HOBBIES}}","{{ADD COMM}}", "{{COMM}}","{{ERROR}}"], [$temp,$c,$comm,$ERROR], $s);

    }
    return preg_replace('/^\h*\v+/m', '', $s);
  }

  function mobileHobby($hobbies, $description){

    global $HOBBY_MOBILE;
    $s = $HOBBY_MOBILE;
    $s = (string) str_replace("{{DESCRIPTION}}", $description, $s);
    $hobby = "<a href=\"{{HOBBY}}\">{{HOBBY NAME}}</a>\n";
    foreach ($hobbies as $key => $value) {
      $mkey = "{{" . $key . "}}";
      $item = (string) str_replace(["{{HOBBY}}", "{{HOBBY NAME}}"],[$value[1], $value[0]], $hobby);
      $s = (string) str_replace($mkey, $item, $s);
    }
  return preg_replace('/^\h*\v+/m', '', $s);
  }
}
?>
