<?php


App::uses('AppHelper', 'View/Helper');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AwesomeHelper extends AppHelper {
    public $helpers = array('Html');
    public function __construct(View $view, $settings = array()) {
        parent::__construct($view, $settings);
    }
    public function makeEdit($title, $url) {

        $link = $this->Html->link($title, $url, array('class' => 'edit'));

        return '<div class="editOuter">' . $link . '</div>';
    }
}