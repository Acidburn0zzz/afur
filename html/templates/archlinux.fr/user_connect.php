<?php include ('header.php') ?>
<div class="box">
<form action='?action=connect&redirect=<?php echo $action_redirect; ?>' method='post'>
<table>
<tr><td>Nick:</td><td><input type='text' name='user' size='30' value="" maxlength='35' /></td></tr>
<tr><td>Mot de passe:</td><td><input type='password' name='passwd' size='30' value="" maxlength='35' /></td></tr>
<tr><td colspan='2'><input type='submit' name='submit' value='Se connecter' /></td></tr>
</table>
</form>
</div>

<?php include ('footer.php') ?>
