<!-- File: /app/View/Users/index.ctp -->
<div class = 'users form'>
<h1><b><label>List of Users</label></b></h1>
<fieldset>
    <p></p>
<table>
    <tr>
        <th>Username</th>
        <th>Role</th>
        <th>Number Of Blogs</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $users array, printing out users info -->

    <?php foreach ($users as $user): ?>
    <tr>
        <td>
               <?php echo $user['User']['username']; ?>
        </td>
        <td>
               <?php echo $user['User']['role']; ?>             
        </td>
        <td>
        <!-- Here's we run the custom SQL query and count the resultset, to display the number of blogs written by each user -->
         <?php
           $db = ConnectionManager::getDataSource("default");
           $iD= $user['User']['id'];
           $Count =  $db->query("SELECT * FROM posts WHERE user_id = '$iD'");
           echo count($Count);
         ?>
        </td>
        <td>
            <!-- Here we pass the post id and title as an argument to display as a flash message on view -->
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $user['User']['id']), //, $post['Post']['title']),//
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $user['User']['id'])
                );
            ?>
        </td>
        <td> 
               <?php echo $user['User']['created']; ?>           
        </td>     
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $this->Html->link($this->Form->button('Create Account'), array('controller' => 'users', 'action' => 'add'), array('escape'=>false,'title' => "create account")); ?>
</fieldset>
<?php echo $this->Form->end(null); ?>
</div>
</br></br>

<p>
<!--    check if the user is logged in, display welcome message and logout/login link accordingly -->
<b><?php if ($this->Session->read('Auth.User')): ?>
        Welcome <?php echo $this->Session->read('Auth.User.username'); ?>! </b> <br/></br>
        <?php echo $this->Html->link('My Account', (array('controller' => 'users', 'action' => 'edit',$user['User']['id']))); ?><br/></br>
        <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
   <?php else: ?>
         <?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?>
      <p><?php echo $this->Html->link( "Create Account", array('controller'=> 'users','action'=>'add') ); ?></p>
   <?php endif; ?>
</p>
<p> <?php echo $this->Html->link('Back to Blogs', array('controller' => 'posts', 'action' => 'index')); ?></p>












