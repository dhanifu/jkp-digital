@extends('_layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                Segala aktivitas yang Anda lakukan di area ini menjadi tanggung jawab anda sepenuhnya. Silahkan lakukan dengan teliti dan benar.
            </div>
        </div>
    </div>
</div>
@endsection
