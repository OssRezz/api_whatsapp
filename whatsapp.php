<?php

function sendWhatsAppMessage($token, $version, $phoneNumberId, $phoneNumber, $template)
{
    // Construye los datos del mensaje
    $data = [
        'messaging_product' => 'whatsapp',
        'to' => "57" . $phoneNumber,
        'type' => 'template',
        'template' => [
            'name' => $template,
            'language' => [
                'code' => 'es',
            ],
            'components' => [
                [
                    'type' => 'body',
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => "Nana"
                        ],
                        [
                            'type' => 'text',
                            'text' => "Un poquito de paciencia"
                        ]
                    ]
                ]
            ]
        ],
    ];

    // Codifica los datos en formato JSON
    $postData = json_encode($data);

    // URL de destino
    $url = 'https://graph.facebook.com/' . $version . '/' . $phoneNumberId . '/messages';

    // Inicializa cURL
    $ch = curl_init($url);

    // Configura opciones de cURL
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $token));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Ejecuta la solicitud
    $response = curl_exec($ch);

    // Verifica si hubo algún error
    if (curl_errno($ch)) {
        return 'Error al enviar la solicitud: ' . curl_error($ch);
    }

    // Cierra la sesión cURL
    curl_close($ch);

    // Decodifica la respuesta JSON
    $responseData = json_decode($response, true);

    // Retorna la respuesta
    return $responseData;
}


function sendWhatsAppMessageSimple($token, $version, $phoneNumberId, $phoneNumber, $template, $identificador)
{
    // Construye los datos del mensaje
    $data = [
        'messaging_product' => 'whatsapp',
        'to' => $identificador . $phoneNumber,
        'type' => 'template',
        'template' => [
            'name' => $template,
            'language' => [
                'code' => 'en_US',
            ],
        ],
    ];

    // Codifica los datos en formato JSON
    $postData = json_encode($data);

    // URL de destino
    $url = 'https://graph.facebook.com/' . $version . '/' . $phoneNumberId . '/messages';

    // Inicializa cURL
    $ch = curl_init($url);

    // Configura opciones de cURL
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $token));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Ejecuta la solicitud
    $response = curl_exec($ch);

    // Verifica si hubo algún error
    if (curl_errno($ch)) {
        return 'Error al enviar la solicitud: ' . curl_error($ch);
    }

    // Cierra la sesión cURL
    curl_close($ch);

    // Decodifica la respuesta JSON
    $responseData = json_decode($response, true);

    // Retorna la respuesta
    return $responseData;
}


$token = $_POST['token'];
$version = $_POST['version'];
$plantilla = $_POST['plantilla'];
$id_number = $_POST['id_number'];
$number = $_POST['number'];
$identificador = $_POST['identificador'];

//$response = sendWhatsAppMessage($token, $version, $id_number, $number, $plantilla);
$response = sendWhatsAppMessageSimple($token, $version, $id_number, $number, $plantilla, $identificador);

echo json_encode([
    $response
]);
