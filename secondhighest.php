<?php
$arr = [10, 20, 40, 55, 66];

$first = $second = PHP_INT_MIN; // सबसे छोटी संभव इन्टिजर वैल्यू

foreach ($arr as $value) {
    if ($value > $first) {
        $second = $first;
        $first = $value;
    } 
    elseif ($value > $second && $value < $first) {
        $second = $value;
    }
}

echo "Second highest element is: $second";
?>
