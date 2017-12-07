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
                        Update Topic
                    </h3>
                </div>
                <div class="box-body">
                    @if(Session::has('fail'))
                        <div class="alert alert-danger"><p><strong>{{ Session::get('fail') }}</strong></p></div>
                    @endif
                    <div class="row  col-lg-offset-1">
                        <form method="POST" action="{{ route('topics.update', $topic->Id) }}" accept-charset="UTF-8" id="topic" class="topicForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <!-- EngName Field -->
                                <div class="col-sm-10">
                                    <label for="EngName">Topic's English Name</label>
                                    <input class="form-control" name="EngName" type="text" id="EngName" value="{{$topic->EngName}}">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- VieName Field -->
                                <div class="col-sm-10">
                                    <label for="VieName">Topic's VietNamese Name</label>
                                    <input class="form-control" name="VieName" type="text" id="VieName" value="{{$topic->VieName}}">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- Submit Field -->
                                <div class="col-sm-12">
                                    <button class="btn btn-warning" type="button" onclick="window.location='{{ url()->previous() }}';" style="margin-left: 5px;"><i class="fa fa-reply-all" aria-hidden="true"></i> BACK</button>
                                    <button type="submit" form="topic" class="btn btn-primary" name="submit" value="UPDATE"><i class="glyphicon glyphicon-edit"></i> UPDATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
@stop