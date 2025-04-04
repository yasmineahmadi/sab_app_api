<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require 'auth/validate_token.php';
$decoded=validateToken();

$scheduleData = [
    "data" => [
        [
            "Ali Hannachi", "tasnim", "06:00", "07:00", "", "", "", 
            "Physique_1s (Present)\nType= DUO", "", "", ""
        ],
        [
            "Ali Hannachi", "harroun", "06:00", "07:00", 
            "Math_bac (Present)\nType= FULL", "", "", "", "", "", ""
        ],
        [
            "Ali Hannachi",
            "ربيعة",
            "06:00",
            "07:00",
            "",
            "",
            "",
            "",
            "Physique_2s (Present)\nType=NORMAL",
            "",
            ""
          ],
          [
            "Ali Hannachi",
            "loujaine",
            "06:00",
            "07:00",
            "",
            "",
            "",
            "Physique_1s (Present)\nType= DUO",
            "",
            "",
            ""
          ],
          [
            "Maryem Ashour",
            "adem",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "",
            "Anglais_7 (Present)\nType= FULL",
            ""
          ],
          [
            "Ali Hannachi",
            "aicha",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "Physique_2s (Present)\nType= NORMAL",
            "",
            "",
            ""
          ],
          [
            "Marwa el Karaz",
            "YOUSSEF",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "",
            "",
            "Français_5 (Present)\nType= FULL"
          ],
          [
            "Rania damak",
            "Aysha Jihen",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "",
            "",
            "Math_3 (Present)\nType= FULL"
          ],
          [
            "Nour lhouda",
            "Nour",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "",
            "",
            "Français_3 (Present)\nType= DUO"
          ],
          [
            "Ali Hannachi",
            "Med Amin",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "Physique_2s (Absent)\nType= NORMAL",
            "",
            "",
            ""
          ],
          [
            "Ali Hannachi",
            "harroun",
            "07:00",
            "08:00",
            "Math_bac (Present)\nType= FULL",
            "",
            "",
            "",
            "",
            "",
            ""
          ],
          [
            "Darin Manaei",
            "Majd nefzi",
            "07:00",
            "08:00",
            "Math_5 (Present)\nType= FULL",
            "",
            "",
            "",
            "",
            "",
            ""
          ],
          [
            "Ilhem Atig",
            "mouhamed ali",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "Français_6 (Present)\nType=FULL",
            "",
            ""
          ],
          [
            "Ali Hannachi",
            "ربيعة",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "Physique_2s (Present)\nType= NORMAL",
            "",
            "",
            ""
          ],
          [
            "Ali Hannachi",
            "Harbaoui eya",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "",
            "Math_3s (Present)\nType= FULL",
            ""
          ],
          [
            "Darin Manaei",
            "ayoub bou naaja",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "",
            "",
            "Math_6 (Present)\nType= DUO"
          ],
          [
            "Ali Hannachi",
            "nour",
            "07:00",
            "08:00",
            "",
            "Physique_3s (Present)\nType=DUO",
            "",
            "",
            "",
            "",
            ""
          ],
          [
            "Ali Hannachi",
            "loujaine",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "Physique_1s (Present)\nType=DUO",
            "",
            ""
          ],
          [
            "Darin Manaei",
            "Fadi",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "",
            "",
            "Math_6 (Present)\nType= DUO"
          ],
          [
            "Ali Hannachi",
            "Mariem",
            "07:00",
            "08:00",
            "",
            "Physique_3s (Present)\nType=DUO",
            "",
            "",
            "",
            "",
            ""
          ],
          [
            "Ichrak Moncer",
            "adem",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "",
            "Arabe_7 (Present)\nType= FULL",
            ""
          ],
          [
            "Narjes el Rahal",
            "hassen",
            "07:00",
            "08:00",
            "Arabe_1 (Present)\nType= FULL",
            "",
            "",
            "",
            "",
            "",
            ""
          ],
          [
            "Maryem Ashour",
            "adem",
            "07:00",
            "08:00",
            "",
            "",
            "",
            "",
            "",
            "",
            "Anglais_7 (Present)\nType= FULL"
          ]
    
    ]
];

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