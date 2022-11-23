<?php
/**
 * email.php
 * Created by: trainheartnet
 * Created at: 16/01/2022
 * Contact me at: longlengoc90@gmail.com
 */
return [
    'name'        => 'Video Voting Email',
    'description' => 'Gửi Email trong plugin Video Voting',
    'templates'   => [
        'confirm-email'     => [
            'title'       => 'Mail đăng ký',
            'description' => 'Gửi Email khi đăng ký',
            'subject'     => 'Mail đăng ký dự thi',
            'can_off'     => false,
        ],
    ],
    'variables'   => [
        'fullname' => 'Fullname',
        'phone' => 'Phone',
        'email' => 'Email',
        'address' => 'Address',
        'age' => 'Age',
        'category' => 'Categories',
        'guardian_name' => 'Guardian Name',
        'guardian_phone' => 'Guardian Phone',
        'guardian_email' => 'Guardian Email',
        'video_link' => 'Video Link',
    ],
];
