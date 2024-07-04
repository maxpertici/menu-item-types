<?php

$attr = array(
    'title'  => array(),
    'class'  => array()
);

$nolink_tags = array(
    'p'    => $attr,
    'span' => $attr
);

$nolink_tags = apply_filters( 'mitypes_wpkses_nolink_tags', $nolink_tags );

echo wp_kses( $args->before, $nolink_tags );
echo '<div' . wp_kses( $attributes, $nolink_tags ) . '>';

    echo wp_kses( $args->link_before, $nolink_tags ). '<div>' . esc_html( $title ) . '</div>' . wp_kses( $args->link_after, $nolink_tags );

echo '</div>';
echo wp_kses( $args->after, $nolink_tags );