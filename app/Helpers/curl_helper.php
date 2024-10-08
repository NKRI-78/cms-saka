<?php

use Config\Services;

// function curlHelper($url = '', $method = 'GET', $fields = [])
// {
//   $curl = curl_init();
//   $session = Services::session();
//   $token = $session->get('token');
//   curl_setopt($curl, CURLOPT_URL, $url);
//   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
//   if ($method === 'POST' || $method === 'PUT' || $method === "PATCH") {
//     $template = "";
//     $values = $fields;
//     $keys = array_keys($fields);
//     for ($i = 0; $i < count($keys); $i++) {
//       $template .= $keys[$i] . '=' . $values[$keys[$i]] . '&';
//       $query_string = substr($template, 0, -1);
//     }
//     curl_setopt($curl, CURLOPT_POSTFIELDS, $query_string);
//   }
//   curl_setopt($curl, CURLOPT_VERBOSE, true);
//   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//   // SSL Certificate Problem : Self Signed Certificate 
//   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//   curl_setopt($curl, CURLOPT_HTTPHEADER, [
//     'Authorization: Bearer ' . $token,
//   ]);
//   $result = curl_exec($curl);
//   $resultDecoded = json_decode($result);

//   curl_close($curl);
//   return $resultDecoded;
// }

function curlHelper($url = '', $method = 'GET', $fields = [])
{
  $curl = curl_init();
  $session = Services::session();
  $token = $session->get('token');
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

  if ($method === 'POST' || $method === 'PUT' || $method === "PATCH") {
    $query_string = http_build_query($fields);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $query_string);
  }

  curl_setopt($curl, CURLOPT_VERBOSE, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Disable SSL verification (not recommended for production)
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $token,
  ]);

  $result = curl_exec($curl);
  if ($result === false) {
    $error = curl_error($curl);
    log_message('error', 'Curl Error: ' . $error);
  }

  $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  log_message('info', 'HTTP Code: ' . $http_code);

  curl_close($curl);

  // Debug if response is null
  if (!$result) {
    log_message('error', 'Curl returned no data for URL: ' . $url);
    return null;
  }

  $resultDecoded = json_decode($result);
  return $resultDecoded;
}

function curlPortHelper($url = '', $method = 'GET', $fields = [], $path)
{
  $session = \Config\Services::session();
  $client = \Config\Services::curlrequest([
    'base_uri' => $url
  ]);
  $result = $client->request($method, $path, [
    'headers' => [
      'Authorization' => 'Bearer ' . $session->get('token'),
      'Accept'     => 'application/json',
    ]
  ]);
  $body = json_decode($result->getBody());
  return $body;
}

function curlImageHelper($url, $data)
{
  $session = Services::session();
  $token = $session->get('token');
  $headers = ["Content-Type : application/json", "Authorization: Bearer " . $token];
  $postfields = [
    "folder" => "images",
    "subfolder" => "saka",
    "media" => curl_file_create($data['media']['tmp_name'], $data['media']['type'], basename($data['media']['name']))
  ];
  $curl = curl_init();
  $options = [
    CURLOPT_URL => $url,
    CURLOPT_POSTFIELDS => $postfields,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_RETURNTRANSFER => true
  ];
  curl_setopt_array($curl, $options);
  $result = curl_exec($curl);
  $decoded = json_decode($result);
  return $decoded;
}
