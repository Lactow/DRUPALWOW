<?php

namespace Drupal\as_book\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the as_book module.
 */
class searchBookControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "as_book searchBookController's controller functionality",
      'description' => 'Test Unit for module as_book and controller searchBookController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests as_book functionality.
   */
  public function testsearchBookController() {
    // Check that the basic functions of module as_book.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
