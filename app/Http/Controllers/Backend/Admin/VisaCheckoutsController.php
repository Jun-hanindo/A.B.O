<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\VisaCheckout;
use App\Models\LogActivity;
use App\Models\Trail;
use App\Http\Controllers\Backend\Admin\BaseController;
use App\Http\Requests\Backend\admin\visa_checkout\VisaCheckoutRequest;

class VisaCheckoutsController extends BaseController
{

    public function __construct(VisaCheckout $model)
    {
        parent::__construct($model);

    }
    
    /**
     * Show venue page
     * @return Response
     */
    public function index()
    {
        $trail['desc'] = 'List Visa Checkout';
        $insertTrail = new Trail();
        $insertTrail->insertNewTrail($trail);
        return view('backend.admin.visa_checkout.index');
    }

    /**
     * Show list for visa checkout
     * 
     * @return Response
     */
    public function datatables()
    {
        return datatables($this->model->datatables())
            ->addColumn('sort_order', function ($visa_checkout) {
                $first = $this->model->getFirstSort()->sort_order;
                $last = $this->model->getLastSort()->sort_order;
                $style = 'style="display:inline-block"';
                $style2 = 'style="display:none"';
                if($visa_checkout->sort_order == 0){
                    $sort = '<a href="javascript:void(0)" class="sort_asc btn btn-xs btn-default" '.$style.' data-id="'.$visa_checkout->id.'" data-sort="'.$visa_checkout->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="sort_desc btn btn-xs btn-default" '.$style2.' data-id="'.$visa_checkout->id.'" data-sort="'.$visa_checkout->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';

                }elseif($visa_checkout->sort_order == $first){
                    $sort = '<a href="javascript:void(0)" class="sort_asc btn btn-xs btn-default" '.$style2.' data-id="'.$visa_checkout->id.'" data-sort="'.$visa_checkout->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="sort_desc btn btn-xs btn-default" '.$style.' data-id="'.$visa_checkout->id.'" data-sort="'.$visa_checkout->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';
                }elseif($visa_checkout->sort_order == $last){
                    $sort = '<a href="javascript:void(0)" class="sort_asc btn btn-xs btn-default" '.$style.' data-id="'.$visa_checkout->id.'" data-sort="'.$visa_checkout->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="sort_desc btn btn-xs btn-default" '.$style2.' data-id="'.$visa_checkout->id.'" data-sort="'.$visa_checkout->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';
                }else{
                    $sort = '<a href="javascript:void(0)" class="sort_asc btn btn-xs btn-default" '.$style.' data-id="'.$visa_checkout->id.'" data-sort="'.$visa_checkout->sort_order.'"><i class="fa fa-long-arrow-up fa-fw"></i></a>&nbsp;
                            <a href="javascript:void(0)" class="sort_desc btn btn-xs btn-default" '.$style.' data-id="'.$visa_checkout->id.'" data-sort="'.$visa_checkout->sort_order.'"><i class="fa fa-long-arrow-down fa-fw"></i></a>';
                }
                return $sort;
            })
            ->editColumn('banner_image', function ($visa_checkout) {
                $img_src = file_url('visa_checkouts/'.$visa_checkout->banner_image, env('FILESYSTEM_DEFAULT'));
                $img = '<img src="'.$img_src.'" width="50%" height="50%">';
                return $img;
            })
            ->editColumn('availability_homepage', function ($visa_checkout) {
                if($visa_checkout->availability_homepage == TRUE){
                    $checked = 'checked';
                }else{
                    $checked = '';
                }
                return '<input type="checkbox" name="availability_homepage['.$visa_checkout->id.']" class="availability_homepage-check" data-id="'.$visa_checkout->id.'" '.$checked.'>';
            })
            ->addColumn('action', function ($visa_checkout) {
                $url = route('admin-edit-visa-checkout',$visa_checkout->id);
                return '<a href="'.$url.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;
                    <a href="#" class="btn btn-danger btn-xs actDelete" title="Delete" data-id="'.$visa_checkout->id.'" data-name="'.$visa_checkout->title.'" data-button="delete"><i class="fa fa-trash-o fa-fw"></i></a>';
            })
            ->make(true);
    }

    /**
     * Show the form for create new visa checkout.
     * paths url    : admin/visa-checkout/create 
     * methode      : GET
     * @return Response
     */
    public function create()
    {
        try{
            
            $trail['desc'] = 'Visa Checkout Form';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
        
        }

        return view('backend.admin.visa_checkout.create');
    }

    /**
     * Save data visa checkout.
     * path url     : admin/visa-checkout/store
     * methode      : POST
     * @return Response
     */
    public function store(VisaCheckoutRequest $req)
    {
        
        try{
            $param = $req->all();
            $saveData = $this->model->insertNewVisaCheckout($param);
        
            flash()->success($saveData->title.' '.trans('general.save_success'));

            $log['description'] = 'Visa Checkout "'.$saveData->title.'" was created';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-visa-checkout');
        } catch (\Exception $e) {
            flash()->error(trans('general.save_error'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-create-visa-checkout')->withInput();
        
        }
    }

    /**
     * Show form for edit visa checkout.
     * paths url    : admin/visa-checkout/{id}/edit 
     * methode      : GET
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        
        try{
            $data = $this->model->findVisaCheckoutByID($id);
            
            $trail['desc'] = 'Visa Checkout Form';
            $insertTrail = new Trail();
            $insertTrail->insertNewTrail($trail);

            return view('backend.admin.visa_checkout.edit')->withData($data);

        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);
            
            return redirect()->route('admin-index-visa-checkout');

        }
    }

    /**
     * Update data visa checkout.
     * path url     : admin/visa-checkout/{id}/update
     * methode      : POST
     * @return Response
     */
    public function update(VisaCheckoutRequest $req, $id)
    {

        try{
            $param = $req->all();
            $updateData = $this->model->updateVisaCheckout($param,$id);

            flash()->success($updateData->title.' '.trans('general.update_success'));

            $log['description'] = 'Visa Checkout "'.$updateData->title.'" was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-visa-checkout');

        } catch (\Exception $e) {
            flash()->error(trans('general.update_error'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-edit-visa-checkout', $id)->withInput();

        }
    }

    /**
     * Delete data visa checkout.
     * paths url    : admin/visa-checkout/{id} 
     * methode      : DELETE
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try{
            $data = $this->model->deleteByID($id);
            flash()->success(trans('general.delete_success'));

            $log['description'] = 'Visa Checkout "'.$data->title.'" was deleted';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-visa-checkout');

        } catch (\Exception $e) {

            flash()->error(trans('general.data_not_found'));

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return redirect()->route('admin-index-visa-checkout');

        }
    }

    public function deleteImage($id, Request $req)
    {

        try{
            $param = $req->all();
            $data = $this->model->deleteImage($param, $id);
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'message' => trans('general.delete_image_success')
                ],200);

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => trans('general.data_not_found')
            ],400);

        }

    }

    public function availabilityHomepageUpdate(Request $req, $id)
    {

        try{
            $param = $req->all();
            $updateData = $this->model->changeAvailabilityHomepage($param, $id);
            $log['description'] = 'Visa checkout "'.$updateData->title.'" availability was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => '<strong>'.$updateData->title.'</strong> '.trans('general.update_success')
            ],200);

        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.update_error')
            ],400);

        }
    }

    /**
     * Update sort order data homepage by category
     * @param  Request $req id for homepage id, sort order for sort order of data
     * @return Response
     */
    public function updateSortOrder(Request $req)
    {

        try{
            $param = $req->all();
            $updateData = $this->model->updateCurrentSortOrder($param);

            $log['description'] = 'VisaCheckout Sort Order was updated';
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Sort Order '.trans('general.update_success')
            ],200);
        
        } catch (\Exception $e) {

            $log['description'] = $e->getMessage().' '.$e->getFile().' on line:'.$e->getLine();
            $insertLog = new LogActivity();
            $insertLog->insertNewLogActivity($log);

            return response()->json([
                'code' => 400,
                'status' => 'success',
                'message' => trans('general.save_error')
            ],400);
        
        }
    }
}
