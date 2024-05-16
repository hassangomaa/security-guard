@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.list') }} {{ trans('cruds.footer_content.title_plural') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.footer_content.fields.title') }}</th>
                        <th>{{ trans('cruds.footer_content.fields.icon') }}</th>
                        <th>{{ trans('cruds.footer_content.fields.link') }}</th>
                        <th>{{ trans('cruds.footer_content.fields.social_media') }}</th>
                        <th>{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($footerContents as $footerContent)
                        <tr>
                            <td>{{ $footerContent->title }}</td>
                            <td>{{ $footerContent->icon }}</td>
                            <td>{{ $footerContent->link }}</td>
                            <td>{{ $footerContent->social_media ? 'Yes' : 'No' }}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.footer-contents.edit', $footerContent->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                                <!-- Add delete button if needed -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
