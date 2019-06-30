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

final class SiteService
{
    /**
     * Current language ID
     * 
     * @var int
     */
    private $langId;

    /**
     * Any compliant dictionary service
     * 
     * @var \Dictionary\Service\DictionaryService
     */
    private $dictionaryService;

    /**
     * State initialization
     * 
     * @param int $langId
     * @param \Dictionary\Service\DictionaryService $dictionaryService
     * @return void
     */
    public function __construct($langId, DictionaryServiceInterface $dictionaryService)
    {
        $this->langId = $langId;
        $this->dictionaryService = $dictionaryService;
    }

    /**
     * Syntax sugar
     * 
     * @param string $alias
     * @return mixed
     */
    public function __invoke($alias)
    {
        return $this->findByAlias($alias);
    }

    /**
     * Finds by alias or by id
     * 
     * @param string|int $alias An alias or translation id
     * @return mixed
     */
    public function findByAlias($alias)
    {
        static $rows = null;

        if (is_null($rows)) {
            $rows = $this->dictionaryService->fetchAll($this->langId);
        }

        // Column that contain translation, depending on type of provided alias
        $column = is_numeric($alias) ? 'id' : 'alias';

        foreach ($rows as $entity) {
            if ($entity[$column] == $alias) {
                return $entity->getValue();
            }
        }

        return null;
    }
}
