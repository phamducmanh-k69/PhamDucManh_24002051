<?php
$name = "Michael Jackson";
$score = 10;
$grade = "";
if ($score >= 8){
    $grade = "Giỏi";
} elseif ($score >= 6.5 && $score < 8){
    $grade = "Khá";
} elseif ($score >=5 && $score < 6.5){
    $grade = "Trung bình";
} elseif ($score < 5){
    $grade = "Yếu";
}
echo "Name: " . $name . "<br>";
echo "Score: " . $score . "<br>";
echo "Grade: " . $grade . "<br>";
?>