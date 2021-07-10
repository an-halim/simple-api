<?php
header('Content-type: application/json; charset=UTF-8');
$data = array(
    'status' => true,
    'message' => 'Mau apa hayoooo'
    );
    
echo json_encode($data, JSON_PRETTY_PRINT);