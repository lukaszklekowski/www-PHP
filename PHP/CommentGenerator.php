<?php

require_once(__DIR__."/../webdb/vendor/autoload.php");
require_once(__DIR__."/../webdb/generated-conf/config.php");

$COMMENT =<<<EOT
<div class="comments">
  <div class="nick">
    <h1>{{Nick}}</h1>
  </div>
  <div class="date">
    <p>{{CreatedAt}}</p>
  </div>
  <div class="data">
    <p>{{Data}}</p>
  </div>

</div>
EOT;

$COMMENTARY =<<<EOT
<div class="comen">
<h2 class="year">Dodaj komentarz</h2>
  <form method="post" action="../PHP/dbAdd.php">

    <div class="form-row">
      <label class="type-nick">Twój NICK:</label>
      <input type="text" name="NICK" maxlength="20" placeholder="Wpisz nick" required>
    </div>
    <div class="form-row">
      <label class="type-data">Treść:</label>
      <textarea name="INFO" rows="10" placeholder="Treść komentarza" required></textarea>
    </div>
    <h3 class="captcha-desc">Pokaż, że nie jesteś robotem i oblicz iloczyn skalarny:</h3>
    <div class = "form-row">
    <p>$$ {{1WEK}} \bullet {{2WEK}} $$</p>
      <input class="result" type="text" name="SUM" placeholder="Wpisz wynik" required/>
    </div>
    <div  class="form-row">
      <input id="butt" type="submit" value="Dodaj komentarz" />
    </div>
    <input type="hidden" name="FOLD" value="{{FOLD}}" />
    <input type="hidden" name="TYPE" value="{{SEM}}" />
  </form>
</div>
EOT;

class CommentGenerator{

  function __construct($sem){
    $this->sem = $sem;

  }

  function ShowComm(){
    $comments = OpinionQuery::create()->filterByName($this->sem)->find()->toArray();
    global $COMMENT;
    $ss="";
    foreach($comments as $key => $value){
      $s=$COMMENT;
      foreach($value as $key1 => $value1){
        if($key1=="CreatedAt"){
          $date = substr($value1,0,10);
          $time = substr($value1,11,8);
          $s = str_replace("{{CreatedAt}}", $date."  ".$time,$s);
        }else{
          $s = str_replace("{{".$key1."}}", $value1,$s);
        }
      }
      $ss.=$s;
    }
    return $ss;
  }

  function createComment($folder){
      session_start();

      global $COMMENTARY;
      $c = $COMMENTARY;
      $first1 = rand(0,18)-9;
      $second1 = rand(0,18)-9;
      $firstVec = "[".(string)$first1.",".(string)$second1."]";

      $first2 = rand(0,18)-9;
      $second2 = rand(0,18)-9;
      $secondVec = "[".(string)$first2.",".(string)$second2."]";

      $result = $first1 * $first2 + $second1 * $second2;
      $_SESSION["RESULT"] = $result;
      $c = str_replace(["{{1WEK}}", "{{2WEK}}", "{{SEM}}","{{FOLD}}"],[$firstVec, $secondVec, $this->sem,$folder],$c);
      return $c;
  }
}

 ?>
