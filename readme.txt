=== Menu Item Types ===
Contributors: maxpertici
Donate link: 
Tags: Menu, Custom, Nav item
Requires at least: 5.8
Tested up to: 6.6
Stable tag: 1.5
Requires PHP: 7.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Menu Item Types makes it easy to add and create custom menu item types to your navigation menus.

== Description ==
Menu Item Types makes it easy to add links to your archive pages, titles, items without URL, paragraphs or images to your navigation menus.
You can also easily override the templates and/or create your own custom elements.

[vimeo https://vimeo.com/659116094]


== Menu Item Types can be extended ==
You can create your own item type like this :
`
function register_my_custom_type(){

    $args = array(
        'slug'        => "my-custom-type",
        'icon'        => 'https://url-to-icon-file.svg',
        'label'       => __( 'My Custom Type', 'my-custom-type' ),
        'field-group' => 'path/to/acf/field-group-array.php',
		'render'      => 'path/to/render/my-custom-render.php',
        'callback'    => function(){
            // Use callback for customize your item
            // you can add filter on 'mitypes_nav_menu_link_attributes' if you need
        }
    );

    mitypes_register_type( $args );
}
add_filter( 'mitypes_init', 'register_my_custom_type' );
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