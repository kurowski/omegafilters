<?php

namespace Drupal\spectra;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Measurement entities.
 *
 * @ingroup spectra
 */
class MeasurementListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['scan'] = $this->t('Scan');
    $header['wavelength'] = $this->t('Wavelength');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\spectra\Entity\Measurement */
    $row['id'] = $this->l(
      $entity->getScan()->label(),
      new Url(
        'entity.scan.canonical', [
          'scan' => $entity->getScanId(),
        ]
      )
    );
    $row['wavelength'] = $this->l(
      $entity->label(),
      new Url(
        'entity.measurement.edit_form', [
          'measurement' => $entity->id(),
        ]
      )
    );
    return $row + parent::buildRow($entity);
  }

}
