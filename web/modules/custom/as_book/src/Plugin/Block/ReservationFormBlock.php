<?php

namespace Drupal\as_book\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ReservationFormBlock' block.
 *
 * @Block(
 *  id = "reservation_form_block",
 *  admin_label = @Translation("Reservation form block"),
 * )
 */
class ReservationFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    //copier coller de la fonction preprocess du theme
    /*if($bla['node']->getType()==='as_book'){
      if($bla['view_mode'] === 'full'){
        //$variables['reservation_form']= $form;
      }l
    }*/
    //objet request de drupal, et peut recup l'uri. recup /node/id

    $form_current_book = \Drupal::request()->getRequestUri();

    //retrouver l'id du monsieur. Kint pour debug ou drupal api ou doc drupal t'façon;
    $current_user_path = \Drupal::currentUser();
    $form_current_user = $current_user_path->id();



    $form = \Drupal::formBuilder()->getForm('Drupal\as_book\Form\BookReservationForm');
    //ici prend le /node/id
    $form['book_id']['#value']= $form_current_book;
    $form['user_id']['#value']= $form_current_user;

    /*$state_book_id = $form_state->getValue('book_id');
    $state_user_id = $form_state->getvalue('user_id');

    $invalid_book = $form_book_id !== $state_book_id;
    $invalid_usr = $form_user_id !== $state_user_id;

    if($invalid_book || $invalid_usr){
      $form_state->setError( $form['book_id'], 'blablabla error.');*/
      //return FALSE;

      /* if is_anonymous -> set error aussi

      */


    $build = [];
    $build['reservation_form_block']['#markup'] = $form;

    return $build;
  }

}
