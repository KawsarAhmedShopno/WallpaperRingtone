@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">All Wallpaper

                    <span class="float-right">
                        <a href="{{route('photos.create')}}">
                            <button class="btn btn-primary">Create Wallpaper</button>
                        </a>
                    </span>
                </div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>

                                <th scope="col">Image</th>



                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(count($photos)>0)
                            @foreach($photos as $key =>$photo)
                            <tr>
                                <th scope="row">{{$key+1}}</th>

                                <td>{{$photo->title}}</td>
                                <td>{{$photo->description}}</td>
                                <td> <img src="/upload/{{$photo->file}}" width=100px>
                                </td>



                                <td>
                                    <a href="{{route('photos.edit',[$photo->id])}}">
                                        <button class="btn btn-info">Edit</button>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{route('photos.destroy',[$photo->id])}}" method="post" onSubmit="return confirm('Do you want to delete?')">@csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger">Delete</button>

                                    </form>
                                </td>


                            </tr>
                            @endforeach
                            @else

                            <td>No photo to display</td>
                            @endif

                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </div>
</div>

@endsection