<?php

namespace App\Exports;

use App\Models\CardBill;
use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class LinkExport implements FromCollection,WithHeadings,ShouldAutoSize,WithHeadingRow,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */    
    public function collection()
    {   
        $link = Link::where('status', 0)
                    ->select('type_subject', 'link_subject', 'subject', DB::raw("DATE_FORMAT(created_at, '%H:%i %d-%m-%Y') as created"))
                    ->get();
        
        foreach($link as $li){
            $li->link_subject = route('link.subject', $li->link_subject);
            unset($li->status);
            unset($li->updated_at);
        }
        $link_status = Link::where('status',0)->get();
        foreach($link_status as $links){
            $links->status = 1;
            $links->save();          
        }
        return $link;
    }
    
    public function headings():array 
    {
        
        return ['Loại', 'Link', 'Nội dung','Ngày'];
        
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1  => ['font' => ['bold' => true]],
            
        ];
    }
}
