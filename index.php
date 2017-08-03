<?php
$request = $_GET['request'];
if ($request != 'person' && $request != 'item') {
	print "request should be 'person' or 'item'<br>";
        exit;
}
$offset = $_GET['offset'];
if ($offset && (!is_numeric($offset)  || $offset < 0)) {
	print "invalid offset: offset should be a number[0-N]<br>";
        exit;
}
$limit = $_GET['limit'];
if ($limit && (!is_numeric($limit)  || $limit < 0)) {
	print "invalid limit: limit should be a number[0-N]<br>";
        exit;
}

// for debugging
// print "$request<br>";
// print "$offset<br>";
// print "$limit<br>";

if ($request == 'person') {
   $file = $request.".csv";
} elseif ($request == 'item') {
   $file = $request."s.csv";
}

if (!file_exists($file)) {
	print "Data file related to request [$file] not found.<br>";
	exit;
}

$fp = fopen($file,"r");
for ($row = 0; $row <= ($offset + $limit); ++$row) {
    if ($data = fgetcsv($fp)) {
	if ($row <= $offset) {continue;}
	$arrayJSON = json_encode($data);
        print "$arrayJSON<br>";
    } else {
	break;
    }
}
fclose($fp);
?>
