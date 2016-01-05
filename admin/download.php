<?php 
if(empty($_COOKIE['type'])  or $_COOKIE['type']!='admin' ){
    header('location: ../index.php');}
require_once '../models/pelaporan.php';
$data=new Pelaporan();
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
#fputcsv($output, array('Column 1', 'Column 2', 'Column 3'));

// fetch the data
//mysql_connect('localhost', 'username', 'password');
//mysql_select_db('database');
 $rows = $data->report() ;

foreach ($rows[0] as $column=>$value) {
	$header[]=$column;
}
fputcsv($output, $header);
////
// loop over the rows, outputting them
foreach ($rows as $row) {
	fputcsv($output, $row);
}
?>