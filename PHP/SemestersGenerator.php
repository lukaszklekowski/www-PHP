<?php

require_once(__DIR__."/CommentGenerator.php");

$SEMESTER_MATH =<<<EOT
    <div>
    <label class="show-subject background-{{IM ID}}" for="toggle-{{ID}}">
      {{SUBJECT NAME}}
    </label>
    <input type="checkbox" id="toggle-{{ID}}">
    <div class="subject">
      <div class="row">
        <div class="col-3-6">
          <div class="coll-left">
          <div class="label-title">
          <h5>Czego się nauczyłem?</h5>
          </div>
          <div class="label-content">
            <ul>
{{LEARNED}}
            </ul>
          </div>
        </div>
        </div>
        <div class="col-3-6">
          <div class="coll-right">
          <div class="label-title">
          <h5>Czego mogę się jeszcze nauczyć?</h5>
          </div>
          <div class="label-content">
            <ul>
{{WANT TO LEARN}}
            </ul>
          </div>
        </div>
       </div>
     </div>
     <div class="wzorek">
      <p>{{DESCRIPTION}}</p>
      <p>{{EXPRESSION}}</p>
     </div>
    </div>
   </div>
EOT;


$SEMESTER =<<<EOT
    <div>
    <label class="show-subject background-{{IM ID}}" for="toggle-{{ID}}">
      {{SUBJECT NAME}}
    </label>
    <input type="checkbox" id="toggle-{{ID}}">
    <div class="subject">
      <div class="row">
        <div class="col-3-6">
          <div class="coll-left">
          <div class="label-title">
          <h5>Czego się nauczyłem?</h5>
          </div>
          <div class="label-content">
            <ul>
{{LEARNED}}
            </ul>
          </div>
        </div>
        </div>
        <div class="col-3-6">
          <div class="coll-right">
          <div class="label-title">
          <h5>Czego mogę się jeszcze nauczyć?</h5>
          </div>
          <div class="label-content">
            <ul>
{{WANT TO LEARN}}
            </ul>
          </div>
        </div>
       </div>
     </div>
    </div>
   </div>
EOT;


$ERROR =<<<EOT
  <div class="body-container">
    <p class="error">Zła captcha</p>
  </div>
EOT;

$SEMESTER_CONTENT =<<<EOT
{{ERROR}}
<div class="body-container">
  <div class= "semester">
    <h2>{{SEMESTER}}</h2>
  </div>
  <div class="year">
    <h3>{{PERIOD}}</h3>
  </div>
  <div class="content">
 {{MATH}}
 {{LAB}}
 </div>
 </div>
 <div class="body-container">
 <h2 class="semester">Komentarze</h2>
  {{ADD COMM}}
  {{COMM}}
 </div>
<script src='../js/js.js'></script>
EOT;


$MOBILE_SEMESTERS =<<<EOT
<div class="body-container">
  <div class="content">
    <p>
    {{DESC}}
    </p>
    <label class="hobby-semseters" for="toggle-55">
        {{M1.1}}
    </label>
    <input type="checkbox" id="toggle-55">
    <label class="hobby-semseters" for="toggle-54">
        {{M1.2}}
    </label>
    <input type="checkbox" id="toggle-54">
    <label class="hobby-semseters" for="toggle-53">
        {{M1.3}}
    </label>
    <input type="checkbox" id="toggle-53">
    <label class="hobby-semseters" for="toggle-52">
        {{M1.4}}
    </label>
    <input type="checkbox" id="toggle-52">
   <label class="hobby-semseters" for="toggle-51">
        {{M1.5}}
    </label>
    <input type="checkbox" id="toggle-51">
  </div>
</div>
<script src='../js/js.js'></script>
EOT;



class SemestersGenerator{

  function __construct($semester, $period){
    $this->sem = $semester;
    $this->per = $period;
  }



  function GenerateSemesterContent($math_sub, $comp_sub, $error){

    global $SEMESTER_CONTENT, $ERROR;

    $commentGenerator = new CommentGenerator($this->sem);
    $c = $commentGenerator->createComment("edu/");
    $comm = $commentGenerator->showComm();
    if($comm != ""){
      $comm = "<div>
      <div class = \"comen\">\n".
"      ".$comm."
      </div>
      </div>";
    }
    $s = $SEMESTER_CONTENT;
    if($error == false){
      $s = str_replace(["{{SEMESTER}}", "{{PERIOD}}", "{{MATH}}", "{{LAB}}","{{ADD COMM}}","{{COMM}}", "{{ERROR}}"],
                     [$this->sem, $this->per, $math_sub, $comp_sub, $c, $comm, ""],
                     $s);
    }else{
      $s = str_replace(["{{SEMESTER}}", "{{PERIOD}}", "{{MATH}}", "{{LAB}}","{{ADD COMM}}","{{COMM}}","{{ERROR}}"],
                       [$this->sem, $this->per, $math_sub, $comp_sub, $c, $comm, $ERROR],
                       $s);
    }


    return preg_replace('/^\h*\v+/m', '', $s);
  }

  function MathSubject($subjects){
    $learned = "               <li>{{VAL}}</li>\n";
    $id = 0;
    global $SEMESTER_MATH;
    $semesters = "";
    foreach($subjects as $key => $value){
      $s = $SEMESTER_MATH;
      $subject = str_replace('_',' ',$key);
      $s = str_replace('{{SUBJECT NAME}}',$subject,$s);
      $s = str_replace(["{{ID}}", "{{IM ID}}"],[(string)$id, "1" ],$s);

      $X = [];
      for ($i = 0; $i < count($value[0]); $i++){
        $X[]= str_replace("{{VAL}}", $value[0][$i], $learned);
      }
      $s = str_replace("{{LEARNED}}", join("\n",$X), $s);

      $X = [];
      for ($i = 0; $i < count($value[1]); $i++){
        $X[]= str_replace("{{VAL}}", $value[1][$i], $learned);
      }
      $s = str_replace("{{WANT TO LEARN}}", join("\n",$X), $s);
      $s = str_replace("{{DESCRIPTION}}", $value[2][0],$s);
      $s = str_replace("{{EXPRESSION}}", $value[2][1],$s);
      $semesters.= $s;
      $id++;
    }


    return preg_replace('/^\h*\v+/m', '', $semesters);
  }


    function CompSubject($subjects, $start_from){
      $learned = "               <li>{{VAL}}</li>\n";
      $id = $start_from;
      global $SEMESTER;
      $semesters = "";
      foreach($subjects as $key => $value){
        $s = $SEMESTER;
        $subject = str_replace('_',' ',$key);
        $s = str_replace('{{SUBJECT NAME}}',$subject,$s);
        $s = str_replace(["{{ID}}", "{{IM ID}}"],[(string)$id, "2" ],$s);

        $X = [];
        for ($i = 0; $i < count($value[0]); $i++){
          $X[]= str_replace("{{VAL}}", $value[0][$i], $learned);
        }
        $s = str_replace("{{LEARNED}}", join("\n",$X), $s);

        $X = [];
        for ($i = 0; $i < count($value[1]); $i++){
          $X[]= str_replace("{{VAL}}", $value[1][$i], $learned);
        }
        $s = str_replace("{{WANT TO LEARN}}", join("\n",$X), $s);

        $semesters.= $s;
        $id++;
      }
    return preg_replace('/^\h*\v+/m', '', $semesters);
  }


  function mobileSemesterGenerator($semesters, $description){
    global $MOBILE_SEMESTERS;
    $s = $MOBILE_SEMESTERS;
    $s = (string) str_replace("{{DESC}}", $description, $s);
    $menu_semesters = "<a href=\"{{SEMESTER}}\">{{SEMESTER NAME}}</a>\n";
    foreach ($semesters as $key => $value) {
      $mkey = "{{" . $key . "}}";
      $item = (string) str_replace(["{{SEMESTER}}", "{{SEMESTER NAME}}"],[$value[1], $value[0]], $menu_semesters);
      $s = (string) str_replace($mkey, $item, $s);
    }
  return preg_replace('/^\h*\v+/m', '', $s);
  }
}
?>
