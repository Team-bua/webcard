<?php

namespace App\Exports;

use App\Models\CardBill;
use App\Models\UserBill;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class RechargeBillExport implements FromCollection,WithHeadings,ShouldAutoSize,WithHeadingRow,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */    
    protected $date;
    
    function __construct($date) {
        $this->date = $date;
    }
    
    public function collection()
    {   
        $recharge_bill = UserBill::join('users', 'user_point_bills.user_id', '=', 'users.id')
                            ->when(($this->date != null && isset(explode(' đến ',$this->date)[1]) == true), function ($query){
                                $query->where(function ($q){
                                    $q->whereRaw('DATE(user_point_bills.created_at) BETWEEN "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' đến ', $this->date)[0]))).'" 
                                    AND "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' đến ',$this->date)[1]))).'"');
                                });
                            })
                            ->when(($this->date != null && isset(explode(' đến ',$this->date)[1]) == false), function ($query){
                                $query->whereDate('user_point_bills.created_at', '=', date('Y-m-d', strtotime(str_replace('/', '-',$this->date))));
                            })
                            ->select('users.name', 'user_point_bills.order_id', 'user_point_bills.point_purchase', 'user_point_bills.description', 'user_point_bills.status',
                                   DB::raw("DATE_FORMAT(user_point_bills.created_at, '%H:%i %d-%m-%Y') as created"))
                            ->get();
        
        foreach($recharge_bill as $bill){
            if($bill->status == 0){
                $bill->status = 'Chưa thanh toán';
            }else{
                $bill->status = 'Đã thanh toán';
            }
            $bill->point_purchase = '+ '.number_format($bill->point_purchase).' VNĐ';
        }
        return $recharge_bill;
    }
    
    public function headings():array 
    {
        
        return ['Khách hàng', 'Mã đơn hàng', 'Số tiền', 'Nội dung', 'Trạng thái', 'Ngày'];
        
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1  => ['font' => ['bold' => true]],
            
        ];
    }
}
