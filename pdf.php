<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \mPDF('utf-8', 'A4', '');

// Write some HTML code:
$mpdf->WriteHTML('Hello World');

// Output a PDF file directly to the browser
$mpdf->Output();
