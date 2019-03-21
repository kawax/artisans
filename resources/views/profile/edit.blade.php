@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-marginless is-centered">
            <div class="column is-4">
                <img src="{{ route('image.user', auth()->user()->name) }}">
            </div>

            <div class="column is-8">
                <div class="card mb-1">
                    <div class="card-content">
                        <div class="content">
                            <h1>プロフィール変更</h1>
                        </div>

                        <profile-component></profile-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
