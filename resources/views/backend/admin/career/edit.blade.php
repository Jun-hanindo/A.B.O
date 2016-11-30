@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('backend/general.careers') }} - {{ trans('backend/general.edit') }} {{ trans('backend/general.career') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('backend/general.edit') }} {{ trans('backend/general.career') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-update-career',$data->id),'method'=>'POST','id'=>'form-career')) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="error"></div>
                        <div class="col-md-9">
                            {!! Form::hidden('id', $data->id, array('id' => 'id', 'class' => 'form-control')) !!}
                            <div class="form-group{{ Form::hasError('department') }} department">
                                {!! Form::label('department', trans('backend/general.department').' *') !!} <a href="javascript:void(0)" class="btn btn-primary btn-xs addDepartment" title="Add"><i class="fa fa-plus fa-fw"></i></a>
                                {!! Form::text('department', $data->department_id, array('id' => 'department', 'class' => 'form-control','data-option' => $data->department_name)) !!}
                                {!! Form::errorMsg('department') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('position') }} position">
                                {!! Form::label('position', trans('backend/general.position').' *') !!}
                                {!! Form::text('position', $data->job, ['id' => 'position', 'class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.position')]) !!}
                                {!! Form::errorMsg('position') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description') }} description">
                                {!! Form::label('description', trans('backend/general.description').' *') !!}
                                {!! Form::textarea('description', $data->description, ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('backend/general.description')]) !!}
                                {!! Form::errorMsg('description') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('responsibilities') }} responsibilities">
                                {!! Form::label('responsibilities', trans('backend/general.responsibilities').' *') !!}
                                {!! Form::textarea('responsibilities', $data->responsibilities, ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('backend/general.responsibilities')]) !!}
                                {!! Form::errorMsg('responsibilities') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('pre_requisites') }} pre_requisites">
                                {!! Form::label('pre_requisites', trans('backend/general.pre_requisites').' *') !!}
                                {!! Form::textarea('pre_requisites', $data->pre_requisites, ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('backend/general.pre_requisites')]) !!}
                                {!! Form::errorMsg('pre_requisites') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('job_type') }} job_type">
                                {!! Form::label('job_type', trans('backend/general.job_type')) !!}
                                {!! Form::select('job_type', array('Full-time' => 'Full-time',
                                                                'Permanent' => 'Permanent',
                                                                'Contract' => 'Contract',
                                                                'Internship' => 'Internship',
                                                                'Part-time' => 'Part-time',
                                                                'Temporary' => 'Temporary',
                                                                'Subcontract' => 'Subcontract',
                                                                'Fresh Graduate' => 'Fresh Graduate',
                                                                'Volunteer' => 'Volunteer',
                                                                'Remote' => 'Remote'), $data->type, ['class' => 'form-control job_type', 'id' => 'job_type']) !!}
                                {!! Form::errorMsg('job_type') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('salary') }} salary">
                                {!! Form::label('salary', trans('backend/general.salary').' *') !!}
                                <div class="input-group currency-value">
                                    {!! Form::select('currency_id', $data['currencies'], $data->currency_id, array('class' => 'form-control','data-option' => old('currency_id'))) !!}
                                    {!! Form::text('salary', $data->salary, ['class' => 'form-control number-only','maxlength'=>'255', 'placeholder' => trans('backend/general.salary')]) !!}
                                    
                                </div>
                                {!! Form::errorMsg('salary') !!}
                            </div>
                            <div class="box-footer">
                                <input class="btn btn-primary pull-right" title="{{ trans('backend/general.button_save') }}" type="submit" value="{{ trans('backend/general.button_publish') }}" id="button_submit">
                                <a href="{{ route('admin-index-career') }}" class="btn btn-default pull-right">{{ trans('backend/general.button_cancel') }}</a>
                            </div>
                        </div>
                        
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ModalLabel"><span id="title-create">{{ trans('backend/general.add') }} {{ trans('backend/general.department') }}</span></h4>
          </div>
          <div class="modal-body">
            <div class="error-modal"></div>
            <form id="form">
                <input type="hidden" name="id" class="form-control" id="id">
                <div class="form-group name">
                    <label for="event" class="control-label">{{ trans('backend/general.name') }} :</label>
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control')) !!}
                    {!! Form::errorMsg('name') !!}
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="button_save" class="btn btn-primary" title="{{ trans('backend/general.button_save') }}">{{ trans('backend/general.button_save') }}</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@include('backend.admin.career.script.create_script')