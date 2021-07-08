<?php

$atts           = array();
$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
$atts['target'] = ! empty( $item->target ) ? $item->target : '';
if ( '_blank' === $item->target && empty( $item->xfn ) ) {
    $atts['rel'] = 'noopener';
} else {
    $atts['rel'] = $item->xfn;
}

$atts['href']         = ! empty( $item->url ) ? $item->url : '';
$atts['aria-current'] = $item->current ? 'page' : '';

$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

$attributes = '';

foreach ( $atts as $attr => $value ) {
    if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
        if( ( 'href' != $attr ) ){ // nolink
            $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
            $attributes .= ' ' . $attr . '="' . $value . '"';
        }
    }
}

$title = apply_filters( 'the_title', $item->title, $item->ID );
$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

echo $args->before;
echo '<span' . $attributes . '>';
echo $args->link_before . $title . $args->link_after;
echo '</span>';
echo $args->after;