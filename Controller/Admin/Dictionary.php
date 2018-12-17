<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Dictionary\Controller\Admin;

use Cms\Controller\Admin\AbstractController;
use Krystal\Stdlib\VirtualEntity;

final class Dictionary extends AbstractController
{
    /**
     * Renders main grid
     * 
     * @return string
     */
    public function indexAction()
    {
        // Append a breadcrumb
        $this->view->getBreadcrumbBag()
                   ->addOne('Dictionary');

        return $this->view->render('index', array(
            'items' => $this->getModuleService('dictionaryService')->fetchAll()
        ));
    }

    /**
     * Renders dictionary form
     * 
     * @param mixed $item
     * @param string $title
     * @return string
     */
    private function createForm($item, $title)
    {
        // Append breadcrumbs
        $this->view->getBreadcrumbBag()->addOne('Dictionary', 'Dictionary:Admin:Dictionary@indexAction')
                                       ->addOne($title);

        return $this->view->render('form', array(
            'item' => $item
        ));
    }

    /**
     * Renders add form
     * 
     * @return string
     */
    public function addAction()
    {
        return $this->createForm(new VirtualEntity(), 'Add an item');
    }

    /**
     * Renders edit form
     * 
     * @param int $id
     * @return string
     */
    public function editAction($id)
    {
        $item = $this->getModuleService('dictionaryService')->fetchById($id, true);

        if ($item !== false) {
            return $this->createForm($item, 'Edit the item');
        } else {
            return false;
        }
    }

    /**
     * Deletes an item from dictionary by its ID
     * 
     * @param int $id
     * @return int
     */
    public function deleteAction($id)
    {
        $service = $this->getModuleService('dictionaryService');

        // Batch removal
        if ($this->request->hasPost('toDelete')) {
            $ids = array_keys($this->request->getPost('toDelete'));

            $service->deleteByIds($ids);
            $this->flashBag->set('success', 'Selected elements have been removed successfully');

        } else {
            $this->flashBag->set('warning', 'You should select at least one element to remove');
        }

        // Single removal
        if (!empty($id)) {
            $service->deleteById($id);
            $this->flashBag->set('success', 'Selected element has been removed successfully');
        }

        return 1;
    }

    /**
     * Persists a dictionary
     * 
     * @return string
     */
    public function saveAction()
    {
        $data = $this->request->getPost();

        $service = $this->getModuleService('dictionaryService');
        $service->save($data);

        if ($data['item']['id']) {
            $this->flashBag->set('success', 'Selected dictionary item has been updated successfully');
            return 1;
        } else {
            $this->flashBag->set('success', 'Selected dictionary item has been added successfully');
            return $service->getLastId();
        }
    }
}
