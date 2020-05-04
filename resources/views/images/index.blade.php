<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel S3</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <style>
        body {
            background: #ededed;
        }
    </style>
</head>
<body>
<div class="container mt-3">
    <h1>Victory Images</h1>
    <div class="row pt-5">

        <div class="col-sm-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
        </div>
        <div class="col-sm-9">
            @if (count($images) > 0)
                @foreach ($images as $image)
                    <div class="row border mb-2 image-list-item">
                        <div class="col-md-3 d-flex align-items-center p-2">
                            <img src="{{ $image['url'] }}" style="max-width: 100%; "/>
                        </div>
                        <div class="col-md-9 p-2">
                            <h4>{{ $image['title'] }}</h4>
                            <div>Original File Name: {{ $image['client_original_name'] }}</div>
                            <div>File Name: {{ $image['filename'] }}</div>
                            <div>Url: {{ $image['url'] }}</div>
                            <div>Created: {{ $image['created_at'] }}</div>
                        </div>
                    </div>
                @endforeach

            @else
                <p>Nothing images found</p>
            @endif
        </div>
        <div class="col-sm-3">
            <div class="card image-form">
                <div class="card-body">
                    <h5 class="card-title">Upload a new Image</h5>
                    <form action="{{ url('/images') }}" method="POST" enctype="multipart/form-data"
                          class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
<style>
    .image-list-item {
        background-color: #ffffff;
        overflow: auto;
    }
    .image-form {
        background-color: #ffffff;
    }
</style>
</body>
</html>
