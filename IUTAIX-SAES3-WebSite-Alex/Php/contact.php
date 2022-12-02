<?php
  $headers  = "From: no.reply.nwstories@gmail.com\n";

  $message  = "Salut Alphonse, \n\n";
  $message .= "J'espère que tu vas bien !\n";
  $message .= "Voila, j'ai découvert un super site :\n";
  $message .= "https://www.phpcodeur.net\n\n";
  $message .= "Va y jeter un oeil, il est terrible !\n\n";
  $message .= "Ciao.\n\n";
  $message .= "toto";

  mail('ganassialex@gmail.com', 'Super site', $message, $headers);
?>
