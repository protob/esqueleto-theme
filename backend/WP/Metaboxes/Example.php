<?php

namespace Esq\WP\Metaboxes;

// use Skele\Cpt;

/**
 * CPT Example
 */
class Example {
	const NAME        = 'Example METABOX';
	const NAME_PLURAL = 'Example METABOX';
	const SLUG        = 'examplemetabox';

	/**
	 * Class loaded automatically.
	 */
	public static function init() {
	
		add_action( 'rwmb_meta_boxes', [ __CLASS__, 'create_metaboxes' ] );
	
	}

	/**
	 * Create CPT.
	 */
	public static function create_metaboxes($meta_boxes) {
 
            $prefix = '';
        
            $meta_boxes[] = array (
                'title' => esc_html__( 'example', 'text-domain' ),
                'id' => 'example',
                'post_types' => array(
                    0 => 'post',
                ),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array (
                        'id' => $prefix . 'group',
                        'type' => 'group',
                        'name' => esc_html__( 'Group', 'text-domain' ),
                        'fields' => array(
                            array (
                                'id' => $prefix . 'text',
                                'type' => 'text',
                                'name' => esc_html__( 'Text Field', 'text-domain' ),
                            ),
                            array (
                                'id' => $prefix . 'textarea',
                                'type' => 'textarea',
                                'name' => esc_html__( 'Textarea Field', 'text-domain' ),
                            ),
                            array (
                                'id' => $prefix . 'img',
                                'type' => 'image_advanced',
                                'name' => esc_html__( 'Image Advanced', 'text-domain' ),
                                'max_file_uploads' => 1,
                                'image_size' => 'thumbnail',
                                'max_status' => false,
                            ),
                        ),
                        'clone' => 1,
                        'sort_clone' => 1,
                        'default_state' => 'expanded',
                    ),
                ),
            );
        
            return $meta_boxes;
     
	}
}
