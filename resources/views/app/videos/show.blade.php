@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('videos.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.videos.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.videos.inputs.title')</h5>
                    <span>{{ $video->title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.videos.inputs.attributes')</h5>
                    <span>{{ $video->attributes ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.videos.inputs.original_language')</h5>
                    <span>{{ $video->original_language ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.videos.inputs.classification')</h5>
                    <span>{{ $video->classification ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.videos.inputs.series_id')</h5>
                    <span>{{ optional($video->series)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('videos.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Video::class)
                <a href="{{ route('videos.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
