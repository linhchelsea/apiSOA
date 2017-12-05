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
                        Add new Vocabulary
                    </h3>
                </div>
                <div class="box-body">
                    @if(Session::has('fail'))
                        <div class="alert alert-danger"><p><strong>{{ Session::get('fail') }}</strong></p></div>
                    @endif
                    <div class="row  col-lg-offset-1">
                        <form method="POST" action="{{ route('vocabularies.store') }}" accept-charset="UTF-8" id="vocabulary" class="vocabularyForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <!-- EngName Field -->
                                <div class="col-sm-10">
                                    <label for="VocaEn">English Word</label>
                                    <input class="form-control" name="VocaEn" type="text" id="VocaEn" value="">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- VieWord Field -->
                                <div class="col-sm-10">
                                    <label for="VocaVi">Vietnamese Word</label>
                                    <input class="form-control" name="VocaVi" type="text" id="VocaVi" value="">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- Category Field -->
                                <div class="col-sm-10">
                                    <label for="VocaCategory">Category</label>
                                    <select name="VocaCategory" id="VocaCategory" class="form-control">
                                        <option value=""></option>
                                        <option value="(v)">(v)</option>
                                        <option value="(n)">(n)</option>
                                        <option value="(adj)">(adj)</option>
                                        <option value="(adv)">(adv)</option>
                                        <option value="(pret)">(pret)</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- Pronouce Field -->
                                <div class="col-sm-10">
                                    <label for="VocaPronouce">Pronouce</label>
                                    <input class="form-control" name="VocaPronouce" type="text" id="VocaPronouce" value="">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- EngExample Field -->
                                <div class="col-sm-10">
                                    <label for="VocaExample">English Example</label>
                                    <input class="form-control" name="VocaExample" type="text" id="VocaExample" value="">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- VieWord Field -->
                                <div class="col-sm-10">
                                    <label for="VocaExplain">Vietnamese Example</label>
                                    <input class="form-control" name="VocaExplain" type="text" id="VocaExplain" value="">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- Lesson Field -->
                                <div class="col-sm-10">
                                    <label for="LessonNumber">Lesson</label>
                                    <select name="LessonNumber" id="LessonNumber" class="form-control">
                                        @foreach($lessons as $lesson)
                                            <option value="{{ $lesson->Id }}">{{$lesson->Id}}  -  {{ $lesson->LessonNameEn }} ({{$lesson->LessonNameVi}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10">
                                    <label for="image">Choose one photo of Lesson <span style="color: red;">(Ratio - width x height - 1:1)</span> </label>
                                    <input class="form-control" name="image" type="file" id="image" onchange="viewImage(this)">
                                    <br>
                                    <p><img id="image-show" src="{{ asset('/storage/default.png') }}" alt="no-image" class="img-responsive" width="150px" height="150px"></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <!-- Submit Field -->
                                <div class="col-sm-12">
                                    <button class="btn btn-warning" type="button" onclick="window.location='{{ url()->previous() }}';" style="margin-left: 5px;"><i class="fa fa-reply-all" aria-hidden="true"></i> BACK</button>
                                    <button type="submit" form="vocabulary" class="btn btn-primary" name="submit" value="CREATE"><i class="glyphicon glyphicon-edit"></i> CREATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
@stop