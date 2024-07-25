<?php
function translateText($text, $sourceLang, $targetLang) {
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=AIzaSyAdJVmidDRKMmqDas3Zem9f0dZqb6gd00M";

    $data = [
        "contents" => [
            [
                "parts" => [
                    ["text" => "Translate the following text from $sourceLang to $targetLang language: $text and return only translated text"]
                ]
            ]
        ]
    ];

    $options = [
        "http" => [
            "header" => "Content-Type: application/json\r\n",
            "method" => "POST",
            "content" => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        die('Error occurred');
    }

    $result = json_decode($response, true);
    return $result["candidates"][0]["content"]["parts"][0]["text"];
}


header("Content-Type: text/html;charset=utf-8");
