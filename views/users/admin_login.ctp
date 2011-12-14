<div class="users login admin">
    <?php
        $session->flash('auth');
        echo $form->create('User', array('action' => 'login'));
        echo $form->inputs(array(
            'legend' => __('Please Login', true),
            'username',
            'password'
        ));
        echo $form->end('Login');
    ?>
</div>