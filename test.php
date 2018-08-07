<?php
$sum_in = 45602828749;
$sum = '';
$count_sumbols = 3;
$count_sumbols_right = 0;
$count_sumbols_left = 0;
$strlen = strlen($sum_in);
$delimeter = floor(($strlen / $count_sumbols));
for($i=1; $i <= $delimeter; $i++){
    $count_sumbols_left = ($strlen - ($count_sumbols * $i));
    //$sum .= '.'.substr($project->sum_investor_proj, $count_sumbols_left, -$count_sumbols_right);
    if($i == 1){
        $sum = '.'.substr($sum_in, $count_sumbols_left);
    }else{
        $count_sumbols_right = (($count_sumbols * $i) - 3);
        $sum = '.'.substr($sum_in, $count_sumbols_left, -$count_sumbols_right).$sum;
    }
}

$sum = substr($sum_in, 0, -($count_sumbols * $delimeter)).$sum;

print $sum.'<br>';

$count_sumbols_left = ($strlen - ($count_sumbols * 1));
print '.'.substr($sum_in, $count_sumbols_left);
print '<br>';
$count_sumbols_left = ($strlen - ($count_sumbols * 2));
print '.'.substr($sum_in, $count_sumbols_left, -3);

?>