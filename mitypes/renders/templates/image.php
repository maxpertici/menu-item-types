<?php

$img_id = 0 ;
$img_array = get_field('mitypes_image_media', $item->ID );

if( isset( $img_array ) && isset( $img_array['ID'] ) ){
    $img_id = (int) $img_array['ID'] ;
}

if( isset( $img_id ) && (int) $img_id > 0 ) :

    $attr = array(
        'src'     => array(),
        'class'   => array(),
        'alt'     => array(),
        'loading' => array(),
        'style'   => array(),
        'width'   => array(),
        'height'  => array(),
    );

    $img_tags = array(
        'img' => $attr,
        'p' => $attr,
    );

    $img_tags = apply_filters( 'mitypes_wpkses_image_tags', $img_tags );


    $size = 'thumbnail' ;
    $img_size = get_field('mitypes_image_size', $item->ID );
    if( isset( $img_size ) && $img_size != '' ){ $size = array_keys($img_size) ; }

    echo wp_kses( $args->before, $img_tags );
    echo '<div' . wp_kses( $attributes, $img_tags ) . '>';

        echo wp_kses( $args->link_before, $img_tags );
        echo wp_kses( wp_get_attachment_image( (int) $img_id , $size, false, array() ), $img_tags ) ;
        echo wp_kses( $args->link_after, $img_tags );
    
    echo '</div>';
    echo wp_kses( $args->after, $img_tags );

endif;