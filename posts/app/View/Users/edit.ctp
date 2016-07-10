
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo ('Edit Your Account'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end('Submit'); ?>
</div>
</br></br>
<!--  display welcome message and links accordingly -->
<p>
<b>Welcome <?php echo $this->Session->read('Auth.User.username'); ?>! </b> <br/></br>
        <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
</p>
<p> <?php echo $this->Html->link('Back to Blogs', array('controller' => 'posts', 'action' => 'index')); ?></p>
<p><?php echo $this->Html->link('List of Users', array('controller' => 'users', 'action' => 'index')); ?></p>
