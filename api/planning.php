<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


require 'auth/validate_token.php';
$decoded=validateToken();


function getScheduleData() {
    return [
        'data' => [
            ["08:00", "09:00", "-", "-", "-", "7331Français_7 - Count =2\nReminder Text\nReview link\n#\n", "-", "-", "-"],
            ["09:00", "10:00", "-", "-", "-", "-", "-", "-", "-"],
            ["10:00", "11:00", "7333Français_frm - Count =1\nFULL Reminder Text\nReview link\n#\n2025-03-09", "-", "-", "-", "-", "-", "7333Français_frm - Count =1\nFULL Reminder Text\nReview link\n#\n2025-03-22"],
            ["11:00", "12:00", "7334Français_9 - Count =1\nFULL Reminder Text\nReview link\n#\n2025-03-09", "-", "-", "-", "-", "7334Français_9 - Count =2\nDUO Reminder Text\nReview link\n#\n2025-03-14", "7334Français_7 - Count =2\nDUO Reminder Text\nReview link\n#\n2025-03-01"],
            ["12:00", "13:00", "7335Français_9 - Count =2\nDUO Reminder Text\nReview link\n#\n2025-03-09", "7335Français_2s - Count =1\nFULL Reminder Text\nReview link\n#\n2025-03-10", "-", "7335Français_1s - Count =1\nFULL Reminder Text\nReview link\nQ97105\n2025-04-02", "-", "-", "-"],
            ["13:00", "14:00", "7336Français_8 - Count =7\nNORMAL Reminder Text\nReview link\n#\n2025-03-09", "-", "-", "7336Français_1s - Count =1\nFULL Reminder Text\nReview link\nQ97105\n2025-04-02", "-", "-", "7336Français_6 - Count =1\nFULL Reminder Text\nReview link\n#\n2025-03-08"],
            ["14:00", "15:00", "-", "7337Français_7 - Count =1\nFULL Reminder Text\nReview link\n#\n2025-03-10", "-", "7337Français_6 - Count =1\nFULL Reminder Text\nReview link\n#\n2025-03-26", "-", "-", "-"],
            ["15:00", "16:00", "-", "-", "-", "-", "-", "-", "7338Français_7 - Count =1\nFULL Reminder Text\nReview link\n#\n2025-02-15"],
            ["16:00", "17:00", "-", "-", "7339Français_1s - Count =2\nDUO Reminder Text\nReview link\n#\n2025-03-11", "-", "-", "-", "-"],
            ["17:00", "18:00", "-", "-", "-", "-", "-", "-", "-"],
            ["18:00", "19:00", "7341Français_9 - Count =1\nFULL Reminder Text\nReview link\n#\n2025-03-09", "-", "7341Français_1s - Count =2\nDUO Reminder Text\nReview link\n#\n2025-03-11", "7341Français_bac - Count =4\nOPEN Reminder Text\nReview link\n#\n2025-03-05", "-", "-", "-"],
            ["19:00", "20:00", "-", "-", "-", "-", "-", "-", "7342Français_bac - Count =4\nNORMAL Reminder Text\nReview link\n#\n2025-03-29"],
            ["20:00", "21:00", "-", "-", "-", "-", "-", "-", "7343Français_8 - Count =1\nFULL Reminder Text\nReview link\n#\n2025-03-29"]
        ]
    ];
}

// Handle the request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = getScheduleData();
    echo json_encode($data); 
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>