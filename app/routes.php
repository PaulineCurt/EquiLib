<?php

$routes = [
    //PATIENT
    'home' => [
        'path' => '/',
        'controller' => 'HomeController',
        'method' => 'index'
    ],
    'profilePatient' => [
        'path' => '/profilePatient',
        'controller' => 'PatientController',
        'method' => 'profilePatient'
    ],
    'signupPatient' => [
        'path' => '/signupPatient',
        'controller' => 'PatientController',
        'method' => 'signupPatient'
    ],
    'loginPatient' => [
        'path' => '/loginPatient',
        'controller' => 'AuthController',
        'method' => 'loginPatient'
    ],
    'logoutPatient' => [
        'path' => '/logoutPatient',
        'controller' => 'AuthController',
        'method' => 'logoutPatient'
    ],
    'appointmentPatient' => [
        'path' =>'/appointmentPatient',
        'controller' =>'AppointmentController',
        'method' => 'appointmentPatient'
    ],
    // 'myAppointment' => [
    //     'path' => '/myappointment',
    //     'controller' => 'AppointmentController',
    //     'method' => 'displayAppointmentsByPatientId'
    // ],
    
    //PROFESSIONAL
    'homeProfessionnal' => [
        'path' => '/homeProfessionnal',
        'controller' => 'HomeProfessionnalController',
        'method' => 'homeProfessionnal'
    ],
    'profilePro' => [
        'path' => '/profilePro',
        'controller' => 'ProfessionnalController',
        'method' => 'profilePro'
    ],
    'signupPro' => [
        'path' => '/signupPro',
        'controller' => 'ProfessionnalController',
        'method' => 'signupPro'
    ],
    'loginPro' => [
        'path' => '/loginPro',
        'controller' => 'AuthProController',
        'method' => 'loginPro'
    ],
    'logoutPro' => [
        'path' => '/logoutPro',
        'controller' => 'AuthProController',
        'method' => 'logoutPro'
    ],
    'appointmentPro' => [
        'path' => '/appointmentPro',
        'controller' => 'ProfessionnalController',
        'method' => 'appointmentPro'
    ],

    // ADMIN
    'homeAdmin' => [
        'path' => '/homeAdmin',
        'controller' => 'AdminController',
        'method' => 'homeAdmin'
    ],
    'loginAdmin' => [
        'path' => '/loginAdmin',
        'controller' => 'AuthAdminController',
        'method' => 'loginAdmin'
    ],
    'logoutAdmin' => [
        'path' => '/logoutAdmin',
        'controller' => 'AuthAdminController',
        'method' => 'logoutAdmin'
    ],
    'specialityAdmin' => [
        'path' => '/specialityAdmin', 
        'controller' => 'AdminSpecialityController',
        'method' => 'listSpecialities',
    ],
    'patientList' => [
        'path' => '/patientList', 
        'controller' => 'AdminController',
        'method' => 'listPatients'
    ],
    'proList' => [
        'path' => '/proList', 
        'controller' => 'AdminController',
        'method' => 'listPros'
    ],
    'createSpeciality' => [
        'path' => '/createSpeciality', 
        'controller' => 'AdminSpecialityController',
        'method' => 'createSpeciality'
    ],
    'updateSpeciality' => [
        'path' => '/updateSpeciality', 
        'controller' => 'AdminSpecialityController',
        'method' => 'updateSpeciality'
    ],
    'updateSpecialityAjax' => [
        'path' => '/updateSpecialityAjax', 
        'controller' => 'AdminSpecialityController',
        'method' => 'updateSpecialityAjax'
    ],
    'deleteSpeciality' => [
        'path' => '/deleteSpeciality', 
        'controller' => 'AdminSpecialityController',
        'method' => 'deleteSpeciality'
    ],
    
    // STATIC PAGES
    'about' => [
        'path' => '/about',
        'controller' => 'StaticPageController',
        'method' => 'aboutPage'
    ],

    'faq' => [
        'path' => '/faq',
        'controller' => 'StaticPageController',
        'method' => 'faqPage'
    ],
];

return $routes;