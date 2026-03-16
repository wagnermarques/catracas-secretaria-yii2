<?php

//configurations for web and console applications
return [
    'adminEmail' => 'wagner.marques3@etec.sp.gov.com',
    'senderEmail' => 'wagner.marques3@etec.sp.gov.com',
    'senderName' => 'catracas-secretaria',
    'googleAnalyticsId' => $_ENV['GOOGLE_ANALYTICS_ID'] ?? '',
    'googleTagManagerId' => $_ENV['GOOGLE_TAG_MANAGER_ID'] ?? '', 
];
