@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.blogs.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">{{ trans('cruds.blogs.fields.title') }}</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $blog->title) }}" required>
            </div>
        
            <div class="form-group">
                <label for="content">{{ trans('cruds.blogs.fields.content') }}</label>
                <textarea class="form-control" name="content" id="content" rows="4" required>{{ old('content', $blog->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">{{ trans('cruds.blogs.fields.image') }}</label>
                <div>
                    @if ($blog->image)
                        <img src="{{ $blog->image}}" alt="Blog Image" class="img-fluid" style="max-width: 200px;">
                    @else
                        <p>No image uploaded</p>
                    @endif
                    <input type="file" name="image" id="image" class="form-control-file mt-2">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ trans('global.update') }}</button>
                <a class="btn btn-danger" href="{{ route('admin.blogs.index') }}">
                    {{ trans('global.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
