@extends('layouts.layout')

@section('content')
<div class="wrapper">
        <div class="form-wrapper">
            <form class="form-card" action="{{route('login')}}" method="POST">
                <div class="form-card-heading">
                    Login
                </div>
                <div class="form-card-content">
                    <div class="form-input-section">
                        <div class="form-input-label">
                            Name
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
