<?php

namespace Drupal\spectra\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Measurement entities.
 *
 * @ingroup spectra
 */
interface MeasurementInterface extends ContentEntityInterface {

  /**
   * Returns the entity owner's user entity.
   *
   * @return \Drupal\spectra\Entity\ScanInterface
   *   The owner user entity.
   */
  public function getScan();

  /**
   * Sets the entity scan's entity.
   *
   * @param \Drupal\spectra\Entity\ScanInterface $scan
   *   The scan entity.
   *
   * @return $this
   */
  public function setScan(ScanInterface $scan);

  /**
   * Returns the entity scan's ID.
   *
   * @return int|null
   *   The scan ID, or NULL in case the scan ID field has not been set on the entity.
   */
  public function getScanId();

  /**
   * Sets the entity scan's ID.
   *
   * @param int $id
   *   The owner scan id.
   *
   * @return $this
   */
  public function setScanId($id);

  /**
   * Gets the Measurement wavelength.
   *
   * @return float
   *   Wavelength of the Measurement.
   */
  public function getWavelength();

  /**
   * Sets the Measurement wavelength.
   *
   * @param string $wavelength
   *   The Measurement wavelength.
   *
   * @return \Drupal\spectra\Entity\MeasurementInterface
   *   The called Measurement entity.
   */
  public function setWavelength($wavelength);
  
  /**
   * Gets the Measurement transmission.
   *
   * @return float
   *   Transmission of the Measurement.
   */
  public function getTransmission();

  /**
   * Sets the Measurement transmission.
   *
   * @param string $transmission
   *   The Measurement transmission.
   *
   * @return \Drupal\spectra\Entity\MeasurementInterface
   *   The called Measurement entity.
   */
  public function setTransmission($transmission);

}
