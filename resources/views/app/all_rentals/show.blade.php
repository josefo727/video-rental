@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-rentals.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.all_rentals.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.all_rentals.inputs.user_id')</h5>
                    <span>{{ optional($rentals->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_rentals.inputs.video_id')</h5>
                    <span>{{ optional($rentals->video)->title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_rentals.inputs.type')</h5>
                    <span>{{ $rentals->type ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_rentals.inputs.total_value')</h5>
                    <span>{{ $rentals->total_value ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.all_rentals.inputs.view_limit')</h5>
                    <span>{{ $rentals->view_limit ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-rentals.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Rentals::class)
                <a
                    href="{{ route('all-rentals.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
