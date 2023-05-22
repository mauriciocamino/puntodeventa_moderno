Dear <?php echo $recipient_name; ?>! 
<br/>
Recientemente se envió una solicitud para restablecer una contraseña para su cuenta. Si esto fue un error, solo ignore este correo electrónico y no pasará nada.
<br/><br/>
Para restablecer su contraseña, visite el siguiente enlace:
<a href="<?php echo $reset_pass_link; ?>"><?php echo $reset_pass_link; ?></a>
<br/><br/>
Regards,
<br/>
<?php echo $from_name; ?>