<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Dictionary\Storage;

interface DictionaryMapperInterface
{
    /**
     * Fetch all items
     * 
     * @return array
     */
    public function fetchAll();

    /**
     * Fetches item data by its associated id
     * 
     * @param string $id Contact ID
     * @param boolean $withTranslations Whether to fetch translations or not
     * @return array
     */
    public function fetchById($id, $withTranslations);
}
