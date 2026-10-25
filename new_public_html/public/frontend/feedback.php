<?php

// This legacy handler sent mail with unsanitized headers and no real recipient.
// New enquiries are handled by Laravel's validated /feedback route.
header('Location: /contacts', true, 303);
exit;
