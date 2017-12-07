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
                        Add new Sentence
                    </h3>
                </div>
                <div class="box-body">
                    @if(Session::has('fail'))
                        <div class="alert alert-danger"><p><strong>{{ Session::get('fail') }}</strong></p></div>
                    @endif
                    <div class="row  col-lg-offset-1">
                        <form method="POST" action="{{ route('sentences.store') }}" accept-charset="UTF-8" id="sentence" class="sentenceForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <!-- EngName Field -->
                                <div class="col-sm-10">
                                    <label for="EngSentence">English Sentence</label>
                                    <input class="form-control" name="EngSentence" type="text" id="EngSentence" value="">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- VieWord Field -->
                                <div class="col-sm-10">
                                    <label for="VieSentence">Vietnamese Sentence</label>
                                    <input class="form-control" name="VieSentence" type="text" id="VieSentence" value="">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- Topic Field -->
                                <div class="col-sm-10">
                                    <label for="Topic">Topic</label>
                                    <select name="Topic" id="Topic" class="form-control">
                                        @foreach($topics as $topic)
                                            <option value="{{ $topic->Id }}">{{$topic->Id}}  -  {{ $topic->EngName }} ({{$topic->VieName}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- Submit Field -->
                                <div class="col-sm-12">
                                    <button class="btn btn-warning" type="button" onclick="window.location='{{ url()->previous() }}';" style="margin-left: 5px;"><i class="fa fa-reply-all" aria-hidden="true"></i> BACK</button>
                                    <button type="submit" form="sentence" class="btn btn-primary" name="submit" value="CREATE"><i class="glyphicon glyphicon-edit"></i> CREATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
@stop