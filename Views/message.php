<?php

if(isset($A_view['messageType'])) {
    echo "<section class='message-container'>
              <h1 class='" . $A_view['messageType'] . "'>" . $A_view['message'] . "</h1>
          </section>";
}