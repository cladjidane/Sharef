<?php

/**
 * RessourceCategory form base class.
 *
 * @method RessourceCategory getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRessourceCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_ressource' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ressource'), 'add_empty' => true)),
      'id_category'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_ressource' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ressource'), 'required' => false)),
      'id_category'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Category'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ressource_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RessourceCategory';
  }

}
