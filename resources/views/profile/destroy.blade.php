@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-marginless is-centered">
            <div class="column is-12">
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <h1>アカウント削除</h1>

                            <ul>
                                <li>保存済データはすべて削除されます。</li>
                                <li>ログインし直せば再度登録できます。</li>
                            </ul>
                        </div>

                        <form action="{{ route('profile.delete') }}" method="post">
                            @csrf
                            @method('DELETE')

                            <input class="button is-primary" type="submit" value="削除">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
