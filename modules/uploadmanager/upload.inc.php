<?php

global $uploadSections;
$uploadSections = array();

$uploadSections['news_add'] = array(
    "limit" => 1,
    "filetype" => "jpg,jpeg,gif,png",
    "crop" => false,
    "crop_options" => array(
        "dir" => "public/img_cache/user_ph/users/",
        "width" => 230,
        "height" => 172
    ),
    "flip_dimensions" => true,
    "autosubmit" => true,
    "autorefresh" => true,
    "resize" => true, //if an array, then will be resized as given dimensions, if true or 1 then dimesions are 1000x1000
    "data" => array(
        "table" => "news_photo",
        "file_field" => "photo",
        "key_field" => "id",
        "obj_field" => "news_id",
        "dir" => "public/images/news/",
        "size_limit" => "5000000"
    )
);

$uploadSections['news'] = array(
    "limit" => 1,
    "filetype" => "jpg,jpeg,gif,png",
    "crop" => false,
    "crop_options" => array(
        "dir" => "public/img_cache/user_ph/users/",
        "width" => 230,
        "height" => 172
    ),
    "flip_dimensions" => true,
    "autosubmit" => true,
    "autorefresh" => true,
    "resize" => true, //if an array, then will be resized as given dimensions, if true or 1 then dimesions are 1000x1000
    "data" => array(
        "table" => "news_photo",
        "file_field" => "photo",
        "key_field" => "id",
        "obj_field" => "news_id",
        "dir" => "public/images/news/",
        "size_limit" => "5000000"
    )
);

$uploadSections['articles'] = array(
    "limit" => 1,
    "filetype" => "jpg,jpeg,gif,png",
    "crop" => false,
    "crop_options" => array(
        "dir" => "public/img_cache/user_ph/users/",
        "width" => 230,
        "height" => 172
    ),
    "flip_dimensions" => true,
    "autosubmit" => true,
    "autorefresh" => false,
    "resize" => true, //if an array, then will be resized as given dimensions, if true or 1 then dimesions are 1000x1000
    "data" => array(
        "table" => "articles_photo",
        "file_field" => "photo",
        "key_field" => "id",
        "obj_field" => "articles_id",
        "dir" => "public/images/article/",
        "size_limit" => "5000000"
    )
);

$uploadSections['banner'] = array(
    "limit" => 1,
    "filetype" => "jpg,jpeg,gif,png",
    "crop" => false,    
    "flip_dimensions" => false,
    "autosubmit" => true,
    "autorefresh" => true,
    "resize" => false, //if an array, then will be resized as given dimensions, if true or 1 then dimesions are 1000x1000
    "data" => array(
        "table" => "banner_photo",
        "file_field" => "photo",
        "key_field" => "id",
        "obj_field" => "banner_id",
        "dir" => "public/vualya/"
    )
);

$uploadSections['works_mini'] = array(
    "limit" => 1,
    "filetype" => "jpg,jpeg,gif,png",
    "crop" => false,    
    "flip_dimensions" => false,
    "autosubmit" => true,
    "autorefresh" => true,
    "resize" => false, //if an array, then will be resized as given dimensions, if true or 1 then dimesions are 1000x1000
    "data" => array(
        "table" => "works_mini",
        "file_field" => "photo",
        "key_field" => "id",
        "obj_field" => "works_id",
        "dir" => "public/images/works/mini/"
    )
);