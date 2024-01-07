<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\Letter_type;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LetterTypeExport implements FromCollection,WithMapping,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return Letter_type::with('letter')->get();
        // return Letter_type::all();


    }
    public function headings() : array{
        
        return[
            "klasifikasi Surat","no",
            "id","Kode Surat","klasifikasi Surat","Surat Tertaut"
        ];
    }
    // data dari db yang akan dimunculkan ke excel
    public function map($item) : array{
        $tautan = 0;
        $no= 1;
        return[
            '',
            $no++,
            $item->id,
            $item->letter_code,
            $item->name_type,
            $tautan+1

        ];
    }
}   
