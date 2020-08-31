<?php

if (class_exists('WP_CLI')) {
  class ImportProducts {
    protected $products;

    public function __invoke() {
      $import = get_stylesheet_directory() . '/import.csv';
      $row = 1;
      $headings = [];
      $info = [];
      if ($handle = fopen($import, 'r')) {
        while ($data = fgetcsv($handle, 1000, ',')) {
          $num = count($data);
          for ($c = 0; $c < $num; $c++) {
            if ($row === 1) {
              $headings[$c] = $data[$c];
            } else {
              $info[$heading[$c]] = $data[$c];
            }
          }
          $row++;
        }
      }
      var_dump($headings);
      WP_CLI::success('Import success');
    }
  }
  $instance = new ImportProducts();
  WP_CLI::add_command('import-products', $instance);
}
