<?php
    require_once '../function/run_query.php';
    require_once '../function/sql_cmds.php';

    if(session_status() == PHP_SESSION_NONE)
        session_start();

    $conn = open_db();

    $course_id = mysqli_real_escape_string($conn, $_GET['course_id']);
    $stu_id = $_SESSION['profile']['id'];

    $sql = enroll_course_cmd($stu_id, $course_id);
    
    mysqli_query($conn, $sql) or die(mysqli_error($conn));

    header("location: ../../course_handler.php");
?>