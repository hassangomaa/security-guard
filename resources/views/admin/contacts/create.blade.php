@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('global.contact_me') }}
        </div>

        <div class="card-body">
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ trans('global.name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">{{ trans('global.email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="subject">{{ trans('global.subject') }}</label>
                    <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}" required>
                </div>
                <div class="form-group">
                    <label for="message">{{ trans('global.message') }}</label>
                    <textarea name="message" id="message" class="form-control" required>{{ old('message') }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
