<?php

return [
    'storage_disk' => 's3',
    'image_upload_path_prefix' => "/images",    // path for s3 storage.
    //'image_upload_path_prefix' => public_path('/images'),  // if not using s3, use this.
    'image_extensions' => ['jpeg', 'png', 'jpg', 'gif', 'svg'],
    'image_max_size' => 500000,
    'image_sizes' => [
        'large' => ['width' => 1080, 'height' => 810],      // 4:3 ratio
        'medium' => ['width' => 510, 'height' => 384],      // 4:3 ratio
        'small' => ['width' => 320, 'height' => 241],       // 4:3 ratio
        'thumbnail' => ['width' => 100, 'height' => 100]    // 1:1 ratio
    ]
];
