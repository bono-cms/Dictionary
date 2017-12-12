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
}
