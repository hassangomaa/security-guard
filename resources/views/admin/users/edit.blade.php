@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required">{{ trans('main.language') }}</label>
                <select class="form-control select2" name="lang" required>
                    <option value="en" @if($user->lang == 'en') selected @endif>{{ trans('main.english') }}</option>
                    <option value="ar" @if($user->lang == 'ar') selected @endif>{{ trans('main.arabic') }}</option>
                </select>
                @error('lang')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                <input required class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
            </div>

            {{-- <div class="form-group">
                <label class="required" for="profile_image">{{ trans('cruds.user.fields.profile_image') }}</label>
                <input class="form-control-file {{ $errors->has('profile_image') ? 'is-invalid' : '' }}" type="file" name="profile_image" id="profile_image">
                @error('profile_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.user.fields.profile_image_helper') }}</span>
            </div> --}}

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
