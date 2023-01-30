@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(Session::has('message'))
                    <div class="alert alert-success"> {{Session::get('message')}}
                    </div>
                    @endif
                    <form action="{{route('ringtones.store')}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="card">
                            <div class="card-header">Add new ringtone</div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"></textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="file">file</label>
                                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Category</label>
                                    <select name="category" class="form-control @error('category') is-invalid @enderror">
                                        <option value="">Slect category</option>
                                        @foreach(App\Models\Category::all() as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection