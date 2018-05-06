@extends('layouts.base')

@section('wrapper')
        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
                                <h4>Register</h4>
                                <form method="POST" enctype="application/x-www-form-urlencoded" action="{{ route('site.auth.registerPost') }}">
                                    {{ csrf_field() }}
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <input name="name" type="text" class="form-control" placeholder="User Name" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="password" type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input name="password2" type="password" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    <div class="checkbox">
                                        <label>
										<input name="is_confirmed" type="checkbox" {{ old('is_confirmed') ? 'checked' : '' }}> Agree the terms and policy
									</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have account ? <a href="{{ route('site.auth.login') }}"> Sign in</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection