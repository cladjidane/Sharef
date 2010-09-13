<?php

/**
 * RessourceFile filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRessourceFileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ressource' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ressource'), 'add_empty' => true)),
      'id_file'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('File'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_ressource' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ressource'), 'column' => 'id')),
      'id_file'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('File'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ressource_file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RessourceFile';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'id_ressource' => 'ForeignKey',
      'id_file'      => 'ForeignKey',
    );
  }
}
