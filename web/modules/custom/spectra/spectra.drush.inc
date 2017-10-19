<?php

/**
 * Implements hook_drush_command().
 */
function spectra_drush_command() {
  return [
    'spectra-import' => [
      'description' => 'Import spectral data',
      'arguments' => [
        'dir' => 'The directory containing CSV files',
      ],
    ],
  ];
}

function drush_spectra_import($dir) {
  $measurements = \Drupal::entityTypeManager()->getStorage('measurement');
  $measurements->delete($measurements->loadMultiple());
  $scans = \Drupal::entityTypeManager()->getStorage('scan');
  $scans->delete($scans->loadMultiple());

  foreach (new DirectoryIterator($dir) as $file) {
    if ($file->isDot()) {
      continue;
    } else {
      $parts = explode('.', $file->getFilename());
      array_pop($parts);
      $name = array_pop($parts);
      echo "$name\n";
      $scan = $scans->create([
        'name' => $name,
      ]);
      $scan->save();
      if (($handle = fopen($file->getPathname(), "r")) !== FALSE) {
        $data = fgetcsv($handle); # skip first line
        if($data === FALSE) {
          print "empty file";
          exit;
        }
        if(strstr ($data[0], "WL(nm)") == FALSE) {
          print "bad data: expected WL(nm) column"; exit;
        }
        if(strstr ($data[1], "ABS") == FALSE) {
          print "bad data: expected ABS column"; exit;
        }

        while (($data = fgetcsv($handle)) !== FALSE) {
          $measurement = $measurements->create([
            'scan_id' => $scan->id(),
            'wavelength' => $data[0],
            'transmission' => $data[1],
          ]);
          $measurement->save();
        }
        
        fclose($handle);
      } else {
        print "file missing!\n";
      }
    }
  }
}

