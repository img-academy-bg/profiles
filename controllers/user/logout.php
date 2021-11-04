<?php

// controllers/user/logout.php

session_destroy();

redirect_to('user', 'login');