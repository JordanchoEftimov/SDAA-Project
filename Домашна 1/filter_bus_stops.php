<?php

$string = file_get_contents("bus_stops.json");
$arr = json_decode($string,true);

$arr = array_map(function ($item) {
	return [
		$item['id'],
		$item['number'],
		$item['name'],
		$item['lat'],
		$item['lon']
	];
}, $arr);

$filename = 'bus_stops.csv';

$f = fopen($filename, 'w');

if ($f === false) {
	die('File ' . $filename . ' cannot be opened.');
}

fputcsv($f, ['id', 'number', 'name', 'lat', 'lon']);

foreach ($arr as $row) {
	fputcsv($f, $row);
}

fclose($f);