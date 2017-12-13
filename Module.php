<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Dictionary;

use Cms\AbstractCmsModule;
use Dictionary\Service\DictionaryService;

final class Module extends AbstractCmsModule
{
    /**
     * {@inheritDoc}
     */
    public function getServiceProviders()
    {
        return array(
            'dictionaryService' => new DictionaryService($this->getMapper('/Dictionary/Storage/MySQL/DictionaryMapper'))
        );
    }
}
