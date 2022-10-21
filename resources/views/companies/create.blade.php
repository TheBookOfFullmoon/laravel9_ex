@extends('layout.layout')

@section('title', 'Add Company Form - Laravel 9 CRUD')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Add Company</h2>
            </div>
            <div class="pull-right">
                <a href="{{route('companies.index')}}" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
    @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{session('status')}}
        </div>
    @endif
    <form action="{{route('companies.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>Company Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Company Name">
                @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{$message}}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>Company Email:</strong>
                <input type="email" name="email" class="form-control" placeholder="Company Email">
                @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{$message}}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>Company Address:</strong>
                <input type="text" name="address" class="form-control" placeholder="Company Address">
                @error('address')
                    <div class="alert alert-danger mt-1 mb-1">{{$message}}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
@endsection
