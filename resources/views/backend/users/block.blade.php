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
                    Block User
                </h3>
            </div>
            <div class="box-body">
                @if(Session::has('fail'))
                    <div class="alert alert-danger"><p><strong>{{ Session::get('fail') }}</strong></p></div>
                @endif
                <div class="row">
                    <form method="POST" action="{{ route('block-user',$user->id) }}" accept-charset="UTF-8" id="user_update" class="userForm" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <!-- Email Field -->
                            <div class="col-sm-6">
                                <label for="email">Email</label>
                                <p class="form-control" id="email">{{$user->email}}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Fullname Field -->
                            <div class="col-sm-6">
                                <label for="fullname">Full name</label>
                                <p class="form-control" id="name">{{$user->name}}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Reason-->
                            <div class="col-sm-6">
                                <label for="fullname">Reason</label>
                                <input type="text" class="form-control" name="reason">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Submit Field -->
                            <div class="col-sm-12">
                                <button class="btn btn-warning" type="button" onclick="window.location='{{ url()->previous() }}';" style="margin-left: 5px;"><i class="fa fa-reply-all" aria-hidden="true"></i> BACK</button>
                                <button type="submit" form="user_update" class="btn btn-danger" name="submit" value="Block"><i class="glyphicon glyphicon-edit"></i> BLOCK</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
@stop