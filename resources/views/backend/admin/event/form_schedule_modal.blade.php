<div class="modal fade" id="modal-form-schedule" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalLabel"><span id="title-create-schedule" style="display:none">{{ trans('backend/general.add_schedule_and_price') }}</span><span id="title-update-schedule" style="display:none">{{ trans('backend/general.edit') }}</span></h4>
            </div>
            <div class="modal-body">
                <div class="error-modal"></div>
                <form class="form-horizontal" id="form-event-schedule">
                    <input type="hidden" name="id" class="form-control" id="schedule_id">
                    <div class="form-group date_at">
                        {!! Form::label('date_at', trans('backend/general.date').' *', array('class' => 'col-sm-3 control-label pull-left')) !!}
                        <div class="col-sm-4">
                            <input type="text" name="date_at" class="form-control datepicker" id="date_at" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group start_time">
                        {!! Form::label('start_time', trans('backend/general.start_time').' *', array('class' => 'col-sm-3 control-label')) !!}
                        <div class="col-sm-3">
                            <input type="text" name="start_time" class="form-control timepicker" id="start_time" maxlength="255" placeholder = {{trans('backend/general.start_time')}}>
                        </div>
                        {!! Form::label('end_time', '-', array('class' => 'col-sm-1 control-label')) !!}
                        <div class="col-sm-3">
                            <input type="text" name="end_time" class="form-control timepicker" id="end_time" maxlength="255" placeholder = {{trans('backend/general.end_time')}}>
                        </div>
                    </div>
                    <div class="form-group description_schedule">
                        {!! Form::label('description_schedule', trans('backend/general.description'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                        <div class="col-sm-9">
                            <input type="text" name="description_schedule" class="form-control" id="description_schedule" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group{{ Form::hasError('price_detail') }} price_detail">
                        {!! Form::label('price_detail', trans('backend/general.price_detail'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                    </div>
                    <table id="event-schedule-category-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                        <thead>
                            <tr>
                                <th width="15%" class="center-align"></th>
                                <th width="35%" class="center-align">{{ trans('backend/general.price_name') }}</th>
                                <th width="15%">{{ trans('backend/general.price') }}</th>
                                <th width="15%">{{ trans('backend/general.seat_color') }}</th>
                                <th width="15%">{{ trans('backend/general.sort_order') }}</th>
                            </tr>
                        </thead>
                    </table>
                    <a class="actAddCategory add-underline" href="javascript:void(0)" title="{{ trans('backend/general.add_schedule_category') }}"><u>+ {{ trans('backend/general.add_schedule_category') }}</u></a>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="button_save_schedule" class="btn btn-primary" title="{{ trans('backend/general.button_save') }}">{{ trans('backend/general.button_save') }}</button>
                <button type="button" id="button_update_schedule" class="btn btn-primary" title="{{ trans('backend/general.button_update') }}">{{ trans('backend/general.button_update') }}</button>
            </div>
        </div>
    </div>
</div>