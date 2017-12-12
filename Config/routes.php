<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

return array(
    '/%s/dictionary' => array(
        'controller' => 'Admin:Dictionary@indexAction'
    ),

    '/%s/dictionary/add' => array(
        'controller' => 'Admin:Dictionary@addAction'
    ),

    '/%s/dictionary/edit/(:var)' => array(
        'controller' => 'Admin:Dictionary@editAction'
    ),

    '/%s/dictionary/delete/(:var)' => array(
        'controller' => 'Admin:Dictionary@deleteAction'
    ),

    '/%s/dictionary/save' => array(
        'controller' => 'Admin:Dictionary@saveAction'
    )
);