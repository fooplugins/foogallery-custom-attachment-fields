<?php
/**
 * FooGallery - Custom Attachment Fields
 *
 * A simple example plugin showing how to add custom fields to attachments to be used in FooGallery
 *
 * @package   foogallery_custom_attachment_fields
 * @author    Brad Vincent
 * @license   GPL-2.0+
 * @link      http://fooplugins.com
 * @copyright 2015 Brad Vincent
 *
 * @wordpress-plugin
 * Plugin Name: FooGallery - Custom Attachment Fields
 * Description: A simple example plugin showing how to add custom fields to attachments to be used in FooGallery
 * Version:     1.0.0
 * Author:      Brad Vincent
 * Author URI:  http://fooplugins.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( is_admin() ) {

    //add some custom fields
    add_filter( 'foogallery_attachment_custom_fields', 'foogallery_custom_attachment_fields_add_custom_fields' );

} else {

    //use the custom fields when rendering foogallery html
    add_filter( 'foogallery_attachment_html_link_attributes', 'foogallery_custom_attachment_fields_render_custom_attributes', 10, 3 );
}

function foogallery_custom_attachment_fields_add_custom_fields( $fields ) {

    $fields['foogallery_datawidth'] = array(
        'label'       =>  __( 'Data Width', 'foogallery_custom_attachment_fields' ),
        'input'       => 'text',
        'helps'       => __( 'Set a custom data width attribute which FooBox can use.', 'foogallery_custom_attachment_fields' ),
        'exclusions'  => array( 'audio', 'video' ),
    );

    $fields['foogallery_dataheight'] = array(
        'label'       =>  __( 'Data Height', 'foogallery_custom_attachment_fields' ),
        'input'       => 'text',
        'helps'       => __( 'Set a custom data height attribute which FooBox can use.', 'foogallery_custom_attachment_fields' ),
        'exclusions'  => array( 'audio', 'video' ),
    );

    return $fields;
}

function foogallery_custom_attachment_fields_render_custom_attributes( $attr, $args, $foogallery_attachment ) {
    $datawidth = get_post_meta( $foogallery_attachment->ID, '_foogallery_datawidth', true );
    $dataheight = get_post_meta( $foogallery_attachment->ID, '_foogallery_dataheight', true );

    if ( !empty( $datawidth ) ) {
        $attr['data-width'] = $datawidth;
    }

    if ( !empty( $dataheight ) ) {
        $attr['data-height'] = $dataheight;
    }

    return $attr;
}