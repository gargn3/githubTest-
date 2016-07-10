<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo 'Add User'; ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array( 'author' => 'Author')
        ));        
    ?>
    
    </fieldset>
<?php echo $this->Form->end('Submit'); ?>
</div>
<!--   display links accordingly -->
</br></br>
<p><?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?> </p>
<p> <?php echo $this->Html->link('Back to Blogs', array('controller' => 'posts', 'action' => 'index')); ?></p>
<p><?php echo $this->Html->link('List of Users', array('controller' => 'users', 'action' => 'index')); ?></p>
