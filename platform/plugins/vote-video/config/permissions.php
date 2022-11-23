<?php
/**
 * permissions.php
 * Created by: trainheartnet
 * Created at: 23/12/2021
 * Contact me at: longlengoc90@gmail.com
 */
return [
    [
        'name' => 'Video Voting',
        'flag' => 'plugins.video_voting',
    ],
    [
        'name'        => 'Video',
        'flag'        => 'video.index',
        'parent_flag' => 'plugins.video_voting',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'video.create',
        'parent_flag' => 'video.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'video.edit',
        'parent_flag' => 'video.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'video.destroy',
        'parent_flag' => 'video.index',
    ],

    [
        'name'        => 'Categories',
        'flag'        => 'video_categories.index',
        'parent_flag' => 'plugins.video_voting',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'video_categories.create',
        'parent_flag' => 'video_categories.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'video_categories.edit',
        'parent_flag' => 'video_categories.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'video_categories.destroy',
        'parent_flag' => 'video_categories.index',
    ],
];
