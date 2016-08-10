@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.events') }} - {{ trans('general.add') }} {{ trans('general.event') }}
@endsection

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
        .input-group[class*=col-]{
            padding: 0 15px;
        }
        .datepicker.dropdown-menu{
            z-index: 1100 !important;
        }
        #datepicker{
            border-radius: 0;
        }
    </style>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.event') }} {{ trans('general.registration') }} </h3>
                </div>
                {!! Form::open(array('url' => route('admin-post-event'),'files'=>'true','method'=>'POST','id'=>'form-event')) !!}
                    <div class="box-body">
                        <div class="error"></div>
                        <div class="col-md-9">
                            <div class="form-group{{ Form::hasError('title') }} title">
                                {!! Form::label('title', trans('general.title').' *') !!}
                                {!! Form::text('title', old('title'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.title')]) !!}
                                {!! Form::errorMsg('title') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description') }} description">
                                {!! Form::label('description', trans('general.description').' *') !!}
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'rows'=> '12', 'placeholder' => trans('general.description')]) !!}
                                {!! Form::errorMsg('description') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('admission') }} admission">
                                {!! Form::label('admission', trans('general.admission').' *') !!}
                                {!! Form::textarea('admission', old('admission'), ['class' => 'form-control', 'rows'=> '7', 'placeholder' => trans('general.admission')]) !!}
                                {!! Form::errorMsg('admission') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('price_info') }} price_info">
                                {!! Form::label('price_info', trans('general.price_info').' *') !!}
                                {!! Form::textarea('price_info', old('price_info'), ['class' => 'form-control', 'rows'=> '7', 'placeholder' => trans('general.price_info')]) !!}
                                {!! Form::errorMsg('price_info') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('price_detail') }} price_detail">
                                {!! Form::label('price_info', trans('general.price_detail').' *') !!}
                                <table id="price-detail-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                                    <thead>
                                        <tr>
                                            <th class="center-align"></th>
                                            <th>{{ trans('general.date') }}</th>
                                            <th>{{ trans('general.time') }}</th>
                                            <th class="center-align">{{ trans('general.info') }}</th>
                                            <th>{{ trans('general.price') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                                <a class="actAdd add-underline" href="javascript:void(0)" title="{{ trans('general.add_more_schedules_and_prices') }}"><u>+ {{ trans('general.add_more_schedules_and_prices') }}</u></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('featured_image1') }} featured_image1">
                                {!! Form::label('featured_image1', trans('general.featured_image1').' *') !!}
                                {!! Form::file('featured_image1', old('featured_image1'), ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('featured_image1') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image2') }} featured_image2">
                                {!! Form::label('featured_image2', trans('general.featured_image2').' *') !!}
                                {!! Form::file('featured_image2', old('featured_image2'), ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('featured_image2') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image3') }} featured_image3">
                                {!! Form::label('featured_image3', trans('general.featured_image3').' *') !!}
                                {!! Form::file('featured_image3', old('featured_image3'), ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('featured_image3') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('event_type') }} event_type">
                                {!! Form::label('event_type', trans('general.event_type').' *', array('class' => 'full-width')) !!}
                                <input type="checkbox" name="event_type" class="form-control event_type-check" data-animate="false" data-on-text="Enabled" data-off-text="Disabled" >
                            </div>
                            <div class="form-group{{ Form::hasError('venue_id') }} venue_id">
                                {!! Form::label('venue_id', trans('general.venue').' *') !!}
                                {!! Form::select('venue_id', $data['dropdown'], null, array('class' => 'form-control','data-option' => old('venue_id'))) !!}
                                {!! Form::errorMsg('venue_id') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('buylink') }} buylink">
                                {!! Form::label('buylink', trans('general.buylink').' *') !!}
                                {!! Form::text('buylink', old('buylink'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.buylink')]) !!}
                                {!! Form::errorMsg('buylink') !!}
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('admin-index-event') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                                <input class="btn btn-primary pull-right" title="{{ trans('general.button_save') }}" type="submit" value="{{ trans('general.button_publish') }}" id="button_submit">
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
            <h4 class="modal-title" id="ModalLabel"><span id="title-create" style="display:none">{{ trans('general.add_schedule_and_price') }}</span><span id="title-update" style="display:none">{{ trans('general.edit') }}</span></h4>
          </div>
          <div class="modal-body">
            <div class="error"></div>
            <form id="form" class="form-horizontal">
                <div class="form-group">
                    {!! Form::label('date', trans('general.date'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                    <div class="col-sm-4">
                        {!! Form::text('date', old('date'), ['class' => 'form-control datepicker','maxlength'=>'255', 'id' => 'datepicker']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('time', trans('general.time'), array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-9">
                        {!! Form::text('time', old('time'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.time')]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('additional_info', trans('general.additional_info'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('additional_info', old('additional_info'), ['class' => 'form-control', 'rows'=> '5', 'placeholder' => trans('general.additional_info')]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('price', trans('general.price'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                    <div class="col-sm-9 input-group">
                        <span class="input-group-addon">$</span>
                        {!! Form::text('price', old('price'), ['class' => 'form-control','maxlength'=>'255']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('price', trans('general.price'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                    <div class="col-sm-4">
                        {!! Form::select('price', array('id' => '/person'), old('role'), array('class' => 'form-control','data-option' => old('price'))) !!}
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="button_save" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@include('backend.admin.event.script.create_script')