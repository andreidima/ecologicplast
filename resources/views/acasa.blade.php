@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    Bine ai venit <b>{{ auth()->user()->name ?? '' }}</b>!

                    @include ('errors')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

