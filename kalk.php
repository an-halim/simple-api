<?php
header('Content-type: application/json; charset=UTF-8');
$angka = $_GET['angka'];

$toUrl = urlencode($angka);

function filter($input){
    $cek = stripos($input, '=');
    if ($cek > 1) {
        return true;
    }else {
        return false;
    }
}


if (isset($angka) && !empty($angka)) {
    
    if (filter($angka)) {
        $data = array(
            'status' => false,
            'message' => 'Failed',
            'data' => array(
                'userInput' => $toUrl,
                'result' => 'Input tanpa tanda "="'
                )
            );
        $data = json_encode($data, JSON_PRETTY_PRINT);
        echo $data;

    }else {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.wolframalpha.com/n/v1/api/autocomplete/?i='.$toUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Connection: keep-alive',
            'sec-ch-ua: "Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
            'sec-ch-ua-mobile: ?0',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
            'Accept: */*',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'Referer: https://www.wolframalpha.com/input/?i=2%2B1-3%2B1',
            'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
            'Cookie: WR_SID=9e4845f6.5b954a8759091; __cookie_consent=0; hasVisitedBefore=true'
        ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $hasil = json_decode($response, true);
        $hasil = $hasil['instantMath']['exactResult'];
        $data = array(
            'status' => true,
            'message' => 'Sukses',
            'data' => array(
                'userInput' => $toUrl,
                'result' => $hasil
                )
            );
        $data = json_encode($data, JSON_PRETTY_PRINT);
        echo $data;
    }
    
} else {
    $data = array(
        'status' => false,
        'message' => 'Failed',
        'data' => array(
            'userInput' => '[!] numeric required',
            'result' => 'Unknown'
            )
        );
    $data = json_encode($data, JSON_PRETTY_PRINT);
    
    echo $data;
}




