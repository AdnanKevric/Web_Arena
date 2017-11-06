<?php

  echo $this->Form->create('User', array('redirectUrl()' => 'register')); //Redirect to the register page so that you can create an account
  echo $this->Form->input('email'); //Type in your email address
  echo $this->Form->input('password', array('type' => 'password')); //Choose a password for this account
  echo $this->Form->submit(); //Button
  echo $this->Form->end();

?>


