<?
require_once __DIR__ . '/../config/global.init.php';
require_once __DIR__ . '/../config/global.public.php';

require_once __DIR__ . '/../templates/header.public.php'; // Header Template

// Load the HTML form for search
require __DIR__ . '/../src/View/searchQuick.php';

require_once __DIR__ . '/../templates/banner.public.php';
require_once __DIR__ . '/../templates/why.public.php';
require_once __DIR__ . '/../templates/discover.public.php';

// Load the HTML form for search
require __DIR__ . '/../src/View/searchQuick.php';

// Load the job listing
use JoyApplicant\Controller\JobController;

$dbConnection = require_once __DIR__ . '/../config/global.db.php';
$jobController = new JobController($dbConnection);
$jobs = $jobController->getRandomJob(4);

// Output the job listings
include __DIR__ . '/../src/View/jobCard.php';

require_once __DIR__ . '/../templates/footer.public.php'; // Footer Template