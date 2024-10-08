<?php

require 'FileUtility.php';
require 'Random.php';

const FILENAME = 'persons.csv';

// to start creating random
$random = new Random();
$data = [];

// Generate 300 random people
for ($i = 0; $i < 300; $i++) {
    $data[] = $random->generatePerson();
}

// Write data to CSV file
FileUtility::writeToFile(FILENAME, $data);

echo "300 records have been generated and saved to " . FILENAME;
