@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('backend/general.events') }} - {{ trans('backend/general.add') }} {{ trans('backend/general.event') }}
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
        #date_at, #start_date, #end_date{
            border-radius: 0;
        }
        img[src=""] {
            display: none;
        }
        #discount-percent, #discount-nominal{
            margin-left: 10px;
        }
        .discount .bootstrap-switch{
            float: left;
        }
    </style>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('backend/general.event') }} {{ trans('backend/general.registration') }} </h3>
                </div>
                {!! Form::open(array('url' => route('admin-update-event',$event->id),'files'=>'true','method'=>'POST','id'=>'form-event')) !!}
                    <div class="box-body">
                        <div class="error"></div>
                        <div class="col-md-9">
                            <input type="hidden" name="event_id" class="form-control" id="event_id" value={{ $event->id }}>
                            <input type="hidden" name="count_schedule" class="form-control" id="count_schedule">
                            <div class="form-group{{ Form::hasError('title') }} title">
                                {!! Form::label('title', trans('backend/general.title').' *') !!}
                                {!! Form::text('title', $event->title, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.title')]) !!}
                                {!! Form::errorMsg('title') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('slug') }} slug">
                                {!! Form::label('slug', trans('backend/general.slug').' *') !!}
                                {!! Form::text('slug', $event->slug, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.slug')]) !!}
                                {!! Form::errorMsg('slug') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description') }} description">
                                {!! Form::label('description', trans('backend/general.description').' *') !!}
                                {!! Form::textarea('description', $event->description, ['class' => 'form-control tinymce', 'rows'=> '12', 'placeholder' => trans('backend/general.description')]) !!}
                                {!! Form::errorMsg('description') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('admission') }} admission">
                                {!! Form::label('admission', trans('backend/general.admission')) !!}
                                {!! Form::textarea('admission', $event->admission, ['class' => 'form-control tinymce', 'rows'=> '7', 'placeholder' => trans('backend/general.admission')]) !!}
                                {!! Form::errorMsg('admission') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('schedule_title') }} schedule_title">
                                {!! Form::label('schedule_title', trans('backend/general.schedule_title')) !!}
                                {!! Form::text('schedule_title', $event->schedule_title, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.schedule_title')]) !!}
                                {!! Form::errorMsg('schedule_title') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('schedule_info') }} schedule_info">
                                {!! Form::label('schedule_info', trans('backend/general.schedule_info')) !!}
                                {!! Form::textarea('schedule_info', $event->schedule_info, ['class' => 'form-control tinymce', 'rows'=> '7', 'placeholder' => trans('backend/general.schedule_info')]) !!}
                                {!! Form::errorMsg('schedule_info') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('price_title') }} price_title">
                                {!! Form::label('price_title', trans('backend/general.price_title')) !!}
                                {!! Form::text('price_title', $event->price_title, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.price_title')]) !!}
                                {!! Form::errorMsg('price_title') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('price_info') }} price_info">
                                {!! Form::label('price_info', trans('backend/general.price_info')) !!}
                                {!! Form::textarea('price_info', $event->price_info, ['class' => 'form-control tinymce', 'rows'=> '7', 'placeholder' => trans('backend/general.price_info')]) !!}
                                {!! Form::errorMsg('price_info') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('schedule_and_price_detail') }} schedule_and_price_detail">
                                {!! Form::label('schedule_and_price_detail', trans('backend/general.schedule_and_price_detail').' *') !!}
                                {!! Form::hidden('schedule_and_price_detail', null, ['class' => 'form-control', 'id' => 'schedule_and_price_detail','maxlength'=>'255', 'placeholder' => trans('backend/general.schedule_and_price_detail')]) !!}
                                {!! Form::errorMsg('schedule_and_price_detail') !!}
                                <table id="event-schedule-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                                    <thead>
                                        <tr>
                                            <th class="center-align"></th>
                                            <th>{{ trans('backend/general.date') }}</th>
                                            <th>{{ trans('backend/general.time') }}</th>
                                            <!-- <th class="center-align">{{ trans('backend/general.info') }}</th>
                                            <th>{{ trans('backend/general.price') }}</th> -->
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="form-group{{ Form::hasError('hide_schedule') }} hide_schedule">
                                <div class="checkbox">
                                    <a class="actAdd add-underline" data-name="schedule" href="javascript:void(0)" title="{{ trans('backend/general.add_more_schedules_and_prices') }}"><u>+ {{ trans('backend/general.add_more_schedules_and_prices') }}</u></a>
                                    <label class="padding-left-50">
                                        {!! Form::checkbox('hide_schedule', true, $event->hide_schedule) !!} {{ trans('backend/general.hide_schedule_price_details') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('promotion') }} promotion">
                                {!! Form::label('promotion', trans('backend/general.promotion')) !!}
                                <table id="event-promotion-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                                    <thead>
                                        <tr>
                                            <th class="center-align"></th>
                                            <th>{{ trans('backend/general.title') }}</th>
                                            <th>{{ trans('backend/general.date') }}</th>
                                            <th width="15%">{{ trans('backend/general.sort_order') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                                <a class="addPromotion add-underline" data-name="promotion" href="javascript:void(0)" title="{{ trans('backend/general.add_more_promotion') }}"><u>+ {{ trans('backend/general.add_more_promotion') }}</u></a>
                            </div>
                            <div class="form-group{{ Form::hasError('title_meta_tag') }} title_meta_tag">
                                {!! Form::label('title_meta_tag', trans('backend/general.title_meta_tag')) !!}
                                {!! Form::text('title_meta_tag', $event->title_meta_tag, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.title_meta_tag')]) !!}
                                {!! Form::errorMsg('title_meta_tag') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description_meta_tag') }} description_meta_tag">
                                {!! Form::label('description_meta_tag', trans('backend/general.description_meta_tag')) !!}
                                {!! Form::textarea('description_meta_tag', $event->description_meta_tag, ['rows' => 5, 'class' => 'form-control', 'placeholder' => trans('backend/general.description_meta_tag')]) !!}
                                {!! Form::errorMsg('description_meta_tag') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('keywords_meta_tag') }} keywords_meta_tag">
                                {!! Form::label('keywords_meta_tag', trans('backend/general.keywords_meta_tag')) !!}
                                {!! Form::textarea('keywords_meta_tag', $event->keywords_meta_tag, ['rows' => 5, 'class' => 'form-control', 'placeholder' => trans('backend/general.keywords_meta_tag')]) !!}
                                {!! Form::errorMsg('keywords_meta_tag') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('ga_tracking_code') }} ga_tracking_code">
                                {!! Form::label('ga_tracking_code', trans('backend/general.ga_tracking_code')) !!}
                                {!! Form::textarea('ga_tracking_code', $event->ga_tracking_code, ['rows' => 5, 'class' => 'form-control', 'placeholder' => trans('backend/general.ga_tracking_code')]) !!}
                                {!! Form::errorMsg('ga_tracking_code') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('ga_conversion_code') }} ga_conversion_code">
                                {!! Form::label('ga_conversion_code', trans('backend/general.ga_conversion_code')) !!}
                                {!! Form::textarea('ga_conversion_code', $event->ga_conversion_code, ['rows' => 5, 'class' => 'form-control', 'placeholder' => trans('backend/general.ga_conversion_code')]) !!}
                                {!! Form::errorMsg('ga_conversion_code') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('fp_tracking_code') }} fp_tracking_code">
                                {!! Form::label('fp_tracking_code', trans('backend/general.fp_tracking_code')) !!}
                                {!! Form::textarea('fp_tracking_code', $event->fp_tracking_code, ['rows' => 5, 'class' => 'form-control', 'placeholder' => trans('backend/general.fp_tracking_code')]) !!}
                                {!! Form::errorMsg('fp_tracking_code') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('fp_conversion_code') }} fp_conversion_code">
                                {!! Form::label('fp_conversion_code', trans('backend/general.fp_conversion_code')) !!}
                                {!! Form::textarea('fp_conversion_code', $event->fp_conversion_code, ['rows' => 5, 'class' => 'form-control', 'placeholder' => trans('backend/general.fp_conversion_code')]) !!}
                                {!! Form::errorMsg('fp_conversion_code') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('featured_image1') }} featured_image1">
                                {!! Form::label('featured_image1', trans('backend/general.featured_image1').'(2880px x 1000px) *') !!}
                                <br>(Max. size 1 mb)
                                <input id="featured_image1" name="featured_image1" class="form-control image" data-name="image1" type="file" value="{{$event->featured_image1}}">
                                {!! Form::errorMsg('featured_image1') !!}
                            </div>
                            <div class="form-group preview" id="div-preview_image1" data-name="image1">
                                <img src="{{ (!empty($event->featured_image1)) ? file_url('events/'.$event->featured_image1, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_image1" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image2') }} featured_image2">
                                {!! Form::label('featured_image2', trans('backend/general.featured_image2').'(1200px x 800px) *') !!}
                                <br>(Max. size 1 mb)
                                <input id="featured_image2" name="featured_image2" class="form-control image" data-name="image2" type="file" value="{{$event->featured_image2}}">
                                {!! Form::errorMsg('featured_image2') !!}
                            </div>
                            <div class="form-group preview" id="div-preview_image2" data-name="image2">
                                <img src="{{ (!empty($event->featured_image2)) ? file_url('events/'.$event->featured_image2, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_image2" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image3') }} featured_image3">
                                {!! Form::label('featured_image3', trans('backend/general.featured_image3').'(300px x 200px) *') !!}
                                <br>(Max. size 1 mb)
                                <input id="featured_image3" name="featured_image3" class="form-control image" data-name="image3" type="file" value="{{$event->featured_image3}}">
                                {!! Form::errorMsg('featured_image3') !!}
                            </div>
                            <div class="form-group preview" id="div-preview_image3" data-name="image3">
                                <img src="{{ (!empty($event->featured_image3)) ? file_url('events/'.$event->featured_image3, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_image3" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('share_image') }} share_image">
                                <label for="share_image">Social Media Sharing Image<br>(1200px x 630px) *</label>
                                <br>(Max. size 1 mb)
                                <input id="share_image" name="share_image" class="form-control image" data-name="share_image" type="file" value="{{$event->share_image}}">
                                {!! Form::errorMsg('share_image') !!}
                            </div>
                            <div class="form-group preview" id="div-preview_share_image" data-name="share_image">
                                <img src="{{ (!empty($event->share_image)) ? file_url('events/'.$event->share_image, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_share_image" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('event_type') }} event_type">
                                {!! Form::label('event_type', trans('backend/general.event_type').' *', array('class' => 'full-width')) !!}
                                {!! Form::select('event_type', array('1' => 'General',
                                        '0' => 'Seated'), $event->event_type, ['class' => 'form-control event_type', 'id' => 'event_type']) !!} 
                            </div>
                            <div id="seat_image-div" style="display:{{ ($event->event_type == false) ? 'block' : 'none' }}">
                                <div class="form-group{{ Form::hasError('seat_image') }} seat_image">
                                    {!! Form::label('seat_image', trans('backend/general.seat_image').' *') !!}
                                    <br>(Max. size 1 mb)
                                    <input id="seat_image" name="seat_image" class="form-control image" data-name="seat_image" type="file" value="{{$event->seat_image}}">
                                    {!! Form::errorMsg('seat_image') !!}
                                </div>
                                <div class="form-group preview" id="div-preview_seat_image" data-name="seat_image">
                                    <img src="{{ (!empty($event->seat_image)) ? file_url('events/'.$event->seat_image, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_seat_image" height="50%" width="50%">
                                </div>
                                <div class="form-group{{ Form::hasError('seat_image2') }} seat_image2">
                                    {!! Form::label('seat_image2', trans('backend/general.seat_image2')) !!} {!! (!empty($event->seat_image2)) ? '<a href="javascript:void(0)" data-id="seat_image2" data-value="'.$event->seat_image2.'" class="btn btn-danger btn-xs delete-seat_image2" title="Delete Seat Image 2"><i class="fa fa-trash-o fa-fw"></i></a>' : '' !!}
                                    <br>(Max. size 1 mb)
                                    <input id="seat_image2" name="seat_image2" class="form-control image" data-name="seat_image2" type="file" value="{{$event->seat_image2}}">
                                    {!! Form::errorMsg('seat_image2') !!}
                                </div>
                                <div class="form-group preview" id="div-preview_seat_image2" data-name="seat_image2">
                                    <img src="{{ (!empty($event->seat_image2)) ? file_url('events/'.$event->seat_image2, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_seat_image2" height="50%" width="50%">
                                </div>
                                <div class="form-group{{ Form::hasError('seat_image3') }} seat_image3">
                                    {!! Form::label('seat_image3', trans('backend/general.seat_image3')) !!} {!! (!empty($event->seat_image3)) ? '<a href="javascript:void(0)" data-id="seat_image3" data-value="'.$event->seat_image3.'" class="btn btn-danger btn-xs delete-seat_image3" title="Delete Seat Image 3"><i class="fa fa-trash-o fa-fw"></i></a>' : '' !!}
                                    <br>(Max. size 1 mb)
                                    <input id="seat_image3" name="seat_image3" class="form-control image" data-name="seat_image3" type="file" value="{{$event->seat_image3}}">
                                    {!! Form::errorMsg('seat_image3') !!}
                                </div>
                                <div class="form-group preview" id="div-preview_seat_image3" data-name="seat_image3">
                                    <img src="{{ (!empty($event->seat_image3)) ? file_url('events/'.$event->seat_image3, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_seat_image3" height="50%" width="50%">
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('venue') }} venue">
                                {!! Form::label('venue_id', trans('backend/general.venue').' *') !!}
                                {!! Form::select('venue_id', $dropdown, $event->venue_id, array('class' => 'form-control','data-option' => old('venue_id'))) !!}
                                {!! Form::errorMsg('venue_id') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('buylink') }} buylink">
                                {!! Form::label('buylink', trans('backend/general.buylink').' *') !!}
                                {!! Form::text('buylink', $event->buylink, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.buylink')]) !!}
                                {!! Form::errorMsg('buylink') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('buy_button_disabled') }} buy_button_disabled">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('buy_button_disabled', true, $event->buy_button_disabled, ['id' => 'buy_button_disabled', 'class' => 'buy_button_disabled']) !!} {{ trans('backend/general.buy_button_disabled') }}
                                    </label>
                                </div>
                            </div>
                            <div class="buymessage-div" style="display:none">
                                <div class="form-group{{ Form::hasError('buy_button_disabled_message') }} buy_button_disabled_message">
                                    {!! Form::label('buy_button_disabled_message', trans('backend/general.buy_button_disabled_message').' *') !!}
                                    {!! Form::text('buy_button_disabled_message', $event->buy_button_disabled_message, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.buy_button_disabled_message')]) !!}
                                    {!! Form::errorMsg('buy_button_disabled_message') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('video_link') }} video_link">
                                {!! Form::label('video_link', trans('backend/general.video_link').' ('.trans('backend/general.embed').')') !!}
                                {!! Form::text('video_link', $event->video_link, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.video_link')]) !!}
                                {!! Form::errorMsg('video_link') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('categories') }} category">
                                {!! Form::label('category', trans('backend/general.category').' *') !!} <a href="javascript:void(0)" class="btn btn-primary btn-xs addCategory" title="Edit"><i class="fa fa-plus fa-fw"></i></a>
                                {!! Form::select('categories[]', $categories, $selected, ['class' => 'form-control categories', 'multiple' => 'multiple', 'id' => 'categories']) !!}
                                {!! Form::errorMsg('categories') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('background_color') }} background_color">
                                {!! Form::label('background_color', trans('backend/general.background_color').' *') !!}
                                {!! Form::text('background_color', $event->background_color, ['id' => 'background_color', 'class' => 'form-control colorpicker','maxlength'=>'255', 'placeholder' => trans('backend/general.background_color')]) !!}
                                {!! Form::errorMsg('background_color') !!}
                            </div>
                            {{-- <div class="form-group{{ Form::hasError('event_id_tixtrack') }} event_id_tixtrack">
                                {!! Form::label('event_id_tixtrack', trans('backend/general.event_id_tixtrack').' *') !!} 
                                {!! Form::text('event_id_tixtrack', $event->event_id_tixtrack, ['id' => 'event_id_tixtrack', 'class' => 'form-control number-only','maxlength'=>'255', 'placeholder' => trans('backend/general.event_id_tixtrack')]) !!}
                                {!! Form::errorMsg('event_id_tixtrack') !!}
                            </div> --}}
                            <div class="box-footer">
                                <input class="btn btn-primary pull-right pull-right" title="{{ trans('backend/general.button_save') }}" type="submit" value="{{ trans('backend/general.button_publish') }}" id="button_submit">
                                <button type="button" id="button_draft" class="btn btn-warning pull-right" title="{{ trans('backend/general.button_draft') }}">{{ trans('backend/general.button_draft') }}</button>
                                <a href="{{ route('admin-index-event') }}" class="btn btn-default pull-right">{{ trans('backend/general.button_back') }}</a>
                                <a id="button_preview" class="btn btn-success btn-preview pull-right btn-line2" title="{{ trans('backend/general.button_preview') }}">{{ trans('backend/general.button_preview') }}</a>
                            </div>
                        </div>
                        
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include('backend.admin.event.form_schedule_modal')
    @include('backend.admin.event.form_schedule_category_modal')
    @include('backend.admin.promotion.form_modal')
    @include('backend.admin.category.form_modal')



    <div id="delete-modal-schedule" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('backend/general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('backend/general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-schedule" href="#" class="continue-delete btn btn-default" data-dismiss="modal">Continue</a>
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
                    <p>{{ trans('backend/general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('backend/general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-category" href="#" class="continue-delete btn btn-default" data-dismiss="modal">Continue</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="delete-modal-promotion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('backend/general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('backend/general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-promotion" href="#" class="continue-delete btn btn-default" data-dismiss="modal">Continue</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div id="delete-modal-seat-image" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('backend/general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('backend/general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-seat-image" href="#" class="continue-delete btn btn-default" data-dismiss="modal">Continue</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div id="delete-modal-promotion-image" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('backend/general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                        <a id="btn-modal-cancel" class="btn btn-primary">{{ trans('backend/general.button_cancel') }}</a>&nbsp;
                        <a id="btn-modal-promotion-image" href="#" class="continue-delete btn btn-default" data-dismiss="modal">Continue</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.event.script.create_script')