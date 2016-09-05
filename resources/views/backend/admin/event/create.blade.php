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
        #date_at, #start_date, #end_date{
            border-radius: 0;
        }
        img[src=""] {
            display: none;
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
                            <div class="form-group{{ Form::hasError('schedule_info') }} schedule_info">
                                {!! Form::label('schedule_info', trans('general.schedule_info').' *') !!}
                                {!! Form::textarea('schedule_info', old('schedule_info'), ['class' => 'form-control tinymce', 'rows'=> '7', 'placeholder' => trans('general.schedule_info')]) !!}
                                {!! Form::errorMsg('schedule_info') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('schedule_and_price_detail') }} schedule_and_price_detail">
                                {!! Form::label('schedule_and_price_detail', trans('general.schedule_and_price_detail').' *') !!}
                                {!! Form::hidden('schedule_and_price_detail', null, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.schedule_and_price_detail')]) !!}
                                {!! Form::errorMsg('schedule_and_price_detail') !!}
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
                                <a class="actAdd add-underline" data-name="schedule" href="javascript:void(0)" title="{{ trans('general.add_more_schedules_and_prices') }}"><u>+ {{ trans('general.add_more_schedules_and_prices') }}</u></a>
                            </div>
                            <div class="form-group{{ Form::hasError('promotion') }} promotion">
                                {!! Form::label('promotion', trans('general.promotion')) !!}
                                <table id="event-promotion-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                                    <thead>
                                        <tr>
                                            <th class="center-align"></th>
                                            <th>{{ trans('general.title') }}</th>
                                            <th>{{ trans('general.date') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                                <a class="addPromotion add-underline" data-name="promotion" href="javascript:void(0)" title="{{ trans('general.add_more_promotion') }}"><u>+ {{ trans('general.add_more_promotion') }}</u></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('featured_image1') }} featured_image1">
                                {!! Form::label('featured_image1', trans('general.featured_image1').'(1440px x 400px) *') !!}
                                <input id="featured_image1" name="featured_image1" class="form-control image" data-name="image1" type="file" value="">
                                {!! Form::errorMsg('featured_image1') !!}
                            </div>
                            <div class="form-group privew" id="div-preview_image1" data-name="image1" style="display:none">
                                <img src="" name="preview" id="preview_image1" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image2') }} featured_image2">
                                {!! Form::label('featured_image2', trans('general.featured_image2').'(370px x 250px) *') !!}
                                <input id="featured_image2" name="featured_image2" class="form-control image" data-name="image2" type="file" value="">
                                {!! Form::errorMsg('featured_image2') !!}
                            </div>
                            <div class="form-group privew" id="div-preview_image2" data-name="image2" style="display:none">
                                <img src="" name="preview" id="preview_image2" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image3') }} featured_image3">
                                {!! Form::label('featured_image3', trans('general.featured_image3').'(150px x 101px) *') !!}
                                <input id="featured_image3" name="featured_image3" class="form-control image" data-name="image3" type="file" value="">
                                {!! Form::errorMsg('featured_image3') !!}
                            </div>
                            <div class="form-group privew" id="div-preview_image3" data-name="image3" style="display:none">
                                <img src="" name="preview" id="preview_image3" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('event_type') }} event_type">
                                {!! Form::label('event_type', trans('general.event_type').' *', array('class' => 'full-width')) !!}
                                {!! Form::checkbox('event_type', '1', true, ['class' => 'form-control event_type-check', 'data-animate' => 'false', 'data-on-text' => 'General',  'data-off-color' => 'success', 'data-off-text' => 'Seated']) !!}
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
                            <div class="form-group{{ Form::hasError('categories') }} category">
                                {!! Form::label('category', trans('general.category').' *') !!} <a href="javascript:void(0)" class="btn btn-primary btn-xs addCategory" title="Add"><i class="fa fa-plus fa-fw"></i></a>
                                {!! Form::select('categories[]', $data['categories'], null, ['class' => 'form-control categories', 'multiple' => 'multiple', 'id' => 'categories']) !!}
                                {!! Form::errorMsg('categories') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('category') }} background_color">
                                {!! Form::label('background_color', trans('general.background_color')) !!} 
                                {!! Form::select('background_color', array('green' => 'Green',
                                                                'purple' => 'Purple', 
                                                                'grey' => 'Grey', 
                                                                'purple2' => 'Dark Purple', 
                                                                'red' => 'Red'), old('background_color'), ['class' => 'form-control background_color', 'id' => 'background_color']) !!}
                                {!! Form::errorMsg('background_color') !!}
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
                            {!! Form::label('end_time', '-', array('class' => 'col-sm-1 control-label')) !!}
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
                    <div class="error-modal"></div>
                    <form class="form-horizontal" id="form-event-category">
                        <input type="hidden" name="id" class="form-control" id="category_id">
                        <div class="form-group">
                            {!! Form::label('additional_info', trans('general.price_info'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('additional_info', old('additional_info'), ['class' => 'form-control', 'rows'=> '5', 'placeholder' => trans('general.price_info')]) !!}
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
    
    <div class="modal fade" id="modal-form-promotion" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalLabel"><span id="title-create-promotion" style="display:none">{{ trans('general.add_promotion') }}</span><span id="title-update-promotion" style="display:none">{{ trans('general.edit') }}</span></h4>
                </div>
                <div class="modal-body">
                    <div class="error-modal"></div>
                    <form id="form-event-promotion">
                        <input type="hidden" name="id" class="form-control" id="promotion_id">
                            <div class="form-group{{ Form::hasError('title_promo') }} title_promo">
                                {!! Form::label('title_promo', trans('general.title').' *') !!}
                                {!! Form::text('title_promo', old('title_promo'), ['id' => 'title_promo', 'class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.title')]) !!}
                                {!! Form::errorMsg('title_promo') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description_promo') }} description_promo">
                                {!! Form::label('description_promo', trans('general.description').' *') !!}
                                {!! Form::textarea('description_promo', old('description_promo'), ['id' => 'description_promo', 'class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('general.description')]) !!}
                                {!! Form::errorMsg('description_promo') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('discount') }} discount full-width">
                                {!! Form::label('discount', trans('general.discount').' *', array('class' => 'full-width ')) !!}
                                <div class="col-sm-3 input-group" style="padding:0;">
                                    {!! Form::text('discount', old('discount'), ['id' => 'discount', 'class' => 'form-control number-only','maxlength'=>'255', 'placeholder' => trans('general.discount')]) !!}
                                    <div class="input-group-addon">%</div>
                                </div>
                                {!! Form::errorMsg('discount') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('discount_period') }} discount_period full-width">
                                {!! Form::label('discount_period', trans('general.discount_period').' *', array('class' => 'full-width ')) !!}
                                <div class="col-sm-3 row form-group{{ Form::hasError('start_date') }} start_date">
                                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control  datepicker', 'id' => 'start_date', 'maxlength'=>'255', 'placeholder' => trans('general.start_date')]) !!}
                                    {!! Form::errorMsg('start_date') !!}
                                </div>
                                {!! Form::label('to', trans('general.to'), array('class' => 'col-sm-1 control-label')) !!}
                                <div class="col-sm-3 row form-group{{ Form::hasError('end_date') }} end_date">
                                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control  datepicker', 'id' => 'end_date','maxlength'=>'255', 'placeholder' => trans('general.end_date')]) !!}
                                    {!! Form::errorMsg('end_date') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('promotion_code') }} promotion_code full-width">
                                {!! Form::label('promotion_code', trans('general.promotion_code').' *', array('class' => 'full-width ')) !!}
                                <div class="col-sm-4 row">
                                    {!! Form::text('promotion_code', old('promotion_code'), ['id' => 'promotion_code', 'class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.promotion_code')]) !!}
                                    {!! Form::errorMsg('promotion_code') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image') }} featured_image">
                                {!! Form::label('featured_image', trans('general.featured_image').'(50px x 30px) *') !!}
                                <input id="featured_image" name="featured_image" class="form-control image" data-name="image" type="file" value="">
                                {!! Form::errorMsg('featured_image') !!}
                            </div>
                            <div class="form-group privew" id="div-preview_image" data-name="image" style="display:none">
                                <img src="" name="preview" id="preview_image" height="20%" width="20%">
                            </div>
                            <div class="form-group{{ Form::hasError('category') }} category">
                                {!! Form::label('category', trans('general.category')) !!}
                                {!! Form::select('category', array('discounts' => 'Discounts',
                                                                'lucky-draws' => 'Lucky Draws', 
                                                                'early-bird' => 'Early Bird'), old('category'), ['class' => 'form-control category', 'id' => 'category']) !!}
                                {!! Form::errorMsg('category') !!}
                            </div>
                    </form>
                </div>
            <div class="modal-footer">
                <button type="button" id="button_save_promotion" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
                <button type="button" id="button_update_promotion" class="btn btn-primary" title="{{ trans('general.button_update') }}">{{ trans('general.button_update') }}</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-form-cat" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ModalLabel"><span id="title-create-cat" style="display:none">{{ trans('general.create_new') }}</span></h4>
          </div>
          <div class="modal-body">
            <div class="error-modal-cat"></div>
            <form id="form-cat">
                <input type="hidden" name="id" class="form-control" id="id-cat">
                <div class="form-group name">
                    <label for="event" class="control-label">{{ trans('general.name') }} :</label>
                    {!! Form::text('name-cat', old('name'), array('id' => 'name-cat', 'class' => 'form-control')) !!}
                </div>
                <div class="form-group icon">
                    <label for="event" class="control-label">{{ trans('general.icon') }} :</label>
                    <select name="icon-cat" id="icon-cat" class="form-control selectpicker">
                        <optgroup label="Web Application Icons">
                            <option value="adjust" data-icon="fa fa-adjust">icon-adjust</option>
                            <option value="asterisk" data-icon="fa fa-asterisk">icon-asterisk</option>
                            <option value="ban" data-icon="fa fa-ban">icon-ban</option>
                            <option value="bar-chart" data-icon="fa fa-bar-chart">icon-bar-chart</option>
                            <option value="barcode" data-icon="fa fa-barcode">icon-barcode</option>
                            <option value="beer" data-icon="fa fa-beer">icon-beer</option>
                            <option value="bell" data-icon="fa fa-bell">icon-bell</option>
                            <option value="bell-o" data-icon="fa fa-bell-o">icon-bell-o</option>
                            <option value="birthday-cake" data-icon="fa fa-birthday-cake">icon-birthday-cake</option>
                            <option value="bolt" data-icon="fa fa-bolt">icon-bolt</option>
                            <option value="book" data-icon="fa fa-book">icon-book</option>
                            <option value="bookmark" data-icon="fa fa-bookmark">icon-bookmark</option>
                            <option value="bookmark-o" data-icon="fa fa-bookmark-o">icon-bookmark-o</option>
                            <option value="briefcase" data-icon="fa fa-briefcase">icon-briefcase</option>
                            <option value="bullhorn" data-icon="fa fa-bullhorn">icon-bullhorn</option>
                            <option value="calendar" data-icon="fa fa-calendar">icon-calendar</option>
                            <option value="camera" data-icon="fa fa-camera">icon-camera</option>
                            <option value="camera-retro" data-icon="fa fa-camera-retro">icon-camera-retro</option>
                            <option value="certificate" data-icon="fa fa-certificate">icon-certificate</option>
                            <option value="check" data-icon="fa fa-check">icon-check</option>
                            <option value="check-circle" data-icon="fa fa-check-circle">icon-check-circle</option>
                            <option value="child" data-icon="fa fa-child">icon-child</option>
                            <option value="circle" data-icon="fa fa-circle">icon-circle</option>
                            <option value="circle-o" data-icon="fa fa-circle-o">icon-circle-o</option>
                            <option value="cloud" data-icon="fa fa-cloud">icon-cloud</option>
                            <option value="cloud-download" data-icon="fa fa-cloud-download">icon-cloud-download</option>
                            <option value="cloud-upload" data-icon="fa fa-cloud-upload">icon-cloud-upload</option>
                            <option value="coffee" data-icon="fa fa-coffee">icon-coffee</option>
                            <option value="cog" data-icon="fa fa-cog">icon-cog</option>
                            <option value="cogs" data-icon="fa fa-cogs">icon-cogs</option>
                            <option value="comment" data-icon="fa fa-comment">icon-comment</option>
                            <option value="comment-o" data-icon="fa fa-comment-o">icon-comment-o</option>
                            <option value="comments" data-icon="fa fa-comments">icon-comments</option>
                            <option value="comments-o" data-icon="fa fa-comments-o">icon-comments-o</option>
                            <option value="credit-card" data-icon="fa fa-credit-card">icon-credit-card</option>
                            <option value="cutlery" data-icon="fa fa-cutlery">icon-cutlery</option>
                            <option value="dashboard" data-icon="fa fa-dashboard">icon-dashboard</option>
                            <option value="desktop" data-icon="fa fa-desktop">icon-desktop</option>
                            <option value="download" data-icon="fa fa-download">icon-download</option>
                            <option value="edit" data-icon="fa fa-edit">icon-edit</option>
                            <option value="envelope" data-icon="fa fa-envelope">icon-envelope</option>
                            <option value="envelope-o" data-icon="fa fa-envelope-o">icon-envelope-o</option>
                            <option value="exchange" data-icon="fa fa-exchange">icon-exchange</option>
                            <option value="exclamation" data-icon="fa fa-exclamation">icon-exclamation</option>
                            <option value="external-link" data-icon="fa fa-external-link">icon-external-link</option>
                            <option value="eye" data-icon="fa fa-eye">icon-eye</option>
                            <option value="eye-slash" data-icon="fa fa-eye-slash">icon-eye-slash</option>
                            <option value="fighter-jet" data-icon="fa fa-fighter-jet">icon-fighter-jet</option>
                            <option value="film" data-icon="fa fa-film">icon-film</option>
                            <option value="filter" data-icon="fa fa-filter">icon-filter</option>
                            <option value="fire" data-icon="fa fa-fire">icon-fire</option>
                            <option value="flag" data-icon="fa fa-flag">icon-flag</option>
                            <option value="folder" data-icon="fa fa-folder">icon-folder</option>
                            <option value="folder-o" data-icon="fa fa-folder-o">icon-folder-o</option>
                            <option value="folder-open" data-icon="fa fa-folder-open">icon-folder-open</option>
                            <option value="folder-open-o" data-icon="fa fa-folder-open-o">icon-folder-open-o</option>
                            <option value="gift" data-icon="fa fa-gift">icon-gift</option>
                            <option value="glass" data-icon="fa fa-glass">icon-glass</option>
                            <option value="globe" data-icon="fa fa-globe">icon-globe</option>
                            <option value="group" data-icon="fa fa-group">icon-group</option>
                            <option value="hdd-o" data-icon="fa fa-hdd-o">icon-hdd-o</option>
                            <option value="headphones" data-icon="fa fa-headphones">icon-headphones</option>
                            <option value="heart" data-icon="fa fa-heart">icon-heart</option>
                            <option value="heart-o" data-icon="fa fa-heart-o">icon-heart-o</option>
                            <option value="home" data-icon="fa fa-home">icon-home</option>
                            <option value="inbox" data-icon="fa fa-inbox">icon-inbox</option>
                            <option value="info" data-icon="fa fa-info">icon-info</option>
                            <option value="key" data-icon="fa fa-key">icon-key</option>
                            <option value="leaf" data-icon="fa fa-leaf">icon-leaf</option>
                            <option value="laptop" data-icon="fa fa-laptop">icon-laptop</option>
                            <option value="legal" data-icon="fa fa-legal">icon-legal</option>
                            <option value="lemon-o" data-icon="fa fa-lemon-o">icon-lemon-o</option>
                            <option value="lightbulb-o" data-icon="fa fa-lightbulb-o">icon-lightbulb-o</option>
                            <option value="lock" data-icon="fa fa-lock">icon-lock</option>
                            <option value="unlock" data-icon="fa fa-unlock">icon-unlock</option>
                            <option value="magic" data-icon="fa fa-magic">icon-magic</option>
                            <option value="magnet" data-icon="fa fa-magnet">icon-magnet</option>
                            <option value="map-marker" data-icon="fa fa-map-marker">icon-map-marker</option>
                            <option value="microphone" data-icon="fa fa-microphone">icon-microphone</option>
                            <option value="microphone-slash" data-icon="fa fa-microphone-slash">icon-microphone-slash</option>
                            <option value="minus" data-icon="fa fa-minus">icon-minus</option>
                            <option value="minus-circle" data-icon="fa fa-minus-circle">icon-minus-circle</option>
                            <option value="mobile-phone" data-icon="fa fa-mobile-phone">icon-mobile-phone</option>
                            <option value="money" data-icon="fa fa-money">icon-money</option>
                            <option value="music" data-icon="fa fa-music">icon-music</option>
                            <option value="pencil" data-icon="fa fa-pencil">icon-pencil</option>
                            <option value="photo " data-icon="fa fa-photo ">icon-photo </option>
                            <option value="plane" data-icon="fa fa-plane">icon-plane</option>
                            <option value="plus" data-icon="fa fa-plus">icon-plus</option>
                            <option value="plus-circle" data-icon="fa fa-plus-circle">icon-plus-circle</option>
                            <option value="print" data-icon="fa fa-print">icon-print</option>
                            <option value="puzzle-piece" data-icon="fa fa-puzzle-piece">icon-puzzle-piece</option>
                            <option value="qrcode" data-icon="fa fa-qrcode">icon-qrcode</option>
                            <option value="question" data-icon="fa fa-question">icon-question</option>
                            <option value="quote-left" data-icon="fa fa-quote-left">icon-quote-left</option>
                            <option value="quote-right" data-icon="fa fa-quote-right">icon-quote-right</option>
                            <option value="random" data-icon="fa fa-random">icon-random</option>
                            <option value="refresh" data-icon="fa fa-refresh">icon-refresh</option>
                            <option value="remove" data-icon="fa fa-remove">icon-remove</option>
                            <option value="reorder" data-icon="fa fa-reorder">icon-reorder</option>
                            <option value="reply" data-icon="fa fa-reply">icon-reply</option>
                            <option value="retweet" data-icon="fa fa-retweet">icon-retweet</option>
                            <option value="road" data-icon="fa fa-road">icon-road</option>
                            <option value="rss" data-icon="fa fa-rss">icon-rss</option>
                            <option value="search" data-icon="fa fa-search">icon-search</option>
                            <option value="share" data-icon="fa fa-share">icon-share</option>
                            <option value="share-alt" data-icon="fa fa-share-alt">icon-share-alt</option>
                            <option value="shopping-cart" data-icon="fa fa-shopping-cart">icon-shopping-cart</option>
                            <option value="signal" data-icon="fa fa-signal">icon-signal</option>
                            <option value="sign-in" data-icon="fa fa-sign-in">icon-sign-in</option>
                            <option value="sign-out" data-icon="fa fa-sign-out">icon-sign-out</option>
                            <option value="sitemap" data-icon="fa fa-sitemap">icon-sitemap</option>
                            <option value="smile-o" data-icon="fa fa-smile-o">icon-smile-o</option>
                            <option value="sort" data-icon="fa fa-sort">icon-sort</option>
                            <option value="sort-down" data-icon="fa fa-sort-down">icon-sort-down</option>
                            <option value="sort-up" data-icon="fa fa-sort-up">icon-sort-up</option>
                            <option value="spinner" data-icon="fa fa-spinner">icon-spinner</option>
                            <option value="star" data-icon="fa fa-star">icon-star</option>
                            <option value="star-o" data-icon="fa fa-star-o">icon-star-o</option>
                            <option value="star-half" data-icon="fa fa-star-half">icon-star-half</option>
                            <option value="suitcase" data-icon="fa fa-suitcase">icon-suitcase</option>
                            <option value="tablet" data-icon="fa fa-tablet">icon-tablet</option>
                            <option value="tag" data-icon="fa fa-tag">icon-tag</option>
                            <option value="tags" data-icon="fa fa-tags">icon-tags</option>
                            <option value="tasks" data-icon="fa fa-tasks">icon-tasks</option>
                            <option value="thumbs-down" data-icon="fa fa-thumbs-down">icon-thumbs-down</option>
                            <option value="thumbs-up" data-icon="fa fa-thumbs-up">icon-thumbs-up</option>
                            <option value="times" data-icon="fa fa-times">icon-times</option>
                            <option value="tint" data-icon="fa fa-tint">icon-tint</option>
                            <option value="trash" data-icon="fa fa-trash">icon-trash</option>
                            <option value="trophy" data-icon="fa fa-trophy">icon-trophy</option>
                            <option value="truck" data-icon="fa fa-truck">icon-truck</option>
                            <option value="umbrella" data-icon="fa fa-umbrella">icon-umbrella</option>
                            <option value="upload" data-icon="fa fa-upload">icon-upload</option>
                            <option value="user" data-icon="fa fa-user">icon-user</option>
                            <option value="users" data-icon="fa fa-users">icon-users</option>
                            <option value="volume-off" data-icon="fa fa-volume-off">icon-volume-off</option>
                            <option value="volume-down" data-icon="fa fa-volume-down">icon-volume-down</option>
                            <option value="volume-up" data-icon="fa fa-volume-up">icon-volume-up</option>
                            <option value="warning" data-icon="fa fa-warning">icon-warning</option>
                            <option value="wrench" data-icon="fa fa-wrench">icon-wrench</option>
                        <optgroup label="Video Player Icons">
                            <option value="play-circle" data-icon="fa fa-play-circle">icon-play-circle</option>
                            <option value="play" data-icon="fa fa-play">icon-play</option>
                            <option value="pause" data-icon="fa fa-pause">icon-pause</option>
                            <option value="stop" data-icon="fa fa-stop">icon-stop</option>
                            <option value="step-backward" data-icon="fa fa-step-backward">icon-step-backward</option>
                            <option value="fast-backward" data-icon="fa fa-fast-backward">icon-fast-backward</option>
                            <option value="backward" data-icon="fa fa-backward">icon-backward</option>
                            <option value="forward" data-icon="fa fa-forward">icon-forward</option>
                            <option value="fast-forward" data-icon="fa fa-fast-forward">icon-fast-forward</option>
                            <option value="step-forward" data-icon="fa fa-step-forward">icon-step-forward</option>
                            <option value="eject" data-icon="fa fa-eject">icon-eject</option>
                            <option value="youtube-play" data-icon="fa fa-youtube-play">icon-youtube-play</option>
                        <optgroup label="Social Icons">
                            <option value="facebook" data-icon="fa fa-facebook">icon-facebook</option>
                            <option value="facebook-official" data-icon="fa fa-facebook-official">icon-facebook-official</option>
                            <option value="github" data-icon="fa fa-github">icon-github</option>
                            <option value="github-square" data-icon="fa fa-github-square">icon-github-square</option>
                            <option value="google-plus" data-icon="fa fa-google-plus">icon-google-plus</option>
                            <option value="google-plus-square" data-icon="fa fa-google-plus-square">icon-google-plus-square</option>
                            <option value="linkedin" data-icon="fa fa-linkedin">icon-linkedin</option>
                            <option value="linkedin-square" data-icon="fa fa-linkedin-square">icon-linkedin-square</option>
                            <option value="phone" data-icon="fa fa-phone">icon-phone</option>
                            <option value="phone-square" data-icon="fa fa-phone-square">icon-phone-square</option>
                            <option value="pinterest" data-icon="fa fa-pinterest">icon-pinterest</option>
                            <option value="pinterest-p" data-icon="fa fa-pinterest-p">icon-pinterest-p</option>
                            <option value="twitter" data-icon="fa fa-twitter">icon-twitter</option>
                            <option value="twitter-square" data-icon="fa fa-twitter-square">icon-twitter-square</option>
                    </select>
                </div>
                <div class="form-group description">
                    <label for="event" class="control-label">{{ trans('general.description') }} :</label>
                    {!! Form::textarea('description-cat', old('description'), array('id' => 'description-cat', 'class' => 'form-control tinymce')) !!}
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="button_save-cat" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
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
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;
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
                    <p>{{ trans('general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;
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
                    <p>{{ trans('general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-promotion" href="#" class="continue-delete btn btn-default" data-dismiss="modal">Continue</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.event.script.create_script')