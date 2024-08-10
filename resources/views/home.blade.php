@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    {{ __('Kamu sudah login!') }}
                    <a href="{{ route('prasmanan_orders.index') }}"
                        class="btn border-none bg-gray-700 dark:bg-orange-700 text-white dark:text-white text-xs font-medium transition hover:text-gray-900">Klik
                        disini untuk mulai!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection