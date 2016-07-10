<!-- File: /app/View/Posts/index.ctp -->
<div class = 'posts form'>
<h1><b><label>Blog posts</label></b></h1>

<fieldset>
<table>
    <tr>
        <th>Title</th>
        <th>Created by</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->
    <?php foreach ($posts as $post): ?>
    <tr>
        <td>
            <?php
                echo $this->Html->link(
                    $post['Post']['title'],
                    array('action' => 'view', $post['Post']['id'])
                );
            ?>
        </td>
        <td><?php echo $post['Post']['user_name']; ?></td>
        <td>
            <!-- Here we pass the post id and title as an argument to display as a flash message on view -->
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $post['Post']['id'], $post['Post']['title']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $post['Post']['id'])
                );
            ?>
        </td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $this->Html->link($this->Form->button('Create Blog'), array('controller' => 'posts', 'action' => 'add'), array('escape'=>false,'title' => "create a blog")); ?>
</fieldset>
<?php echo $this->Form->end(null); ?>
</div>
</br></br>

<p>
<!--    check if the user is logged in, display welcome message and logout/login link accordingly -->
<b><?php if ($this->Session->read('Auth.User')): ?> Welcome <?php echo $this->Session->read('Auth.User.username'); ?>! </b> <br/></br>
      <?php echo $this->Html->link('My Account', (array('controller' => 'users', 'action' => 'edit',$post['Post']['user_id']))); ?><br/></br>
      <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
   <?php else: ?>
     <p><?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?></p>
        <?php echo $this->Html->link( "Create Account",   array('controller'=> 'users','action'=>'add') ); ?>
   <?php endif; ?>
</p>

<p><?php echo $this->Html->link('List of Users', array('controller' => 'users', 'action' => 'index')); ?></p>











