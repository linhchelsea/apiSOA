@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content">
        @if($errors->count()>0)
            <ul class="alert alert-danger" style="list-style-type: none">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="box box-primary">
            <div class="box-header with-border" style="background-color: #c4e3f3;" >
                <h3 style="margin: 0px 5px; color: #0d6496;">
                    User Detail
                </h3>
            </div>
            <div class="box-body">
                @if(Session::has('fail'))
                    <div class="alert alert-danger"><p><strong>{{ Session::get('fail') }}</strong></p></div>
                @endif
                <div class="row">
                        <div class="form-group">
                            <!-- Email Field -->
                            <div class="col-sm-6">
                                <label for="email">Email</label>
                                <p class="form-control" id="email">{{$user->email}}</p>
                            </div>
                            <!-- Fullname Field -->
                            <div class="col-sm-6">
                                <label for="fullname">Full name</label>
                                <p class="form-control" id="name">{{$user->name}}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @if($user->idBlocked)
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="password">Why is {{ $user->name }} blocked??</label>
                                <textarea class="form-control" readonly>{{ $user->reason }}</textarea>
                                <br>
                                <a href="{{ route('unLockUser', $user->id) }}" class='btn btn-primary'>Unlock</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

</div>
@stop