@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h1 class="text-center">Register</h1>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') border border-danger @enderror"
                                    name="name" id="name" placeholder="Your Name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control @error('username') border border-danger @enderror"
                                    name="username" id="username" placeholder="Your Username"
                                    value="{{ old('username') }}">
                                @error('username')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') border border-danger @enderror"
                                    name="email" id="email" placeholder="Your Email" value="{{ old('email') }}">
                                @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password"
                                    class="form-control @error('password') border border-danger @enderror" name="password"
                                    id="password" placeholder="Your Password">
                                @error('password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" placeholder="Password Confirm">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
