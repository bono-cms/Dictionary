<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Dictionary\Service;

interface DictionaryServiceInterface
{
    /**
     * Returns last dictionary id
     * 
     * @return integer
     */
    public function getLastId();

    /**
     * Fetch all items
     * 
     * @return array
     */
    public function fetchAll();

    /**
     * Fetch dictionary entity by its associated ID
     * 
     * @param int $id Item id
     * @param boolean $withTranslations
     * @return array
     */
    public function fetchById($id, $withTranslations);

    /**
     * Deletes item by its associated ID
     * 
     * @param int $id
     * @return boolean
     */
    public function deleteById($id);

    /**
     * Adds an item
     * 
     * @param array $input
     * @return boolean
     */
    public function add(array $input);

    /**
     * Updates an item
     * 
     * @param array $input
     * @return boolean
     */
    public function update(array $input);
}
