<?php
class Student{
    public $name;
    public $age;
    public $score;
    public function __construct($name, $age, $score){
        $this->name = $name;
        $this->age = $age;
        $this->score = $score;
    }
    public function getRank(){
        if ($this->score >= 8){
            return "Gioi";
        } elseif ($this->score >= 6.5){
            return "Kha";
        } elseif ($this->score >= 5){
            return "Trung binh";
        } elseif ($this->score < 5){
            return "Yeu";
        }
    }
    public function isPassed(){
        return $this->score >= 5.0;
    }
    
    public function display(){
        $status = $this->isPassed() ? "Đạt" : "Không đạt";
        echo "Tên: " . $this->name . "<br>";
        echo "Tuổi: " . $this->age . "<br>";
        echo "Điểm: " . $this->score . "<br>";
        echo "Xếp loại: " . $this->getRank() . "<br>";
        echo "Trạng thái: " . $status . "<br>";
    }

}
 // Function xử lý riêng
function findBestStudent($students){
    if (empty($students)) return null;
    $max = $students[0];
    foreach ($students as $student){
        if ($student->score > $max->score){
            $max = $student;
        }
    }
    return $max;
}
function countPassedStudent($students){
    $c = 0;
    foreach ($students as $student){
        if ($student->isPassed()){
            $c = $c + 1;
        }
    }
    return $c;
}
function calculateAverageScore($students){
    if (empty($students)) return 0;
    $total = 0;
    foreach ($students as $student){
        $total = $total + $student->score;
    }
    return $total/count($students);
}
$student1 = new Student("Nguyen Van An", 20, 8.5);
$student2 = new Student("Tran Thi Binh", 21, 6.5);
$student3 = new Student("Le Van Cuong", 19, 4.5);
$student4 = new Student("Pham Thi Dung", 20, 7.5);
$students = [$student1, $student2, $student3, $student4];
function displayAllStudents($students){
    foreach ($students as $student){
        $student->display();
    }
}
displayAllStudents($students);
$best = findBestStudent($students);
if ($best) {
    echo "Sinh viên xuất sắc nhất: " . $best->name . " (" . $best->score . " điểm)<br>";
}
echo "Số sinh viên đạt: " . countPassedStudent($students) . " sinh viên.<br>";
echo "Điểm trung bình cả lớp: " . round(calculateAverageScore($students), 2) . " điểm.<br>";

?>