<?php

$hn = get_field('mitypes_nav_item_heading_selector', $item->ID );


echo $args->before;
echo '<'.$hn . $attributes . '>';
echo $args->link_before . $title . $args->link_after;
echo '</'.$hn.'>';
echo $args->after;