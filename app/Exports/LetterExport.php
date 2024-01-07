<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\Letter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LetterExport implements FromCollection,WithMapping,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return Letter::with('letter_type')->get();
        // return Letter::all();


    }
    public function headings() : array{
        
        return[
            "Surat","no","nosurat","perihal","Tanggal-Keluar","Penerima","Notulis","HasilRapat"
        ];
    }
    // data dari db yang akan dimunculkan ke excel
    public function map($item) : array{
        $hasil = 'Sukses';
        $no = 1;
        $code=$no + 2.-$no+1;'/000'.$item->letter_type_id;'/SMK WIKRAMA/XII/2023' ;
        return[
            '',
            $item->id,
            $code,
            $item->letter_perihal,
            $item->created_at,
            $item->recipients,
            $item->user->name,
            $hasil

        ];
    }
}   
