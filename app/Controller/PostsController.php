<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class PostsController extends AppController
{
    const IMG_PATH = WWW_ROOT . 'img/uploads/users/';

    public $helpers = [
        'Html',
        'Form',
        'Flash',
        'Awesome' => [
            'option1' => 'value1'
        ]
    ];
    public $components = array('Flash');

    public function index() {
        $this->set('posts', $this->Post->find('all'));
        $this->set('img_path', 'img/uploads/users/');
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }

    public function add() {
        /*
        $this->request->is() takes a single argument,
        which can be the request METHOD (get, put, post, delete) or some request identifier (ajax).
        It is not a way to check for specific posted data. For instance, $this->request->is('book') will not return true if book data was posted.
        */
        if ($this->request->is('post')) {
            $this->Post->create();
            if (!empty($this->request->data)) {
                // Check for image
                if(!empty($this->request->data['Post']['upload']['name'])) {
                    $file = $this->request->data['Post']['upload']; //put the data into a var for easy use
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                    //only process if the extension is valid
                    if(in_array($ext, $arr_ext))
                    {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/users/' . $file['name']);

                        //prepare the filename for database entry
                        $this->data['Post']['image'] = $file['name'];
                    }
                }
                $this->Post->save($this->request->data);
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if (!empty($this->request->data)) {
                // Check for image
                if(!empty($this->request->data['Post']['upload']['name'])) {
                    $file = $this->request->data['Post']['upload']; //put the data into a var for easy use
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                    //only process if the extension is valid
                    if(in_array($ext, $arr_ext))
                    {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], self::IMG_PATH . $file['name']);

                        //prepare the filename for database entry
                        // $this->data['Post']['image'] = $file['name'];
                        $this->Post->set('image', $file['name']);
                    }
                }
                $this->Post->save($this->request->data);
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
}
