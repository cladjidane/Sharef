<?php

/**
 * RessourceCategory filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRessourceCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ressource' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ressource'), 'add_empty' => true)),
      'id_category'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_ressource' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ressource'), 'column' => 'id')),
      'id_category'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Category'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ressource_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RessourceCategory';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'id_ressource' => 'ForeignKey',
      'id_category'  => 'ForeignKey',
    );
  }
}
