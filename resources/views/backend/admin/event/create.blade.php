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
                                {!! Form::label('admission', trans('general.admission')) !!}
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
                            <div class="form-group{{ Form::hasError('video_link') }} video_link">
                                {!! Form::label('video_link', trans('general.video_link').' ('.trans('general.embed').')') !!}
                                {!! Form::text('video_link', old('video_link'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.video_link')]) !!}
                                {!! Form::errorMsg('video_link') !!}
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
                                <button type="button" id="button_draft" class="btn btn-warning " title="{{ trans('general.button_draft') }}">{{ trans('general.button_draft') }}</button>
                                <input class="btn btn-primary" title="{{ trans('general.button_save') }}" type="submit" value="{{ trans('general.button_publish') }}" id="button_submit">
                                <a href="" target="_blank" id="button_preview" class="btn btn-success btn-preview" title="{{ trans('general.button_preview') }}">{{ trans('general.button_preview') }}</a>
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
                                {!! Form::text('additional_info', old('additional_info'), ['class' => 'form-control', 'rows'=> '5', 'placeholder' => trans('general.price_info')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', trans('general.price'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                            <div class="col-sm-9 input-group currency-value">
                                {!! Form::select('currency_id', $data['currencies'], $data['currency_sel'], array('data-default' => $data['currency_sel'], 'id' => 'currency_id', 'class' => 'form-control','data-option' => old('currency_id'))) !!}
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


                            <div class="form-group{{ Form::hasError('discount') }} discount {{ Form::hasError('discount_nominal') }} discount_nominal full-width">
                                {!! Form::label('discount', trans('general.discount').' *', array('class' => 'full-width ')) !!}
                                {!! Form::checkbox('discount_type', '1', null, ['class' => 'form-control pull-left discount_type-check', 'data-animate' => 'false', 'data-on-text' => 'Percent',  'data-off-color' => 'success', 'data-off-text' => 'Nominal']) !!}
                                <div id="discount-percent" class="pull-left col-sm-3">
                                    <div class="input-group ">
                                        {!! Form::text('discount', old('discount'), ['id' => 'discount', 'class' => 'form-control number-only percent','maxlength'=>'255', 'placeholder' => trans('general.discount')]) !!}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                    {!! Form::errorMsg('discount') !!}
                                </div>
                                <div id="discount-nominal" class="pull-left col-sm-4" style="display:none">
                                    <div class="input-group currency-value">
                                        {!! Form::select('currency_id', $data['currencies'], $data['currency_sel'], array('data-default' => $data['currency_sel'], 'id' => 'currency_id', 'class' => 'form-control','data-option' => old('currency_id'))) !!}
                                        {!! Form::text('discount_nominal', old('discount_nominal'), ['data-min' => '','id' => 'discount_nominal', 'class' => 'form-control number-only nominal','maxlength'=>'255', 'placeholder' => trans('general.discount')]) !!}
                                    </div>
                                    {!! Form::errorMsg('discount_nominal') !!}
                                </div>
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
                                {!! Form::label('promotion_code', trans('general.promotion_code'), array('class' => 'full-width ')) !!}
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
                    <select name="icon" id="icon-cat" class="form-control selectpicker" data-live-search="true">
                        @if(!empty($data['icons']))
                            @foreach ($data['icons'] as $icon)
                                <optgroup label="{!! $icon['name'] !!}">
                                    @if (isset($icon['child']))
                                        @foreach($icon['child'] as $child)
                                            <option value="{!! $child['name'] !!}" data-icon="fa fa-{!! $child['name'] !!}">icon-{!! $child['name'] !!}</option>
                                        @endforeach
                                    @endif
                            @endforeach
                        @endif
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