<?php
$page = file_get_contents('/home/gerhardadler/www/ct//guides/category-template.html');

$to_be_replaced = array('[category]',
                        '[description]'
);

$replacement = array('Equipment',
                     'Descripton babbbbeeee!'
);

$page = str_replace($to_be_replaced, $replacement, $page);
echo $page;
?>