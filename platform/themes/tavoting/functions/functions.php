<?php

register_page_template([
    'home' => __('Homepage'),
    'story' => __('Chuyện chưa kể'),
    'proud' => __('Tự hào 25 năm - vòng 1'),
]);

RvMedia::setUploadPathAndURLToPublic();
RvMedia::addSize('featured', 565, 375)
    ->addSize('medium', 400, 260)
    ->addSize('square', 300, 300);

/**
 * @param $id
 * @return mixed
 */
function getVimeoThumb($id) {
    $data = file_get_contents("https://vimeo.com/api/v2/video/$id.json");
    $data = json_decode($data);
    return $data[0]->thumbnail_large;
}

/**
 * @param $link
 * @return mixed|string
 */
function getVideoEmbedLink($link) {
    $id = '';
    try {
        if (str_contains($link, 'youtu')) {
            $imageArray = explode('?v=', $link);
            $id = 'https://www.youtube.com/embed/'.$imageArray[1].'?rel=0';
        } elseif (str_contains($link, 'vimeo')) {
            $imageArray = explode('vimeo.com/', $link);
            $id = 'https://player.vimeo.com/video/'.$imageArray[1];
        }

        return $id;
    } catch (Exception $e) {
        return $id;
    }
}
