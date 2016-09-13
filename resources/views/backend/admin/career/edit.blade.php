@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.careers') }} - {{ trans('general.edit') }} {{ trans('general.career') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.edit') }} {{ trans('general.career') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-update-career',$data->id),'method'=>'POST','id'=>'form-career')) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="error"></div>
                        <div class="col-md-9">
                            {!! Form::hidden('id', $data->id, array('id' => 'id', 'class' => 'form-control')) !!}
                            <div class="form-group{{ Form::hasError('department') }} department">
                                {!! Form::label('department', trans('general.department').' *') !!}
                                {!! Form::select('department', $data['department'], $data->department_id, array('class' => 'form-control','data-option' => old('department'))) !!}
                                {!! Form::errorMsg('department') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('position') }} position">
                                {!! Form::label('position', trans('general.position').' *') !!}
                                {!! Form::text('position', $data->job, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.position')]) !!}
                                {!! Form::errorMsg('position') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description') }} description">
                                {!! Form::label('description', trans('general.description').' *') !!}
                                {!! Form::textarea('description', $data->description, ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('general.description')]) !!}
                                {!! Form::errorMsg('description') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('responsibilities') }} responsibilities">
                                {!! Form::label('responsibilities', trans('general.responsibilities').' *') !!}
                                {!! Form::textarea('responsibilities', $data->responsibilities, ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('general.responsibilities')]) !!}
                                {!! Form::errorMsg('responsibilities') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('pre_requisites') }} pre_requisites">
                                {!! Form::label('pre_requisites', trans('general.pre_requisites').' *') !!}
                                {!! Form::textarea('pre_requisites', $data->pre_requisites, ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('general.pre_requisites')]) !!}
                                {!! Form::errorMsg('pre_requisites') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('type') }} type">
                                {!! Form::label('type', trans('general.type').' *') !!}
                                {!! Form::text('type', $data->type, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.type')]) !!}
                                {!! Form::errorMsg('type') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('salary') }} salary">
                                {!! Form::label('salary', trans('general.salary').' *') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::text('salary', $data->salary, ['class' => 'form-control number-only','maxlength'=>'255', 'placeholder' => trans('general.salary')]) !!}
                                    
                                </div>
                                {!! Form::errorMsg('salary') !!}
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('admin-index-career') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                                <input class="btn btn-primary pull-right" title="{{ trans('general.button_save') }}" type="submit" value="{{ trans('general.button_publish') }}" id="button_submit">
                            </div>
                        </div>
                        
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.career.script.create_script')