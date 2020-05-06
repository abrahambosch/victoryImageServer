# imageservice

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

- Accept a multipart form image upload
- Resize / Recompress the image to at least 3 sizes (think thumbnail, small and full). You may change the image format and compression to best suite use on a website
- Store the image to S3 or GCP cloud storage and create a public url - ideally with a CDN frontend
- Save the image data to a table of your design in the local mysql database
- Make the image available to the frontend

## Installation

Via Composer

``` bash
$ composer require victorycto/imageservice
```

## AWS S3 setup
1. create a bucket on amazon s3
1. go to permissions->block public access and uncheck "Block all public access" so that the public can read from the bucket. (for testing)
1. create a subfolder "images"
1. set the bucket policy to the following. change the name of the bucket to your bucket. 

```$json
{
    "Version": "2012-10-17",
    "Id": "Policy1588402416528",
    "Statement": [
        {
            "Sid": "Stmt1588402410847",
            "Effect": "Allow",
            "Principal": "*",
            "Action": [
                "s3:DeleteObject",
                "s3:GetObject",
                "s3:PutObject"
            ],
            "Resource": "arn:aws:s3:::victoryimages/images"
        }
    ]
}
```


## Usage

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/victorycto/imageservice.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/victorycto/imageservice.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/victorycto/imageservice/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/victorycto/imageservice
[link-downloads]: https://packagist.org/packages/victorycto/imageservice
[link-travis]: https://travis-ci.org/victorycto/imageservice
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/victorycto
[link-contributors]: ../../contributors
