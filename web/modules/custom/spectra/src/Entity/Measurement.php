<?php

namespace Drupal\spectra\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Measurement entity.
 *
 * @ingroup spectra
 *
 * @ContentEntityType(
 *   id = "measurement",
 *   label = @Translation("Measurement"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\spectra\MeasurementListBuilder",
 *     "views_data" = "Drupal\spectra\Entity\MeasurementViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\spectra\Form\MeasurementForm",
 *       "add" = "Drupal\spectra\Form\MeasurementForm",
 *       "edit" = "Drupal\spectra\Form\MeasurementForm",
 *       "delete" = "Drupal\spectra\Form\MeasurementDeleteForm",
 *     },
 *     "access" = "Drupal\spectra\MeasurementAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\spectra\MeasurementHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "measurement",
 *   admin_permission = "administer measurement entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/measurement/{measurement}",
 *     "add-form" = "/admin/structure/measurement/add",
 *     "edit-form" = "/admin/structure/measurement/{measurement}/edit",
 *     "delete-form" = "/admin/structure/measurement/{measurement}/delete",
 *     "collection" = "/admin/structure/measurement",
 *   },
 *   field_ui_base_route = "measurement.settings"
 * )
 */
class Measurement extends ContentEntityBase implements MeasurementInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }
  
  /**
   * {@inheritdoc}
   */
  public function getWavelength() {
    return $this->get('wavelength')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setWavelength($wavelength) {
    $this->set('wavelength', $wavelength);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getTransmission() {
    return $this->get('transmission')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTransmission($transmission) {
    $this->set('transmission', $transmission);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getScan() {
    return $this->get('scan_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getScanId() {
    return $this->get('scan_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setScanId($id) {
    $this->set('scan_id', $id);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setScan(ScanInterface $scan) {
    $this->set('scan_id', $scan->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['scan_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Part of'))
      ->setDescription(t('The ID of the Scan during which this Measurement was taken.'))
      ->setRevisionable(FALSE)
      ->setSetting('target_type', 'scan')
      ->setSetting('handler', 'default')
      ->setTranslatable(FALSE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'default_formatter', // FIXME create a ScanFormatter extends EntityReferenceFormatterBase
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayConfigurable('view', FALSE);
      
    $fields['wavelength'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Wavelength'))
      ->setDescription(t('The wavelength of the measurement.'))
      ->setSettings([
        'precision' => 8,
        'scale' => 2,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'text_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayConfigurable('view', FALSE);

    $fields['transmission'] = BaseFieldDefinition::create('float')
      ->setLabel(t('Transmission'))
      ->setDescription(t('Percent transmission at the specificed wavelength.'))
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'text_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayConfigurable('view', FALSE);

    return $fields;
  }

}
