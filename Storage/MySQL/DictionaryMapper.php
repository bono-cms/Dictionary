<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Dictionary\Storage\MySQL;

use Cms\Storage\MySQL\AbstractMapper;
use Dictionary\Storage\DictionaryMapperInterface;

final class DictionaryMapper extends AbstractMapper implements DictionaryMapperInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return self::getWithPrefix('bono_module_cms_dictionary');
    }

    /**
     * {@inheritDoc}
     */
    public static function getTranslationTable()
    {
        return DictionaryTranslationMapper::getTableName();
    }

    /**
     * Returns shared columns to be selected
     * 
     * @return array
     */
    private function getColumns()
    {
        return array(
            self::column('id'),
            self::column('alias'),
            self::column('wysiwyg'),
            DictionaryTranslationMapper::column('lang_id'),
            DictionaryTranslationMapper::column('value'),
        );
    }

    /**
     * Fetch all items
     * 
     * @param mixed $langId Optional language ID constraint
     * @return array
     */
    public function fetchAll($langId = null)
    {
        // If not provided, use default one
        if (is_null($langId)) {
            $langId = $this->getLangId();
        }

        $db = $this->createEntitySelect($this->getColumns())
                   // Language ID constraint
                   ->whereEquals(DictionaryTranslationMapper::column('lang_id'), $langId)
                   // Sort by last IDs
                   ->orderBy(self::column('id'))
                   ->desc();

        return $db->queryAll();
    }

    /**
     * Fetches item data by its associated id
     * 
     * @param string $id Contact ID
     * @param boolean $withTranslations Whether to fetch translations or not
     * @return array
     */
    public function fetchById($id, $withTranslations)
    {
        return $this->findEntity($this->getColumns(), $id, $withTranslations);
    }
}
