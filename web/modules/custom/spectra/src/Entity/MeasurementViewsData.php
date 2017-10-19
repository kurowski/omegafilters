<?php

namespace Drupal\spectra\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Measurement entities.
 */
class MeasurementViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
