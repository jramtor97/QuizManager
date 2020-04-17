<div id="items">
    <input type="radio" name="options" value="input1"> Is Correct: <input type="radio" name="is_correct" value="yes"/> <br><br>
    <input type="radio" name="options" value="input2"> Is Correct: <input type="radio" name="is_correct" value="yes"/>
</div>

<button type="button" onclick="registrarRes()">Terminar cuestionario</button>

<?php

echo $_POST['input1'];
echo "<br>";
echo $_POST['is_correct'];
echo "<br>";

$nam=$_POST['input1'];
$answer=$_POST[$nam];
echo $nam;
echo "<br>";
echo $answer;
?>
	