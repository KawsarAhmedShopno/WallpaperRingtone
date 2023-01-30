@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @foreach($rings as $ringtone)
            <div class="card design" style="margin-top: 20px;">
                <div class="card-header">{{$ringtone->title}}</div>

                <div class="card-body">
                    <audio controls onplay="pauseOthers(this);" controlsList="nodownload">
                        <source src="/audio/{{$ringtone->file}}" type="audio/ogg">
                        Your browser does not support this element
                    </audio>
                </div>
                <div class="card-footer">
                    <a href="{{route('ringtones.show',[$ringtone->id,$ringtone->slug])}}">Info and Download</a>

                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-4" style="margin-top:50px">
            cate
            <ul class="list-group">

                @foreach($categories as $category)

                <a href="{{route('ringtones.category',[$category->id])}}" class="list-group-item list-group-item-secondary">{{$category->name}}</a>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection