<?php
include('global.vars.php');

//
// ------------------------------------------------------------
// ------------------------------------------------------------
// ------------------------------------------------------------
// ---------- TEAM FUNCTION ----------
// ----------
// ----------
//
// function outputTeam($id, $i)
// {
//     // Details
//     $nameFirst = get_user_meta($id, 'first_name');
//     $nameLast = get_user_meta($id, 'last_name');
//     $positionTitle = get_user_meta($id, 'position_or_role');
//     $roleDescription = get_user_meta($id, 'description');
//     // Mugshot
//     $mugshotID = get_user_meta($id, 'mugshot');
//     $mugshotURL = get_post($mugshotID['0'], 'ARRAY_A', 'raw');
//     // Output
//     $output = '
//     <section class="' . $GLOBALS['globalPrefix'] . '-profile-container" data-loop="' . $i . '">
//         <div class="__image">
//             <img src="' . $mugshotURL['guid'] . '" width="200" height="auto" />
//         </div>
//         <div class="__details">
//             <h5>' . $nameFirst['0'] . ' ' . $nameLast['0'] . '</h5>
//             <p><strong>' . $positionTitle['0'] . '</strong></p>
//             <p class="-bio">' . $roleDescription['0'] . '</p>
//         </div>
//     </section>
//     ';
//     return $output;
// }
