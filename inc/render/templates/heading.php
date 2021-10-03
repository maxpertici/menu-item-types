<?php

$hn = get_field('mitypes_heading_selector', $item->ID );

if( ! isset( $hn ) || '' === $hn ){ return ; }

$attr = array(
    'title'  => array(),
    'class'  => array()
);

$heading_tags = array(
    'h2'   => $attr,
    'h3'   => $attr,
    'h4'   => $attr,
    'h5'   => $attr,
    'h6'   => $attr,
    'p'    => $attr,
    'span' => $attr
);

$heading_tags = apply_filters( 'mitypes_wpkses_heading_tags', $heading_tags );

echo wp_kses( $args->before, $heading_tags );
echo '<' . esc_html( $hn ) . wp_kses( $attributes, $heading_tags ) . '>';

    echo wp_kses( $args->link_before, $heading_tags) . esc_html( $title ) . wp_kses( $args->link_after, $heading_tags );

echo '</' . esc_html( $hn ) . '>';
echo wp_kses( $args->after, $heading_tags );