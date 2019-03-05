<?php

/**
 * Module configuration container
 */

return array(
    'caption' => 'Dictionary',
    'description' => 'Manage any labels and captions on your site',
    'menu' => array(
        'name' => 'Dictionary',
        'icon' => 'fas fa-book',
        'items' => array(
            array(
                'route' => 'Dictionary:Admin:Dictionary@indexAction',
                'name' => 'View all items'
            ),
            array(
                'route' => 'Dictionary:Admin:Dictionary@addAction',
                'name' => 'Add new item'
            )
        )
    )
);