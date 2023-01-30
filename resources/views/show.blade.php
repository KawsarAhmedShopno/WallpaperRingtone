@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ $ring->title }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <audio controls onplay="pauseOthers(this);" controlsList="nodownload">
                        <source src="/audio/{{$ring->file}}" type="audio/ogg">
                        Your browser does not support this element
                    </audio>
                    <form action="{{route('ringtones.download',[$ring->id])}}" method="post" enctype="multipart/form-data">@csrf
                        <div>
                            <button class="btn btn-primary" type="submit">download</button>
                        </div>
                    </form>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">title</th>
                                <th scope="col">description</th>
                                <th scope="col">category</th>
                                <th scope="col">download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>{{ $ring->title }}</td>
                                <td>{{ $ring->description }}</td>
                                <td>{{ $ring->category-> name }}</td>
                                <td>{{ $ring->download }}</td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <div class="col-md-4" style="margin-top:50px">
            category
            <ul class="list-group">

                @foreach($categories as $category)

                <li class="list-group-item list-group-item-secondary">{{$category->name}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection