<?php

namespace App\Exports;

use App\Models\CardBill;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class CardBillExport implements FromCollection,WithHeadings,ShouldAutoSize,WithHeadingRow,WithStyles
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
        $card_bill = CardBill::join('users', 'card_bills.user_id', '=', 'users.id')
                            ->when(($this->date != null && isset(explode(' đến ',$this->date)[1]) == true), function ($query){
                                $query->where(function ($q){
                                    $q->whereRaw('DATE(card_bills.created_at) BETWEEN "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' đến ', $this->date)[0]))).'" 
                                    AND "'.date('Y-m-d', strtotime(str_replace('/', '-', explode(' đến ',$this->date)[1]))).'"');
                                });
                            })
                            ->when(($this->date != null && isset(explode(' đến ',$this->date)[1]) == false), function ($query){
                                $query->whereDate('card_bills.created_at', '=', date('Y-m-d', strtotime(str_replace('/', '-',$this->date))));
                            })
                            ->select('card_bills.card_type', 'users.name', 'card_bills.order_id', 'card_bills.card_price', 'card_bills.card_total', 'card_bills.price_total', 'card_bills.status',
                                    'card_bills.card_info', 'card_bills.discount_code', 'card_bills.discount_info', DB::raw("DATE_FORMAT(card_bills.created_at, '%H:%i %d-%m-%Y') as created"))
                            ->get();
        foreach($card_bill as $bill){
            if($bill->status == 0){
                $bill->status = 'Chưa thanh toán';
            }else{
                $bill->status = 'Đã thanh toán';
            }
            $bill->price_total = number_format($bill->price_total).' VNĐ';
            $bill->card_info = str_replace(',',"\r\n" , implode(',',json_decode($bill->card_info)));
        }
        return $card_bill;
    }
    
    public function headings():array 
    {
        
        return ['Tên thẻ', 'Khách hàng', 'Mã đơn hàng','Đơn giá', 'Số lượng', 'Tổng tiền', 'Trạng thái', 'Thông tin thẻ', 'Mã giảm giá', 'Khuyến mãi','Ngày'];
        
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1  => ['font' => ['bold' => true]],
            
        ];
    }
}
