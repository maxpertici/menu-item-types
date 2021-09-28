<?php

$p = get_field('mitypes_paragraph_text', $item->ID );

echo $args->before;
echo '<p' . $attributes . '>';
echo $args->link_before . esc_html( $p ) . $args->link_after;
echo '</p>';
echo $args->after;