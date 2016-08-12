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
        #date_at{
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
                            <input type="hidden" name="event_id" class="form-control" id="event_id">
                            <input type="hidden" name="count_schedule" class="form-control" id="count_schedule">
                            <div class="form-group{{ Form::hasError('title') }} title">
                                {!! Form::label('title', trans('general.title').' *') !!}
                                {!! Form::text('title', old('title'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.title')]) !!}
                                {!! Form::errorMsg('title') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description') }} description">
                                {!! Form::label('description', trans('general.description').' *') !!}
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control tinymce', 'rows'=> '12', 'placeholder' => trans('general.description')]) !!}
                                {!! Form::errorMsg('description') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('admission') }} admission">
                                {!! Form::label('admission', trans('general.admission').' *') !!}
                                {!! Form::textarea('admission', old('admission'), ['class' => 'form-control tinymce', 'rows'=> '7', 'placeholder' => trans('general.admission')]) !!}
                                {!! Form::errorMsg('admission') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('price_info') }} price_info">
                                {!! Form::label('price_info', trans('general.price_info').' *') !!}
                                {!! Form::textarea('price_info', old('price_info'), ['class' => 'form-control tinymce', 'rows'=> '7', 'placeholder' => trans('general.price_info')]) !!}
                                {!! Form::errorMsg('price_info') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('price_detail') }} price_detail">
                                {!! Form::label('price_info', trans('general.price_detail').' *') !!}
                                <table id="event-schedule-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                                    <thead>
                                        <tr>
                                            <th class="center-align"></th>
                                            <th>{{ trans('general.date') }}</th>
                                            <th>{{ trans('general.time') }}</th>
                                            <!-- <th class="center-align">{{ trans('general.info') }}</th>
                                            <th>{{ trans('general.price') }}</th> -->
                                        </tr>
                                    </thead>
                                </table>
                                <a class="actAdd add-underline" href="javascript:void(0)" title="{{ trans('general.add_more_schedules_and_prices') }}"><u>+ {{ trans('general.add_more_schedules_and_prices') }}</u></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('featured_image1') }} featured_image1">
                                {!! Form::label('featured_image1', trans('general.featured_image1').' *') !!}
                                <input id="featured_image1" name="featured_image1" class="form-control" type="file" value="">
                                {!! Form::errorMsg('featured_image1') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image2') }} featured_image2">
                                {!! Form::label('featured_image2', trans('general.featured_image2').' *') !!}
                                <input id="featured_image2" name="featured_image2" class="form-control" type="file" value="">
                                {!! Form::errorMsg('featured_image2') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image3') }} featured_image3">
                                {!! Form::label('featured_image3', trans('general.featured_image3').' *') !!}
                                <input id="featured_image3" name="featured_image3" class="form-control" type="file" value="">
                                {!! Form::errorMsg('featured_image3') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('event_type') }} event_type">
                                {!! Form::label('event_type', trans('general.event_type').' *', array('class' => 'full-width')) !!}
                                {!! Form::checkbox('event_type', '1', true, ['class' => 'form-control event_type-check', 'data-animate' => 'false', 'data-on-text' => 'General', 'data-off-text' => 'Seated']) !!}
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
                                <button type="button" id="button_draft" class="btn btn-primary pull-right" title="{{ trans('general.button_draft') }}">{{ trans('general.button_draft') }}</button>
                            </div>
                        </div>
                        
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form-schedule" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalLabel"><span id="title-create-schedule" style="display:none">{{ trans('general.add_schedule_and_price') }}</span><span id="title-update-schedule" style="display:none">{{ trans('general.edit') }}</span></h4>
                </div>
                <div class="modal-body">
                    <div class="error-modal"></div>
                    <form class="form-horizontal" id="form-event-schedule">
                        <input type="hidden" name="id" class="form-control" id="schedule_id">
                        <div class="form-group date_at">
                            {!! Form::label('date_at', trans('general.date'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                            <div class="col-sm-4">
                                <input type="text" name="date_at" class="form-control datepicker" id="date_at" maxlength="255">
                            </div>
                        </div>
                        <div class="form-group start_time">
                            {!! Form::label('start_time', trans('general.start_time'), array('class' => 'col-sm-3 control-label')) !!}
                            <div class="col-sm-3">
                                <input type="text" name="start_time" class="form-control" id="start_time" maxlength="255" placeholder = {{trans('general.start_time')}}>
                            </div>
                            {!! Form::label('end_time', trans('general.end_time'), array('class' => 'col-sm-3 control-label')) !!}
                            <div class="col-sm-3">
                                <input type="text" name="end_time" class="form-control" id="end_time" maxlength="255" placeholder = {{trans('general.end_time')}}>
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('price_detail') }} price_detail">
                            {!! Form::label('price_info', trans('general.price_detail'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                        </div>
                        <table id="event-schedule-category-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                            <thead>
                                <tr>
                                    <th class="center-align"></th>
                                    <th class="center-align">{{ trans('general.info') }}</th>
                                    <th>{{ trans('general.price') }}</th>
                                </tr>
                            </thead>
                        </table>
                        <a class="actAddCategory add-underline" href="javascript:void(0)" title="{{ trans('general.add_schedule_category') }}"><u>+ {{ trans('general.add_schedule_category') }}</u></a>
                    </form>
                </div>
            <div class="modal-footer">
                <button type="button" id="button_save_schedule" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
                <button type="button" id="button_update_schedule" class="btn btn-primary" title="{{ trans('general.button_update') }}">{{ trans('general.button_update') }}</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-form-category" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalLabel"><span id="title-create-category" style="display:none">{{ trans('general.add_schedule_and_price') }}</span><span id="title-update-category" style="display:none">{{ trans('general.edit') }}</span></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-event-category">
                        <input type="hidden" name="id" class="form-control" id="category_id">
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
                                {!! Form::text('price', old('price'), ['class' => 'form-control number-only','maxlength'=>'255']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4  col-sm-offset-3">
                                {!! Form::select('price_cat', array('/person' => '/person'), old('role'), array('class' => 'form-control','data-option' => old('price_cat'))) !!}
                            </div>
                        </div>
                    </form>
                </div>
            <div class="modal-footer">
                <button type="button" id="button_save_category" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
                <button type="button" id="button_update_category" class="btn btn-primary" title="{{ trans('general.button_update') }}">{{ trans('general.button_update') }}</button>
          </div>
        </div>
      </div>
    </div>
    <div id="delete-modal-schedule" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-default" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-schedule" href="#" class="btn btn-primary" data-dismiss="modal">Continue</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div id="delete-modal-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-default" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-category" href="#" class="btn btn-primary" data-dismiss="modal">Continue</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.event.script.create_script')