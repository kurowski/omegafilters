<?php

namespace Drupal\spectra;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Scan entity.
 *
 * @see \Drupal\spectra\Entity\Scan.
 */
class ScanAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\spectra\Entity\ScanInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished scan entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published scan entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit scan entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete scan entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add scan entities');
  }

}
