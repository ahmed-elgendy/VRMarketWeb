<?php

function lang($phrase){
    
    static $lang = array(
        //Navbar Links
    'HOME_ADMIN'       => 'Home',
    'UPLOADS'          => 'Uploads',
    'MEMBERS'          => 'Members',
    'COMMENTS'         => 'Comments',
    'STATISTICS'       => 'Statistics',
    'LOGS'             => 'Logs',
    'Locations'        => 'Locations'
    );
    return $lang[$phrase];
}