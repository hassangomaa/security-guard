@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.blogs.title_singular') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="title">{{ trans('cruds.blogs.fields.title') }}</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ $blog->title }}" readonly>
            </div>
        
            <div class="form-group">
                <label for="content">{{ trans('cruds.blogs.fields.content') }}</label>
                <input class="form-control" type="text" name="content" id="content" value="{{ $blog->content }}" readonly>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.blogs.fields.image') }}</label>
                <div>
                    @if (isset($blog) && $blog->image)
                    <div class="card-footer">
                    <img width="200px"   src="{{ $blog->image }}" alt="Blog Image" class="img-fluid">
                    </div>
                    @endif
                </div>
            </div>

            
            <div class="form-group">
                <a class="btn btn-danger" href="{{ route('admin.blogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
@endsection
