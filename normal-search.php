<?php
/* Template Name: Normal Search */ ?>
<h1>These are the search results...</h1>
<?php

$list = array();
$item = array();

foreach($_POST as $key => $value) {
    if($value != '') {
        $item['taxonomy'] = htmlspecialchars($key);
        $item['terms'] = htmlspecialchars($value);
        $item['field'] = 'slug';
        $list[] = $item;
    }
}
$cleanArray = array_merge(array('relation' => 'AND'), $list);
print_r($cleanArray);

?>