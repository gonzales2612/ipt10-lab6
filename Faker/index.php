<?php
require "vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a log channel
$log = new Logger('ipt10');
$log->pushHandler(new StreamHandler('ipt10.log'));

// Add records to the log
$log->warning('[Christian Carlo D. Gonzales]');
$log->error('[gonzales.christiancarlo@auf.edu.ph]');
$log->info('profile', [
    'student_number' => '[20-1320-683]',
    'college' => '[CCS]',
    'program' => '[BSIT]',
    'university' => '[AUF]'
]);

class TestClass
{
    private $logger;
    
    public function __construct($logger_name)
    {
        $this->logger = new Logger($logger_name);
        $this->logger->info(__FILE__ . " Greetings to the logger");
    }

    public function greet($name)
    {
        $message = "Greetings to {$name}";
        $this->logger->info(__METHOD__ . ": " . $message);
        return $message;
    }

    public function getAverage($data)
    {
        $this->logger->info(__CLASS__ . " getting the average");
        $average = array_sum($data) / count($data);
        return $average;
    }

    public function largest($data)
    {
        $this->logger->info(__CLASS__ . " getting the largest number");
        $largest = max($data);
        return $largest;
    }

    public function smallest($data)
    {
        $this->logger->info(__CLASS__ . " getting the smallest number");
        $smallest = min($data);
        return $smallest;
    }
}

$obj = new TestClass('test_logger');
echo $obj->greet('Your Name');

$data = [100, 345, 4563, 65, 234, 6734, -99];
echo "Average: " . $obj->getAverage($data) . "\n";
echo "Largest: " . $obj->largest($data) . "\n";
echo "Smallest: " . $obj->smallest($data) . "\n";

$log->info('data', $data);
$log->info('object', ['object' => $obj]);
