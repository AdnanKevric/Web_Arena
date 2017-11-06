<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php


        
                       

   // user is logged 
   $fighters = $this->Html->link(
        'Home',
        array('controller' => 'Arenas', 'action' => 'fighter')); 
        
        echo '<li><a>';echo $fighters; echo '</a></li>';
    $diary = $this->Html->link(
        'Diary',
        array('controller' => 'Arenas', 'action' => 'diary')); 
        
        echo '<li><a>';echo $diary; echo '</a></li>';
   
    $logout = $this->Html->link(
        'Logout',
        array('controller' => 'Arenas', 'action' => 'logout')); 
        
        echo '<li><a>';echo $logout; echo '</a></li>';
        
    
   

   
?>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
	
	
	
	
    <footer style= "background-color: greenyellow">
	<div class="footer-center">
        <p> <strong>Gr-SI4-05</strong> - Emina Dedid , Adnan Kevric, Fernanda Medellin, Thembi Mpofu</p>
        <a href="https://github.com/AdnanKevric/Web_Arena.git">Github</a>
		
        
    </div>
    </footer>
</body>
</html>


