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

use Dictionary\Storage\DictionaryMapperInterface;
use Krystal\Stdlib\ArrayUtils;
use Krystal\Stdlib\VirtualEntity;
use Krystal\Cache\MemoryCache;
use Krystal\Templating\StringTemplate;
use Cms\Service\AbstractManager;

final class DictionaryService extends AbstractManager implements DictionaryServiceInterface
{
    /**
     * Any compliant dictionary mapper
     * 
     * @var \Cms\Storage\DictionaryMapperInterface
     */
    private $dictionaryMapper;

    /**
     * State initialization
     * 
     * @param \Cms\Storage\DictionaryMapperInterface $dictionaryMapper
     * @return void
     */
    public function __construct(DictionaryMapperInterface $dictionaryMapper)
    {
        $this->dictionaryMapper = $dictionaryMapper;
    }

    /**
     * {@inheritDoc}
     */
    protected function toEntity(array $row)
    {
        $entity = new VirtualEntity();
        $entity->setId($row['id'], VirtualEntity::FILTER_INT)
               ->setLangId($row['lang_id'], VirtualEntity::FILTER_INT)
               ->setWysiwyg($row['wysiwyg'], VirtualEntity::FILTER_BOOL)
               ->setAlias($row['alias'], VirtualEntity::FILTER_TAGS)
               ->setValue($row['value']);

        return $entity;
    }

    /**
     * Returns last dictionary id
     * 
     * @return integer
     */
    public function getLastId()
    {
        return $this->dictionaryMapper->getLastId();
    }

    /**
     * Finds a translation in a stack
     * 
     * @param string|int $alias An alias or translation id
     * @param array $vars Optional string variables
     * @param int $langId Language id
     * @return mixed
     */
    public function findTranslation($alias, array $vars, $langId)
    {
        $cache = new MemoryCache();

        // Avoid invoking query each time. Cache result once, and then just work with cached collection
        if ($cache->has($langId)) {
            $rows = $cache->get($langId);
        } else {
            $rows = $this->fetchAll($langId);
            $cache->set($langId, $rows, null);
        }

        // Column that contain translation, depending on type of provided alias
        $column = is_numeric($alias) ? 'id' : 'alias';

        $output = null;

        // Perform linear search to find a corresponding translation value
        foreach ($rows as $entity) {
            if ($entity[$column] == $alias) {
                $output = $entity->getValue();
                break;
            }
        }

        return StringTemplate::template($output, $vars);
    }

    /**
     * Fetches a list
     * 
     * @param mixed $langId Optional language ID constraint
     * @return array
     */
    public function fetchList($langId = null)
    {
        $rows = $this->dictionaryMapper->fetchAll($langId);
        return ArrayUtils::arrayList($rows, 'alias', 'value');
    }

    /**
     * Fetch all items
     * 
     * @param mixed $langId Optional language ID constraint
     * @return array
     */
    public function fetchAll($langId = null)
    {
        return $this->prepareResults($this->dictionaryMapper->fetchAll($langId));
    }

    /**
     * Fetch dictionary entity by its associated ID
     * 
     * @param int $id Item id
     * @param boolean $withTranslations
     * @return array
     */
    public function fetchById($id, $withTranslations)
    {
        if ($withTranslations == true) {
            return $this->prepareResults($this->dictionaryMapper->fetchById($id, true));
        } else {
            return $this->prepareResult($this->dictionaryMapper->fetchById($id, false));
        }
    }

    /**
     * Delete many items at once by their IDs
     * 
     * @param array $ids
     * @return boolean
     */
    public function deleteByIds(array $ids)
    {
        return $this->dictionaryMapper->deleteEntity($ids);
    }

    /**
     * Deletes item by its associated ID
     * 
     * @param int $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->dictionaryMapper->deleteEntity($id);
    }

    /**
     * Saves an entity
     * 
     * @param array $input
     * @return boolean
     */
    public function save(array $input)
    {
        return $this->dictionaryMapper->saveEntity($input['item'], $input['translation']);
    }
}
