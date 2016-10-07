<?php

namespace Drupal\as_book\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
//ajout ajax
use Drupal\Core\Ajax; //tous les ajax sont dans le meme namespace

/**
 * Class searchBookForm.
 *
 * @package Drupal\as_book\Form
 */
class searchBookForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'search_book_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['searching_book'] = [
      '#type' => 'textfield',
      '#title' => $this->t('searching book'),
      '#description' => $this->t('search book'),
      '#maxength'=> 64,l
      '#size' => 64,
      '#ajax' => array(
        'callback' => 'Drupal\as_book\Form\searchBookForm::ajaxSearchCallback',
        'event' => 'keyup',
        'progress' => array(
          'type' => 'throbber', //throbber, un truc qui tourne, et progress barre de charg
          'message' => 'bla'
          )
        )
    ];

    $form['submit'] = [
        '#type' => 'submit',
        '#value' => t('Search')
    ];

//setredirect($var[setRedirect($route_name, array $route_parameters = array(), array $options = array())])
    return $form;
  }

  public function ajaxSearchCallback(array &$form, FormStateInterface $form_state){

    $keyword = $form_state->getValue('search');

    $query = \Drupal::entityQuery('node');
    $query->condition('type', 'as_book');
    $query->condition('status', 1);
    $query->condition('title', $keyword, 'CONTAINS'); //faire un like et non un egal
    $query->sort('created', 'DESC');
    $query->range(0, 10);

    $result = $query->execute();  $nodes = \Drupal\node\Entity\Node::loadMultiple($result);

    $books = [];
      foreach ($nodes as $node) {
        $books[] = node_view($node, 'teaser');
      }
      //ajax comme jquery
    $renderable=[
      '#theme'=>'book_listing',
      'books'=>$book
    ]

    $output = render($renderable);
    $response = new ajaxSearchCallback();
    //ajout des commandes ajax
    $htmlCommand = new htmlCommand('div.region.region-content', $output);
    $response->addCommand($htmlCommand);
    return $response;
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    //$form_state->setRedirect($nommachine_routeused, $route_param['key'=>'val'])
    $route_name='as_book.searching_book';
    $route_parameters=[
      'keyword'=>$form_state->getValue('searching_book')
    ];

    $form_state->setRedirect($route_name, $route_parameters);

    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
        drupal_set_message($key . ': ' . $value);
    }

  }

}
