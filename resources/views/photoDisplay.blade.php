@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($photos as $photo)

        <div class="col-md-10 mt-4">
            <div class="card">
                <div class="card-header">{{$photo->title}}</div>

                <div class="card-body">
                    <p>{{$photo->description}}</p>
                    <p>
                        <img src="/upload/{{$photo->file}}" class="img-thumbnail" style="width: 100%;">
                    </p>
                </div>
            </div>

        </div>
        <div class="col-md-2 mt-4">
            <h3> Download</h3>

            <p>
            <form action="{{route('download1',[$photo->id])}}" method="post">@csrf
                <button class="btn btn-primary" type="submit">1280x1024</button>
            </form>
            </p>
            <p>

            <form action="{{route('download2',[$photo->id])}}" method="post">@csrf
                <button class="btn btn-primary" type="submit"> 800x600</button>
            </form>
            </p>

            <p>
            <form action="{{route('download3',[$photo->id])}}" method="post">@csrf
                <button class="btn btn-primary" type="submit">316x255</button>
            </form>
            </p>
            <form action="{{route('download4',[$photo->id])}}" method="post">@csrf
                <button class="btn btn-primary" type="submit">118x95</button>
            </form>
        </div>
        @endforeach


    </div>
</div>
@endsection