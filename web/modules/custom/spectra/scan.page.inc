<?php

/**
 * @file
 * Contains scan.page.inc.
 *
 * Page callback for Scan entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Scan templates.
 *
 * Default template: scan.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_scan(array &$variables) {
  // Fetch Scan Entity Object.
  $scan = $variables['elements']['#scan'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
