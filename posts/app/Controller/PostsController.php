<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController{
    public $helpers = array('Html', 'Form');
    public $components = array('Flash');
    
    public function index() {
        $this->Post->recursive = 0;
        $this->set('posts', $this->paginate());
        $this->set('posts', $this->Post->find('all'));
        }
    
    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException('Invalid post');
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException('Invalid post');
        }
        $this->set('post', $post);
    }
    /* Here we add the current user id, and username into the posts table accordingly for multiple tables joining */
    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            $this->request->data['Post']['user_name'] = $this->Auth->user('username');
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success('Your post has been saved.');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error('Unable to add your post.');
        }
        $id = $this->Auth->user('id');
        $this->set('id', $id);
    }

    public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException('Invalid post');
    }

    $post = $this->Post->findById($id);
    if (!$post) {
        throw new NotFoundException('Invalid post');
    }
    $this->set('post', $post);

    if ($this->request->is(array('post', 'put'))) {
        $this->Post->id = $id;
        if ($this->Post->save($this->request->data)) {
            $this->Flash->success('Your post has been updated.');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error('Unable to update your post.');
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}

   public function delete($id, $title) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->Post->delete($id)) {
        $this->Flash->success( __('The post %s has been deleted.', ($title)));
    } else {
        $this->Flash->error( __('The post %s has been deleted.', ($title)));
    }
    
    return $this->redirect(array('action' => 'index'));
}

    public function isAuthorized($user) {
    // Admin can delete and edit any blog whereas the author can only  delete and edit his own blogs
    if (isset($user['role']) && $user['role'] === 'admin') {
        if (in_array($this->action, array('edit', 'delete','add')))
        {
         return true;
        }   
    }
    else {
        if ($this->action === 'add') {
           return true;
           }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
          $postId = (int) $this->request->params['pass'][0];
          if ($this->Post->isOwnedBy($postId, $user['id'])) {
            return true;
            }
          else {
            $this->Flash->error(__('You are not authorised to edit or delete others article!'));
            $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
        }
    }
    return parent::isAuthorized($user);

    }  
}
