<div class="users form">
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo'Please enter your username and password'; ?>
        </legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
<p>
</br></br>
<?php
 echo $this->Html->link( "Create Account",   array('action'=>'add') ); 
?>
</p>
<p> <?php echo $this->Html->link('Back to Blogs', array('controller' => 'posts', 'action' => 'index')); ?></p>
<p><?php echo $this->Html->link('List of Users', array('controller' => 'users', 'action' => 'index')); ?></p>

