<?php
$students = [
    [ "name" => "Nguyen Van An", "age" => 20, "score" => 8.5 ],
    [ "name" => "Tran Thi Binh", "age" => 21, "score" => 6.5 ],
    [ "name" => "Le Van Cuong", "age" => 19, "score" => 4.5 ],
    [ "name" => "Pham Thi Dung", "age" => 20, "score" => 7.5 ]
];
function calculateAverageScore($students){
    $total = 0;
    foreach ($students as $student){
        $total = $total + $student["score"];
    }
    return $total/count($students);
}

function displayStudent($student){
    $rank = getRank($student['score']);
     echo $student['name']. " " . $student['age']. " ". $student['score']. " " . $rank . "<br>";
}
function getRank($score){
    if ($score >= 8){
        return "Gioi";
    } elseif ($score >= 6.5){
        return "Kha";
    } elseif ($score >= 5){
        return "Trung binh";
    } elseif ($score < 5){
        return "Yeu";
    }

}
$n = calculateAverageScore($students);
echo "Diem trung binh: " . $n . "<br>";
foreach ($students as $student){
    displayStudent($student);
}

?>