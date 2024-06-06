@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body">
                {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                <div class="form-group">
                    <label for="name">Name</label>
                    {!! Form::text('name', null, ['class' => 'form-control', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="email">Email</label>
                    {!! Form::text('email', null, ['class' => 'form-control', ]) !!}
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="nohp">No HP</label>
                    {!! Form::text('nohp', null, ['class' => 'form-control', ]) !!}
                    <span class="text-danger">{{ $errors->first('nohp') }}</span>
                </div>
                @if (\Route::is('user.create','user.edit'))
                <div class="form-group mt-3">
                    <label for="akses">Akses</label>
                    {!! Form::select(
                        'akses',
                        [
                            'operator' => 'Operator web',
                            'admin' => 'Administrator',
                            'wali' => 'Wali Murid'
                        ], 
                        null, 
                        ['class' => 'form-control'],
                    ) !!}
                    <span class="text-danger">{{ $errors->first('akses') }}</span>
                </div>
                @endif
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>
                {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
