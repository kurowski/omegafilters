<?php

namespace Drupal\spectra;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Measurement entity.
 *
 * @see \Drupal\spectra\Entity\Measurement.
 */
class MeasurementAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\spectra\Entity\MeasurementInterface $entity */
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view measurement entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit measurement entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete measurement entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add measurement entities');
  }

}
