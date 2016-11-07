<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class TixtrackOrder extends Model
{
    use SoftDeletes;
    protected $table = 'tixtrack_orders';
    protected $dates = ['deleted_at'];

    /*protected $fillable = [
        'user_id', 'name', 'address', 'mrtdirection', 'cardirection', 'taxidirection', 'capacity', 'link_map', 'gmap_link'
    ];*/
    protected $fillable = [
        'account_id', 'order_id', 'local_created', 'local_last_updated', 'first_name', 'last_name', 'email', 
        'bill_to_address1', 'bill_to_address2', 'bill_to_address3', 'bill_to_city', 'bill_to_state', 'bill_to_postal_code', 
        'bill_to_country_code', 'phone', 'event_id', 'event_name', 'event_date', 'venue', 
        'ip', 'order_status', 'price_table_name', 'user_id', 'seller_email', 'partner', 
        'partner_id', 'total', 'sales_channel', 'item_id', 'order_item_type', 'fee_id', 
        'fee_name', 'section', 'row_section', 'seat_id', 'price_type', 'price', 
        'full_price', 'delivery_method_name', 'payment_method_type', 'payment_method_name', 'provider_id', 'promo_code', 
        'marketing_opt_in1', 'marketing_opt_in2', 'created', 'last_updated', 'promotion_name', 'price_level_name', 
        'ticket_quantity', 'balance', 'product_name', 'product_variant_name'
    ];

    /**
     * Return event's query for Datatables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    

    function datatables()
    {

        return static::select('id', 'order_id', 'first_name', 'last_name', 'event_name', 'price', 
            DB::RAW("CONCAT(first_name, ' ', last_name)  as customer"))
            /*->orderBy('order_id', 'asc')*/;
    
    }

    function datatablesAccount($account_id)
    {

        return static::select('id', 'order_id', 'first_name', 'last_name', 'event_name', 'price', 
            DB::RAW("CONCAT(first_name, ' ', last_name)  as customer"))
            ->where('account_id', $account_id)
            /*->orderBy('order_id', 'asc')*/;
    
    }

    function getLastUpdate(){
        $data = TixtrackOrder::select(DB::raw('DATE(local_created) as local_created'))
            ->orderBy(DB::raw('DATE(local_created)'), 'desc')->first();

        return $data;
    }

    function getLastOrder(){
        $data = TixtrackOrder::select('order_id')
            ->orderBy('order_id', 'desc')->first();

        return $data;
    }

    function getLastOrderAccount($account_id){
        $data = TixtrackOrder::select('order_id')
            ->where('account_id', $account_id)
            ->orderBy('order_id', 'desc')->first();

        return $data;
    }

    public function deleteByAccount($account_id){
        $data = TixtrackOrder::select('order_id')->where('account_id', $account_id)->delete();

        return $data;
    }

    public function truncate(){
        DB::table('tixtrack_orders')->truncate();
    }

    public function findTixtrackOrder($order_id, $section, $row_section, $seat_id, $price_level_name)
    {
        $data = TixtrackOrder::where('order_id', $order_id)
            //->where('order_item_type', 'Ticket')
            ->where('section', $section)
            ->where('row_section', $row_section)
            ->where('seat_id', $seat_id)
            ->where('price_level_name', $price_level_name)->first();
        if (!empty($data)) {
        
            return $data;
        
        } else {
        
            return false;

        }
    }

    public function getGroupEvent($event_id, $group, $start_date, $end_date){
        $datas = TixtrackOrder::where('event_id', $event_id)->groupBy($group)->get();

        if(!empty($datas)){
            return $datas;
        }else{
            return false;
        }
    }

    public function getCategoryEvent($event_id, $start_date, $end_date){
        $categories = TixtrackOrder::select('price_level_name')
            ->where('event_id', $event_id)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->where(DB::raw('DATE(local_created)'), '>=', $start_date)
            ->where(DB::raw('DATE(local_created)'), '<=', $end_date)
            ->groupBy('price_level_name')
            ->orderBy('price_level_name', 'asc')->get();

        if(!empty($categories)){
            return $categories;
        }else{
            return false;
        }
    }

    public function getPaymentEvent($event_id, $start_date, $end_date){
        $payments = TixtrackOrder::select('payment_method_name')
            ->where('event_id', $event_id)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->where(DB::raw('DATE(local_created)'), '>=', $start_date)
            ->where(DB::raw('DATE(local_created)'), '<=', $end_date)
            ->groupBy('payment_method_name')
            ->orderBy('payment_method_name', 'asc')->get();

        if(!empty($payments)){
            return $payments;
        }else{
            return false;
        }
    }

    public function getPromotionEvent($event_id, $start_date, $end_date){
        $promotions = TixtrackOrder::select('promo_code')
            ->where('event_id', $event_id)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->where(DB::raw('DATE(local_created)'), '>=', $start_date)
            ->where(DB::raw('DATE(local_created)'), '<=', $end_date)
            ->where('promo_code', '<>', '')
            ->groupBy('promo_code')
            ->orderBy('promo_code', 'asc')->get();

        if(!empty($promotions)){
            return $promotions;
        }else{
            return false;
        }
    }

    public function getDate($event_id, $start_date, $end_date){
        $dates = TixtrackOrder::select(DB::raw('DATE(local_created) as local_created'), DB::raw('DATE(event_date) as event_date'))
            ->where('event_id', $event_id)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->where(DB::raw('DATE(local_created)'), '>=', $start_date)
            ->where(DB::raw('DATE(local_created)'), '<=', $end_date)
            ->groupBy(DB::raw('DATE(local_created)'), DB::raw('DATE(event_date)'))
            ->orderBy(DB::raw('DATE(local_created)'), 'asc')
            ->orderBy(DB::raw('DATE(event_date)'), 'asc')
            ->get();

        if(!empty($dates)){
            return $dates;
        }else{
            return false;
        }
    }

    public function amountByCategory($event_id, $price_level_name, $date, $event_date){
        $datas = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
            ->where('event_id', $event_id)
            ->where(DB::raw('DATE(local_created)'), '=', $date)
            ->where(DB::raw('DATE(event_date)'), '=', $event_date)
            ->where('price_level_name', $price_level_name)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->first();
        if(!empty($datas)){
            return $datas;
        }else{
            return false;
        }
    }

    public function amountByPayment($event_id, $payment_method_name, $date, $event_date){
        $datas = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
            ->where('event_id', $event_id)
            ->where(DB::raw('DATE(local_created)'), '=', $date)
            ->where(DB::raw('DATE(event_date)'), '=', $event_date)
            ->where('payment_method_name', $payment_method_name)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->first();
        if(!empty($datas)){
            return $datas;
        }else{
            return false;
        }
    }

    public function amountByPromotion($event_id, $promo_code, $date, $event_date){
        $datas = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
            ->where('event_id', $event_id)
            ->where(DB::raw('DATE(local_created)'), '=', $date)
            ->where(DB::raw('DATE(event_date)'), '=', $event_date)
            ->where('promo_code', $promo_code)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->where('promo_code', '<>', '')
            ->first();
        if(!empty($datas)){
            return $datas;
        }else{
            return false;
        }
    }

    public function totalByDate($event_id, $date, $event_date){
        $datas = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
            ->where('event_id', $event_id)
            ->where(DB::raw('DATE(local_created)'), '=', $date)
            ->where(DB::raw('DATE(event_date)'), '=', $event_date)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->first();
        if(!empty($datas)){
            return $datas;
        }else{
            return false;
        }
    }

    public function totalByDatePromotion($event_id, $date, $event_date){
        $datas = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
            ->where('event_id', $event_id)
            ->where(DB::raw('DATE(local_created)'), '=', $date)
            ->where(DB::raw('DATE(event_date)'), '=', $event_date)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->where('promo_code', '<>', '')
            ->first();
        if(!empty($datas)){
            return $datas;
        }else{
            return false;
        }
    }

    public function getCategoryByEvent($event_id, $start_date, $end_date){
        $dates = $this->getDate($event_id, $start_date, $end_date);

        if(!empty($dates)){
            foreach ($dates as $key => $date) {
                $total = $this->totalByDate($event_id, $date->local_created, $date->event_date);
                $date->full_price = $total->full_price;
                $date->price = $total->price;
                $date->ticket_quantity = $total->ticket_quantity;

                $categories = $this->getCategoryEvent($event_id, $start_date, $end_date);
                foreach ($categories as $key => $cat) {
                    $amounts[$cat->price_level_name] = $this->amountByCategory($event_id, $cat->price_level_name, $date->local_created, $date->event_date);
                }
                $date->amounts = (object) $amounts;

                //dd($amounts);
            }
            return $dates;
        }else{
            return false;
        }
    }

    public function getPaymentByEvent($event_id, $start_date, $end_date){
        $dates = $this->getDate($event_id, $start_date, $end_date);

        if(!empty($dates)){
            foreach ($dates as $key => $date) {
                $total = $this->totalByDate($event_id, $date->local_created, $date->event_date);
                $date->full_price = $total->full_price;
                $date->price = $total->price;
                $date->ticket_quantity = $total->ticket_quantity;

                $payments = $this->getPaymentEvent($event_id, $start_date, $end_date);
                foreach ($payments as $key => $pay) {
                    $amounts[$pay->payment_method_name] = $this->amountByPayment($event_id, $pay->payment_method_name, $date->local_created, $date->event_date);
                }
                $date->amounts = (object) $amounts;

                //dd($amounts);
            }
            return $dates;
        }else{
            return false;
        }
    }

    public function totalCategoryEvent($event_id, $start_date, $end_date){
        $categories = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
            ->where('event_id', $event_id)
            ->where(DB::raw('DATE(local_created)'), '>=', $start_date)
            ->where(DB::raw('DATE(local_created)'), '<=', $end_date)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->groupBy('price_level_name')
            ->orderBy('price_level_name', 'asc')->get();

        if(!empty($categories)){
            return $categories;
        }else{
            return false;
        }
    }

    public function totalPaymentEvent($event_id, $start_date, $end_date){
        $payments = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
            ->where('event_id', $event_id)
            ->where(DB::raw('DATE(local_created)'), '>=', $start_date)
            ->where(DB::raw('DATE(local_created)'), '<=', $end_date)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->groupBy('payment_method_name')
            ->orderBy('payment_method_name', 'asc')->get();

        if(!empty($payments)){
            return $payments;
        }else{
            return false;
        }
    }

    public function totalPromotionEvent($event_id, $start_date, $end_date){
        $payments = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
            ->where('event_id', $event_id)
            ->where(DB::raw('DATE(local_created)'), '>=', $start_date)
            ->where(DB::raw('DATE(local_created)'), '<=', $end_date)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->where('promo_code', '<>', '')
            ->groupBy('promo_code')
            ->orderBy('promo_code', 'asc')->get();

        if(!empty($payments)){
            return $payments;
        }else{
            return false;
        }
    }

    public function total($event_id, $start_date, $end_date){
        $categories = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
            ->where('event_id', $event_id)
            ->where(DB::raw('DATE(local_created)'), '>=', $start_date)
            ->where(DB::raw('DATE(local_created)'), '<=', $end_date)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')->first();

        if(!empty($categories)){
            return $categories;
        }else{
            return false;
        }
    }

    public function allTotalPromotion($event_id, $start_date, $end_date){
        $categories = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
            ->where('event_id', $event_id)
            ->where(DB::raw('DATE(local_created)'), '>=', $start_date)
            ->where(DB::raw('DATE(local_created)'), '<=', $end_date)
            ->where('order_item_type', 'Ticket')
            ->where('promo_code', '<>', '')
            ->where('order_status', 'Accepted')->first();

        if(!empty($categories)){
            return $categories;
        }else{
            return false;
        }
    }

    public function getAllCategoryEvent($event_id){
        $categories = TixtrackOrder::select('price_level_name')
            ->where('event_id', $event_id)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->groupBy('price_level_name')
            ->orderBy('price_level_name', 'asc')->get();

        if(!empty($categories)){
            return $categories;
        }else{
            return false;
        }
    }

    public function getAllSale($event_id){
        $dates = TixtrackOrder::select(DB::raw('DATE(event_date) as event_date'))
            ->where('event_id', $event_id)
            ->where('order_item_type', 'Ticket')
            ->where('order_status', 'Accepted')
            ->groupBy(DB::raw('DATE(event_date)'))
            ->orderBy(DB::raw('DATE(event_date)'), 'asc')
            ->get();

        if(!empty($dates)){
            foreach ($dates as $key => $date) {
                $total = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
                    DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
                    ->where('event_id', $event_id)
                    ->where(DB::raw('DATE(event_date)'), '=', $date->event_date)
                    ->where('order_item_type', 'Ticket')
                    ->where('order_status', 'Accepted')
                    ->first();

                if(!empty($total)){
                    $date->full_price = $total->full_price;
                    $date->price = $total->price;
                    $date->ticket_quantity = $total->ticket_quantity;
                }else{
                    $date->full_price = 0;
                    $date->price = 0;
                    $date->ticket_quantity = 0;
                }

                $categories = TixtrackOrder::select('price_level_name')
                    ->where('event_id', $event_id)
                    ->where(DB::raw('DATE(event_date)'), '=', $date->event_date)
                    ->where('order_item_type', 'Ticket')
                    ->where('order_status', 'Accepted')
                    ->groupBy('price_level_name')
                    ->orderBy('price_level_name', 'asc')->get();
                foreach ($categories as $key => $cat) {
                    $amounts[$cat->price_level_name] = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
                            DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
                            ->where('event_id', $event_id)
                            ->where(DB::raw('DATE(event_date)'), '=', $date->event_date)
                            ->where('price_level_name', $cat->price_level_name)
                            ->where('order_item_type', 'Ticket')
                            ->where('order_status', 'Accepted')
                            ->first();
                }
                $date->amounts = (object) $amounts;

                //dd($amounts);
            }
            return $dates;
        }else{
            return false;
        }
    }

    // public function getPromotionByEvent($event_id, $start_date, $end_date){
    //     $dates = $this->getDate($event_id, $start_date, $end_date);

    //     if(!empty($dates)){
    //         foreach ($dates as $key => $date) {
    //             $total = $this->total($event_id, $date->local_created, $date->event_date);
    //             $date->full_price = $total->full_price;
    //             $date->price = $total->price;
    //             $date->ticket_quantity = $total->ticket_quantity;

    //             $promotions = $this->getPromotionEvent($event_id);
    //             foreach ($promotions as $key => $pro) {
    //                 $amounts[$pro->promo_code] = TixtrackOrder::select(DB::raw('sum(full_price) as full_price'), 
    //                     DB::raw('sum(price) as price'), DB::raw('count(ticket_quantity) as ticket_quantity'))
    //                     ->where('event_id', $event_id)
    //                     ->where(DB::raw('DATE(local_created)'), '=', $date->local_created)
    //                     ->where(DB::raw('DATE(event_date)'), '=', $date->event_date)
    //                     ->where('promo_code', $pro->promo_code)
    //                     ->where('order_item_type', 'Ticket')
    //                     ->where('order_status', 'Accepted')
    //                     ->first();
    //             }
    //             $date->amounts = (object) $amounts;

                
    //             foreach ($$date->amounts as $key => $value) {
    //                 dd($value);
    //             }
    //         }
    //         return $dates;
    //     }else{
    //         return false;
    //     }
    // }

}
