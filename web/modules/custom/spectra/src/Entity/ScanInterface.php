<?php

namespace Drupal\spectra\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Scan entities.
 *
 * @ingroup spectra
 */
interface ScanInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Scan name.
   *
   * @return string
   *   Name of the Scan.
   */
  public function getName();

  /**
   * Sets the Scan name.
   *
   * @param string $name
   *   The Scan name.
   *
   * @return \Drupal\spectra\Entity\ScanInterface
   *   The called Scan entity.
   */
  public function setName($name);

  /**
   * Gets the Scan creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Scan.
   */
  public function getCreatedTime();

  /**
   * Sets the Scan creation timestamp.
   *
   * @param int $timestamp
   *   The Scan creation timestamp.
   *
   * @return \Drupal\spectra\Entity\ScanInterface
   *   The called Scan entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Scan published status indicator.
   *
   * Unpublished Scan are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Scan is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Scan.
   *
   * @param bool $published
   *   TRUE to set this Scan to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\spectra\Entity\ScanInterface
   *   The called Scan entity.
   */
  public function setPublished($published);

}
