<?php

/**
 * @file
 * Contains measurement.page.inc.
 *
 * Page callback for Measurement entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Measurement templates.
 *
 * Default template: measurement.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_measurement(array &$variables) {
  // Fetch Measurement Entity Object.
  $measurement = $variables['elements']['#measurement'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
