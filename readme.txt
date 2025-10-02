=== Menu Item Types ===
Contributors: maxpertici
Donate link: 
Tags: Menu, Custom, Nav item
Requires at least: 5.8
Tested up to: 6.9.3
Stable tag: 1.7
Requires PHP: 8.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Menu Item Types makes it easy to add and create custom menu item types to your navigation menus.

== Description ==
Menu Item Types makes it easy to add links to your archive pages, titles, items without URL, paragraphs or images to your navigation menus.
You can also easily override the templates and/or create your own custom elements.

[vimeo https://vimeo.com/659116094]


== Create your own item type ==
You need to declare your new type in, functions.php, a plugin, child theme, or your custom theme like this :

`
function register_my_custom_type(){

    $args = array(
        'slug'        => "my-custom-type",
        'label'       => __( 'My Custom Type', 'my-custom-type' ),
		'render'      => 'path/to/render/my-custom-render.php',
    );

    mitypes_register_type( $args );
}
add_action( 'mitypes_init', 'register_my_custom_type' );
`

You can do more than that on $args.

`
$args = array(
    'slug'   => "my-custom-type",
    'label'  => __( 'My Custom Type', 'my-custom-type' ),
    'render' => 'path/to/my-custom-type-render.php',

    // Link your custom icon
    'icon' => 'https://url-to-icon-file.svg',
    
    // Return ACF Group field array
    'field-group' => [
        'key'   => 'uniq_key',
        'title' => 'Group Title',
        'fields => [
            ...
        ],
        'location' => [
            [
                [
                    'param' => 'mitypes',
                    'operator' => '==',
                    'value' => 'my-custom-type',
                ],
            ],
        ],

    ],

    // Use callback for customize your item
    // you can add filter on 'mitypes_nav_menu_link_attributes' if you need
    'callback' => function(){ ... }
);
`

And finally, you can work in the render with some variables.
You have two variables available:

`


// $item is the WP_Post of the menu item, with which you can, for example, retrieve custom field data.

$id = get_field( 'acf-slug', $item->ID ) ;


// $args is an object containing the complete configuration of the wp_nav_menu() call,
// including the current menu (WP_Term), classes, IDs, wrappers, depth, walker, menu location, etc.
// More info : https://developer.wordpress.org/reference/functions/wp_nav_menu/

`

There are already additional plugins.
You can also create your own elements like these plugins do:

* [Menu Item Types — Button](https://wordpress.org/plugins/menu-item-types-button/)
* [Menu Item Types — Action](https://wordpress.org/plugins/menu-item-types-action/)

== Customize the plugin ==

`
// Disable Post Type Archive Metabox
add_filter( 'mitypes_has_post_type_archive_metabox', '__return_false' ) ;

// Disable Buildin Item types
add_filter( 'mitypes_has_buildin_item_types', '__return_false' ) ;

// Mix Buildin and Plugin Item types in the metabox
add_filter( 'mitypes_mix_metabox_item_types', '__return_true' ) ;

// Filter Supported Item types
add_filter( 'mitypes_supported_types', function(){ return ['image']; } );

// Disable Nav Item Icons
add_filter( 'mitypes_nav_menu_items_has_icons', '__return_false' ) ;
`

== Installation ==
1. Install the plugin and activate.
2. Go to Apparence > Menu
3. If the new metaboxes are not visible, use screen options


== Frequently Asked Questions ==

= My elements haven't styles =
Menu Item Types does not provide graphic formatting. It provides the tools to create your own elements.

= Is ACF essential?  =
[Yes. Download and install it.](https://wordpress.org/plugins/advanced-custom-fields/)

= How to add my own custom fields?  =
Menu Item Types adds a new ACF location to target different types of menu items.

== Changelog ==

= 1.7 =
* Fix : mitypes_init hook timing
* Fix : buildin paragraph slug (maybe if you excluded it with the error, it will be back in your admin, sorry)
* Fix : image size in Image type
* Update readme.txt with more code information (thanks to Shoulders for his help)
* PHP 8.x required


= 1.6 =
* Fix : translation's notices
* Add : user's locale support

= 1.5 =
* Add : 2 hooks mitypes_init & mitypes_setup
* Add : mitypes_register_type() function 
* Add : callback in type definition for exec actions or attach hooks ater loading the type
* Fix : field-group loading logic
* Fix : image type render

= 1.4 =
* Add filter : mitypes_nav_menu_items_has_icons

= 1.3 =
* Fix : fix ACF location match. now you can create a location test with the menu item type name & another native item type.

= 1.2 =
* Add filter : mitypes_has_post_type_archive_metabox
* Add filter : mitypes_has_buildin_item_types
* Add filter : mitypes_mix_metabox_item_types
* Add filter : mitypes_supported_types
* Add filter : mitypes_has_{$type}_item_type_support
* Add render callback option : thx [ogorzalka PR](https://github.com/maxpertici/menu-item-types/pull/2)
* Improve svg support : thx [ogorzalka PR](https://github.com/maxpertici/menu-item-types/pull/2)
* Improve ACF's test : thx [alexwoollam PR](https://github.com/maxpertici/menu-item-types/pull/1)

= 1.1 =
* Improved support for custom elements with the ability to register an icon.
* FIX post_type_archive label

= 1.0 =
* Launch