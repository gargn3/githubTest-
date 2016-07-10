<!-- File: /app/View/Posts/edit.ctp -->
<div class = 'posts form'>
<h1><b><label>Edit Post</label></b></h1>
<fieldset>
    <p></p>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Post');
?>
</fieldset>
<?php echo $this->Form->end(null); ?>
</div>
</br></br>
<p>
<!--    check if the user is logged in, display welcome message and logout/login link accordingly -->
 <b><?php if ($this->Session->read('Auth.User')): ?>
        Welcome <?php echo $this->Session->read('Auth.User.username'); ?>! </b> <br/></br>
        <?php echo $this->Html->link('My Account', (array('controller' => 'users', 'action' => 'edit',$post['Post']['user_id']))); ?><br/></br>
        <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
    <?php else: ?>
        <?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?>
        <p><?php echo $this->Html->link( "Create Account",   array('controller'=> 'users','action'=>'add') ); ?></p>
    <?php endif; ?>
</p>
<p> <?php echo $this->Html->link('Back to Blogs', array('controller' => 'posts', 'action' => 'index')); ?></p>
<p><?php echo $this->Html->link('List of Users', array('controller' => 'users', 'action' => 'index')); ?></p>
