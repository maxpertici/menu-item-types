<?php


$img_id = get_field('mitypes_image_media', $item->ID );

$size = 'thumbnail' ;
$img_size = get_field('mitypes_image_size', $item->ID );
if( isset( $img_size ) && $img_size != '' ){ $size = $img_size ; }

if( isset( $img_id ) && (int) $img_id > 0 ){

    echo $args->before;
    echo wp_get_attachment_image( (int) $img_id , $size, false, array() ) ;
    echo $args->after;
}