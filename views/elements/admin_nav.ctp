<div class="navBar">
    <ul>
        <li><?php echo $html->link('Podcasts', array('controller' => 'casts', 'action' => 'index')); ?></li>
        <li><?php echo $html->link('Users', array('controller' => 'users', 'action' => 'index')); ?></li>
        <li><?php echo $html->link('Settings', array('controller' => 'settings', 'action' => 'index')); ?></li>
        <li class="menuLogoutLink"><?php echo $html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
    </ul>
</div>
