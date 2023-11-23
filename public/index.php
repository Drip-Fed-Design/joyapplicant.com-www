<?
require_once __DIR__ . '/../config/global.init.php';
require_once __DIR__ . '/../config/global.public.php';

use JoyApplicant\Controller\AuthenticateController;

require_once __DIR__ . '/../templates/header.public.php'; // Header Template

// Load the HTML form for search
require __DIR__ . '/../src/View/searchQuick.php';

require_once __DIR__ . '/../templates/banner.public.php';
require_once __DIR__ . '/../templates/why.public.php';
require_once __DIR__ . '/../templates/discover.public.php';

// Load the HTML form for search
require __DIR__ . '/../src/View/searchQuick.php';

require_once __DIR__ . '/../templates/jobs.public.php';
require_once __DIR__ . '/../templates/footer.public.php'; // Footer Template