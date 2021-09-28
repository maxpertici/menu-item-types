<?php


$block_id = get_field('mitypes_wpblock_selector', $item->ID );

if( isset( $block_id ) && (int) $block_id > 0 ){

    echo $args->before;
    echo '<div' . $attributes . '>';

    echo $args->link_before ;

    $content_post  = get_post( $block_id );
    $block_content = $content_post->post_content;
    echo apply_filters( 'the_content',  $block_content );

    echo $args->link_after;
    
    echo '</div>';
    echo $args->after;

}