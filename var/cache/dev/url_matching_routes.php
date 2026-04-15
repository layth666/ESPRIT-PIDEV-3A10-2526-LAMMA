<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/face/enroll' => [[['_route' => 'api_face_enroll', '_controller' => 'App\\Controller\\FaceLoginController::enrollFace'], null, ['POST' => 0], null, false, false, null]],
        '/face/login' => [[['_route' => 'api_face_login', '_controller' => 'App\\Controller\\FaceLoginController::loginFace'], null, ['POST' => 0], null, false, false, null]],
        '/forgot-password/request' => [[['_route' => 'app_forgot_password_request', '_controller' => 'App\\Controller\\ForgotPasswordController::request'], null, ['POST' => 0], null, false, false, null]],
        '/forgot-password/verify' => [[['_route' => 'app_forgot_password_verify', '_controller' => 'App\\Controller\\ForgotPasswordController::verify'], null, ['POST' => 0], null, false, false, null]],
        '/forgot-password/reset' => [[['_route' => 'app_forgot_password_reset', '_controller' => 'App\\Controller\\ForgotPasswordController::reset'], null, ['POST' => 0], null, false, false, null]],
        '/connect/google' => [[['_route' => 'connect_google_start', '_controller' => 'App\\Controller\\GoogleAuthController::connectAction'], null, null, null, false, false, null]],
        '/connect/google/check' => [[['_route' => 'connect_google_check', '_controller' => 'App\\Controller\\GoogleAuthController::connectCheckAction'], null, null, null, false, false, null]],
        '/profile' => [[['_route' => 'app_profile', '_controller' => 'App\\Controller\\ProfileController::index'], null, ['GET' => 0], null, false, false, null]],
        '/profile/update-info' => [[['_route' => 'app_profile_update_info', '_controller' => 'App\\Controller\\ProfileController::updateInfo'], null, ['POST' => 0], null, false, false, null]],
        '/profile/update-photo' => [[['_route' => 'app_profile_update_photo', '_controller' => 'App\\Controller\\ProfileController::updatePhoto'], null, ['POST' => 0], null, false, false, null]],
        '/profile/change-password' => [[['_route' => 'app_profile_change_password', '_controller' => 'App\\Controller\\ProfileController::changePassword'], null, ['POST' => 0], null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\RegistrationController::register'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\SecurityController::home'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/banned' => [[['_route' => 'app_banned', '_controller' => 'App\\Controller\\SecurityController::banned'], null, null, null, false, false, null]],
        '/access-denied' => [[['_route' => 'app_access_denied', '_controller' => 'App\\Controller\\SecurityController::accessDenied'], null, null, null, false, false, null]],
        '/users' => [[['_route' => 'app_users_index', '_controller' => 'App\\Controller\\UsersController::index'], null, ['GET' => 0], null, false, false, null]],
        '/users/create' => [[['_route' => 'app_users_create', '_controller' => 'App\\Controller\\UsersController::create'], null, ['POST' => 0], null, false, false, null]],
        '/users/new' => [[['_route' => 'app_users_new', '_controller' => 'App\\Controller\\UsersController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/users/([^/]++)(?'
                    .'|(*:60)'
                    .'|/(?'
                        .'|edit(*:75)'
                        .'|promote(*:89)'
                        .'|demote(*:102)'
                        .'|ban(*:113)'
                    .')'
                    .'|(*:122)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        60 => [[['_route' => 'app_users_show', '_controller' => 'App\\Controller\\UsersController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        75 => [[['_route' => 'app_users_edit', '_controller' => 'App\\Controller\\UsersController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        89 => [[['_route' => 'app_users_promote', '_controller' => 'App\\Controller\\UsersController::promote'], ['id'], ['GET' => 0], null, false, false, null]],
        102 => [[['_route' => 'app_users_demote', '_controller' => 'App\\Controller\\UsersController::demote'], ['id'], ['GET' => 0], null, false, false, null]],
        113 => [[['_route' => 'app_users_ban', '_controller' => 'App\\Controller\\UsersController::ban'], ['id'], ['GET' => 0], null, false, false, null]],
        122 => [
            [['_route' => 'app_users_delete', '_controller' => 'App\\Controller\\UsersController::delete'], ['id'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
