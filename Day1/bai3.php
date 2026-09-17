<?php
$students = [
    [ "name" => "Nguyen Van An", "age" => 20, "score" => 8.5 ],
    [ "name" => "Tran Thi Binh", "age" => 21, "score" => 6.5 ],
    [ "name" => "Le Van Cuong", "age" => 19, "score" => 4.5 ],
    [ "name" => "Pham Thi Dung", "age" => 20, "score" => 7.5 ]
];
function findBestStudent($students){
    $max = $students[0];
    foreach ($students as $student){
        if ($student['score'] > $max['score']){
            $max = $student;
        }
    }
    return $max;
}
function findWorstStudent($students){
    $min = $students[0];
    foreach ($students as $student){
        if ($student['score'] < $min['score']){
            $min = $student;
        }
    }
    return $min;
}
function countPassedStudent($students){
    $c = 0;
    foreach ($students as $student){
        if ($student['score'] >= 5){
            $c = $c + 1;
        }
    }
    return $c;
}
function findStudentByName($students, $name){
    foreach ($students as $student){
        if (strcmp($student['name'], $name) == false){
            return $student;
        }
    }
}
$best = findBestStudent($students);
$worse = findWorstStudent($students);
$c = countPassedStudent($students);
$found = findStudentByName($students, "Nguyen Van An");

echo "best: " . $best['name'] . " | worst: " . $worse['name'] . " | c: " . $c . " | ";

if ($found !== null) {
    echo "name: " . $found['name'];
} else {
    echo "name: Không tìm thấy sinh viên nào";
}
?>