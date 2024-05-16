@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.footer_content.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.footer-contents.update', $footer_content->id) }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="title">{{ trans('cruds.footer_content.fields.title') }}</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $footer_content->title) }}" required>
                </div>

                <div class="form-group">
                    <label for="icon">{{ trans('cruds.footer_content.fields.icon') }}</label>
                    <input type="text" class="form-control" name="icon" id="icon" value="{{ old('icon', $footer_content->icon) }}">
                </div>

                <div class="form-group">
                    <label for="link">{{ trans('cruds.footer_content.fields.link') }}</label>
                    <input type="text" class="form-control" name="link" id="link" value="{{ old('link', $footer_content->link) }}">
                </div>

                <div class="form-group">
                    <label for="social_media">
                        {{ trans('cruds.footer_content.fields.social_media') }}
                    </label>
                    <input type="hidden" name="social_media" value="0">
                    <input type="checkbox" name="social_media" id="social_media" value="1" {{ $footer_content->social_media ? 'checked' : '' }}>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
                    <a class="btn btn-secondary" href="{{ route('admin.footer-contents.index') }}">{{ trans('global.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
