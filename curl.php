<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/LSS/index.php");
curl_setopt($ch, CURLOPT_HEADER, 0);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);
