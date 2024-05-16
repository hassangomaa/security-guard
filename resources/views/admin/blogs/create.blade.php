@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('global.blogs') }}
        </div>

        <div class="card-body">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">{{ trans('global.title') }}</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="content">{{ trans('global.content') }}</label>
                    <input type="text" name="content" id="content" class="form-control" value="{{ old('content') }}" required>
                </div>
              
                
                <!-- Add Image as must -->
                <div class="form-group">
                    <label  class=" required" for="image">{{ trans('global.image') }}</label>
                    <input type="file" name="image" id="image" class="form-control required" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
