<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['student_id'])) {
    $studentId = $_POST['student_id'];

    $sql = "SELECT * FROM `students` WHERE `student_id` = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();

        if ($student['role'] == 1) {
            $updateSql = "UPDATE `students` SET `role` = 0 WHERE `student_id` = ?";
            $updateStmt = $con->prepare($updateSql);
            $updateStmt->bind_param("i", $studentId);

            if ($updateStmt->execute()) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}
?>
