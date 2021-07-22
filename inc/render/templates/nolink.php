<?php



echo $args->before;
echo '<span' . $attributes . '>';
echo $args->link_before . $title . $args->link_after;
echo '</span>';
echo $args->after;