<?php
require_once 'parser.php';

$data = file_get_contents($argv[1]);
print_r( (new Parser())->parse($data));