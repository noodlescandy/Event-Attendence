<?php
require 'credentials.php';
function parseInput($in, $toCheckFor, $text, $shouldUnserialize){
    if($in === $toCheckFor){
        $in = [$toCheckFor, $text];
    }
    else{
        if ($shouldUnserialize) {
            $in = unserialize($in);
        }
        
    }
}

/*$event = $_POST['event'];
if($event === 'event_name'){
    $event = ['event_name', 'All Events'];
}
else{
    $event = unserialize($event);
}*/

$event = parseInput($_POST['event'], 'event_name', 'All Events', true)
$student = parseInput($_POST['student'], 'name', 'All Students', true);

// these may cause problems
$startDate = parseInput($_POST['startDate'] null, 'None', false);
$endDate = parseInput($_POST['endDate'] null, 'None', false);

echo "<p>$event</p><br>";
echo "<p>$student</p><br>";
echo "<p>Begin Date: $startDate End Date: $endDate</p><br>";

?>
