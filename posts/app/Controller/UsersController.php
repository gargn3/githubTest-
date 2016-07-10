<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
    
     public function beforeFilter() {
     parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow('add', 'logout');
}

    public function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error('Invalid username or password, try again!');
    }
}

     public function logout() {
       $this->Auth->logout();
       $this->Flash->success('The user has been logged out');
       return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
}

    public function index() {
      $this->User->recursive = 0;
      $this->set('users', $this->paginate());
      $this->set('users', $this->User->find('all'));
      }
    
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success('The user has been saved');
                return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
            $this->Flash->error('The user could not be saved. Please, try again.');
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        if ($this->request->is(array('post', 'put')))
        {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success('The user has been saved');
                return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
            $this->Flash->error('The user could not be saved. Please, try again.');
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }
    
    public function delete($id = null) {
     
        $this->request->allowMethod('post');
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        if ($this->User->delete()) {
            $this->Flash->success('User deleted');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error('User was not deleted');
        return $this->redirect(array('action' => 'index'));
    }
    
     public function isAuthorized($user) {
    // All registered users can add account
    if ($this->action === 'add') {
        return true;
    }

    // The owner of a account can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
       $userId = (int) $this->request->params['pass'][0];
        if ($this->User->isOwnedBy($userId, $user['username'])) {
            return true;
        }
        else {
            $this->Flash->error('You are not authorised to edit or delete others account!');
            $this->redirect(array('controller' => 'users', 'action' => 'index'));
        }
    }

    return parent::isAuthorized($user);
}
}
