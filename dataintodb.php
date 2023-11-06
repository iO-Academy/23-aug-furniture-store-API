<?php

$rawData = file_get_contents('docs/furniturerawdata');

$decodedData = json_decode($rawData);

echo '<pre>';
print_r($decodedData);
echo '</pre';


