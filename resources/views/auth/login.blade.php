@extends('layouts.layout')

@section('content')
<div class="wrapper">
        <div class="form-wrapper">
            <form class="form-card" action="{{route('login')}}" method="POST">
                @csrf
                <div class="form-card-heading">
                    Login
                </div>
                <div class="form-card-content">
                    <div class="form-input-section">
                        <div class="form-input-label">
                            Email
                        </div>
                        <input class="form-input-input" name="email" type="text">
                    </div>
                    <br>
                    <div class="form-input-section">
                        <div class="form-input-label">
                            Password
                        </div>
                        <input class="form-input-input" name="password" type="password">
                    </div>
                    <br>
                </div>
                <button type="submit" class="form-btn">Sign In</button>
            </form>
        </div>
    </div>
</div>
@endsection
