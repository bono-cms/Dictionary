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
use Dictionary\Service\SiteService;

final class Module extends AbstractCmsModule
{
    /**
     * {@inheritDoc}
     */
    public function getServiceProviders()
    {
        $dictionaryService = new DictionaryService($this->getMapper('/Dictionary/Storage/MySQL/DictionaryMapper'));

        // Grab current language
        $langId = $this->getCmsModule()->getService('languageManager')->getCurrentId();

        return array(
            'dictionaryService' => $dictionaryService,
            'siteService' => new SiteService($langId, $dictionaryService)
        );
    }
}
