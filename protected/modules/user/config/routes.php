<?php

return array(
        'user/registration' => 'user/main/registration',
        'user/login' => 'user/main/login',
        'user/recovery' => 'user/main/recovery',
        'user/logout' => 'user/main/logout',
        'user/activation' => 'user/activation/activation',
        'user/<user>' => 'user/profile',
        'user/<user>/apartments/new' => 'user/profile/createApartment',
        'user/<user>/apartments/update/<id>' => 'user/profile/editApartment',
        'user/<user>/apartments/delete/<id>' => 'user/profile/deleteApartment',
        'user/<user>/update' => 'user/profile/edit',
        'user/<user>/apartmnets/booking' => 'user/profile/requests',
        'user/<user>/apartments/complaint' => 'user/profile/complaints',
        'user/<user>/password/update' => 'user/profile/changepassword',
        
);