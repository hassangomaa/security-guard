@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.contact.title_singular') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="name">{{ trans('cruds.contact.fields.name') }}</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $contact->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.contact.fields.email') }}</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ $contact->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="subject">{{ trans('cruds.contact.fields.subject') }}</label>
                <input class="form-control" type="text" name="subject" id="subject" value="{{ $contact->subject }}" readonly>
            </div>
            <div class="form-group">
                <label for="message">{{ trans('cruds.contact.fields.message') }}</label>
                <textarea class="form-control" name="message" id="message" readonly>{{ $contact->message }}</textarea>
            </div>
            <div class="form-group">
                <label for="date_and_time">{{ trans('cruds.contact.fields.date_and_time') }}</label>
                <input class="form-control" type="text" name="date_and_time" id="date_and_time" value="{{ $contact->date_and_time }}" readonly>
            </div>
            <div class="form-group">
                <label for="service">{{ trans('cruds.contact.fields.service') }}</label>
                <input class="form-control" type="text" name="service" id="service" value="{{ $contact->service }}" readonly>
            </div>
            <div class="form-group">
                <label for="meeting_type">{{ trans('cruds.contact.fields.meeting_type') }}</label>
                <input class="form-control" type="text" name="meeting_type" id="meeting_type" value="{{ $contact->meeting_type }}" readonly>
            </div>
            <div class="form-group">
                <a class="btn btn-danger" href="{{ route('admin.contact.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
@endsection
