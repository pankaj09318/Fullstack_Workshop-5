<?php include "includes/header.php"; ?>

<h3>Student List</h3>

<?php
if (file_exists("students.txt")) {
    $students = file("students.txt");

    foreach ($students as $student) {
        list($name, $email, $skills) = explode("|", trim($student));
        $skillsArray = explode(",", $skills);

        echo "<p>";
        echo "<strong>Name:</strong> $name<br>";
        echo "<strong>Email:</strong> $email<br>";
        echo "<strong>Skills:</strong> " . implode(", ", $skillsArray);
        echo "</p><hr>";
    }
} else {
    echo "No students found.";
}
?>

<?php include "includes/footer.php"; ?>