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
                    CREATE NEW USER
                </h3>
            </div>
            <div class="box-body">
                @if(Session::has('fail'))
                    <div class="alert alert-danger"><p><strong>{{ Session::get('fail') }}</strong></p></div>
                @endif
                <div class="row">
                    <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8" id="user" class="userForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <!-- Fullname Field -->
                            <div class="col-sm-6">
                                <label for="fullname">Full name</label>
                                <input class="form-control" name="fullname" type="text" id="fullname">
                            </div>
                            <!-- Email Field -->
                            <div class="col-sm-6">
                                <label for="email" style="color: #9c3328">Email (Unique)</label>
                                <input class="form-control" name="email" type="email" id="email">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Password Field -->
                            <div class="col-sm-6">
                                <label for="password">Password</label>
                                <input class="form-control" name="password" type="password" id="password">
                            </div>

                            <!-- Password Confirmation Field -->
                            <div class="col-sm-6">
                                    <label for="password_confirmation">Password Confirmation</label>
                                <input class="form-control" name="password_confirmation" type="password" id="password_confirmation" value="">
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Submit Field -->
                            <div class="col-sm-12">
                                <button class="btn btn-warning" type="button" onclick="window.location='{{ url()->previous() }}';" style="margin-left: 5px;"><i class="fa fa-reply-all" aria-hidden="true"></i> Back</button>
                                <button type="submit" form="user" class="btn btn-primary" name="submit" value="Create"><i class="glyphicon glyphicon-plus"></i> Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>

@stop