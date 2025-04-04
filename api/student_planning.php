<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

//validate user is logged
require 'auth/validate_token.php';
$decoded=validateToken();


//load data
$scheduleData = require __DIR__ . '/../data/student_schedule_data.php';


// filter data by student or teacher
if (isset($_GET['student'])) {
    $filter = strtolower($_GET['student']);
    $filteredData = array_filter($scheduleData['data'], function($item) use ($filter) {
        return strpos(strtolower($item[1]), $filter) !== false;
    });
    echo json_encode(["data" => array_values($filteredData)]);
} 
elseif (isset($_GET['teacher'])) {
    $filter = strtolower($_GET['teacher']);
    $filteredData = array_filter($scheduleData['data'], function($item) use ($filter) {
        return strpos(strtolower($item[0]), $filter) !== false;
    });
    echo json_encode(["data" => array_values($filteredData)]);
} 
else {
    echo json_encode($scheduleData);
}
?>