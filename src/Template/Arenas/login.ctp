
<html>
<body>


<div class="users form">

	<?= $this->Flash->render('auth') ?>
	<?= $this->Form->create() ?>

<fieldset>

	<h2><?= __('Log in with your email and your password!') ?></h2> <!--Title-->
		<?= $this->Form->input('email', ['placeholder' => 'Email']) ?> <!--Input for the email-->
		<?= $this->Form->input('password', ['placeholder' => 'Password']) ?> <!--Input for the password-->

</fieldset>

		<?= $this->Form->button(__('Log In')); ?> <!--Button-->
		<?= $this->Form->end() ?>

</div>


</body>

</html>