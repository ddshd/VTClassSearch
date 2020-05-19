<?php
$url = 'https://apps.es.vt.edu/ssb/HZSKVTSC.P_ProcRequest';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

$html = curl_exec($ch);

$redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

curl_close($ch);

echo "Original URL:   " . $url . "\n";
echo "Redirected URL: " . $redirectedUrl . "\n";
?>
