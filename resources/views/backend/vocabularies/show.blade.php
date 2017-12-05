@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="clearfix"></div>
                <div class="box box-default">
                    <div class="box-header" style="background-color: #f4f4f4; ">
                        <h3 class="pull-left" style="margin: 4px 5px 0px 5px;">
                            Vocabulary detail
                        </h3>
                        <div class="pull-right" style="margin: 0px 10px;">
                            <a class="btn btn-primary pull-right" href="{{ route('vocabularies.edit',$vocabulary->Id) }}" style="margin-right: 10px;"><i class="glyphicon glyphicon-edit"></i> Edit vocabulary</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-bordered" id="tours-table">
                            
                            <tbody>
                                <tr>
                                    <td class="text-bold" width="150px">ID</td>
                                    <td>{{ $vocabulary->Id }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">English Word</td>
                                    <td>{{ $vocabulary->VocaEn }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">VietNamese Word</td>
                                    <td>{{ $vocabulary->VocaVi }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Category</td>
                                    <td>{{ $vocabulary->VocaCategory }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Pronouce</td>
                                    <td>{{ $vocabulary->VocaPronouce }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">English Example</td>
                                    <td>{{ $vocabulary->VocaExample }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">VietNamese Example</td>
                                    <td>{{ $vocabulary->VocaExplain }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Lesson</td>
                                    <td>{{$lesson->Id}} - {{ $lesson->LessonNameEn }} ({{$lesson->LessonNameVi}})</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Image</td>
                                    <td>
                                        <img src="{{asset('/storage/vocabulary/'.$vocabulary->VocaPath)}}" width="200px" height="200px">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <button class="btn btn-warning" type="button" onclick="window.location='{{ route('vocabularies.index') }}';" style="margin-top: 15px;"><i class="glyphicon glyphicon-remove"></i> Back</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop