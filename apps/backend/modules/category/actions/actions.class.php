<?php

require_once dirname(__FILE__).'/../lib/categoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/categoryGeneratorHelper.class.php';

/**
 * category actions.
 *
 * @package    sf_sandbox
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class categoryActions extends autoCategoryActions
{
  protected function addSortQuery($query)
  {
    //don't allow sorting; always sort by Category and lft
    $query->addOrderBy('root_id, lft');
  }

  public function executeBatch(sfWebRequest $request)
  {

    echo '------------ Action en cours : executeBatch---------';
    if ("batchOrder" == $request->getParameter('batch_action'))
    {
      return $this->executeBatchOrder($request);
    }

    parent::executeBatch($request);
  }

  public function executeBatchOrder(sfWebRequest $request)
  {

    echo '------------ Action en cours : executeBatchOrder---------';

    $newparent = $request->getParameter('newparent');

    //manually validate newparent parameter

    //make list of all ids
    $ids = array();
    foreach ($newparent as $key => $val)
    {
      $ids[$key] = true;
      if (!empty($val))
        $ids[$val] = true;
    }
    $ids = array_keys($ids);

    //validate if all id's exist
    $validator = new sfValidatorDoctrineChoiceMany(array('model' => 'Category'));
    try
    {
      // validate ids
      $ids = $validator->clean($ids);

      // the id's validate, now update the Category
      $count = 0;
      $flash = "";

      foreach ($newparent as $id => $parentId)
      {
        if (!empty($parentId))
        {
          $node = Doctrine::getTable('Category')->find($id);
          $parent = Doctrine::getTable('Category')->find($parentId);

          if (!$parent->getNode()->isDescendantOfOrEqualTo($node))
          {
            $node->getNode()->moveAsFirstChildOf($parent);
            $node->save();

            $count++;

            $flash .= "<br/>Moved '".$node['name']."' under '".$parent['name']."'.";
          }
        }
      }

      if ($count > 0)
      {
        $this->getUser()->setFlash('notice', sprintf("Category order updated, moved %s item%s:".$flash, $count, ($count > 1 ? 's' : '')));
      }
      else
      {
        $this->getUser()->setFlash('error', "You must at least move one item to update the Category order");
      }
    }
    catch (sfValidatorError $e)
    {
      $this->getUser()->setFlash('error', 'Cannot update the Category order, maybe some item are deleted, try again');
    }

    $this->redirect('@category');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $object = $this->getRoute()->getObject();
    if ($object->getNode()->isValidNode())
    {
      $object->getNode()->delete();
    }
    else
    {
      $object->delete();
    }

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@category');
  }

  public function executeListNew(sfWebRequest $request)
  {

    echo '------------ Action en cours : executeBatchOrder---------';

    $this->executeNew($request);
    $this->form->setDefault('parent_id', $request->getParameter('id'));
    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $this->getUser()->setFlash('notice', $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.');

      $category = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $category)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $this->getUser()->getFlash('notice').' You can add another one below.');

        //$this->redirect('@category_new');
      }
      else
      {
        //$this->redirect('@category_edit?id='.$category['id']);
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.');
    }
  }
}

