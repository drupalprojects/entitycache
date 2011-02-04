<?php
// $Id$

/**
 * @file
 * Automatically generates tests for entitycache, re-using core tests with entitycache enabled.
 */

/**
 * Instructions for use:
 *  - update the $modules array  with any additional modules to borrow tests from.
 *  - copy file to the root of a Drupal install.
 *  - run "drush scr entitytests.php"
 *  - cp /tmp/entitycache.test to the module folder.
 */

/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$output = '';
$output .= '<?php' . "\n";
$output .= '// $Id$' . "\n\n";

$modules = array(
  'blog',
  'book',
  'comment',
  'node',
  'user',
  'taxonomy',
  'poll',
);

$classes = db_query("SELECT name FROM {registry} WHERE module IN(:modules) AND type = :type AND filename LIKE :name", array(':modules' => $modules, ':type' => 'class', ':name' => '%.test'))->fetchCol();

foreach ($classes as $class) {
  $output .= "/**\n";
  $output .= " * Copy of $class.\n";
  $output .= " */\n";
  $output .= "class EntityCache$class extends $class {\n";
  $output .= "  public static function getInfo() {\n";
  $output .= "    return array(\n";
  $output .= "      'name' => 'Copy of $class',\n";
  $output .= "      'description' => 'Copy of $class',\n";
  $output .= "      'group' => 'Entity cache',\n";
  $output .= "    );\n";
  $output .= "  }\n";
  $output .= "  function setUp() {\n";
  $output .= "    parent::setUp('entitycache');\n";
  $output .= "  }\n";
  $output .= "}\n";
  $output .= "\n";
}

file_put_contents('/tmp/entitycache.test', $output);
