<?php

$p = get_field('mitypes_paragraph_text', $item->ID );

if( ! isset( $p ) || '' === $p ){ return ; }


$attr = array(
    'title'  => array(),
    'class'  => array()
);

$p_tags = array(
    'p'    => $attr,
    'span' => $attr
);

$p_tags = apply_filters( 'mitypes_wpkses_paragraph_tags', $p_tags );



echo wp_kses( $args->before, $p_tags );
echo '<div' . $attributes . '>';

    echo wp_kses( $args->link_before, $p_tags ) . '<p>' . esc_html( $p ) . '</p>' . wp_kses( $args->link_after, $p_tags );

echo '</div>';
echo wp_kses( $args->after, $p_tags );