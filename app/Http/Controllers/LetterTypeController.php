<?php

namespace App\Http\Controllers;

use App\Models\Letter_type;
use App\Models\Letter;
use App\Exports\LetterTypeExport;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Arr;
// use Maatwebsite\Excel\Excel as ExcelExcel;
use PDF;
use Excel;

class LetterTypeController extends Controller
{
    
    public function index()
    {
        //proses ambil data

        // if ($role == 'guru') {
            $letter_types = Letter_type::withCount('letter')->orderBy('name_type', 'ASC')->simplePaginate(5);
            
            // $letter_names = Letter_type::orderBy('name_type');
            // if($letter_types['name_type' == 'Rapat Rutin']){
            //     (int)$letter_types['name_type' == 'Rapat Rutin']++;
            // }
                // dd($letter_types);
            return view('letters.klasifikasi.index', compact('letter_types'));
        // $letter_types = Letter_type::orderBy('name','ASC')->simplePaginate(5);
        // mannggil html yang ada di folder resources/views/letter_type.index.blade.php
        //compact : mengirim data ke blade 
    }

    public function dashboard(){
        $letter_types = Letter_type::withCount('letter')->orderBy('name_type', 'ASC')->simplePaginate(5);
        return view('dashboard', compact('letter_types'));

    }
    
    public function data(){
        $letter_types = Letter_type::with('letter')->simplePaginate(5);
        return view('letters.klasifikasi.index', compact('letter_types'));
    }
    public function downloadExcel(){
        $file_name = 'Tipe-Surat.xlsx';
        return Excel::download(new LetterTypeExport,$file_name);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('letters.klasifikasi.create');

    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function letter_type_data(Request $request)
    {
        //
        
        // validasi
        // 'name_input' => 'validasi1/validasi2'

        $request->validate([
            'letter_code' => 'required',
            'name_type' => 'required',
            
        ]);
        
        $letterCount = '-'.Letter_type::count('letter_code');
        // $pw=password_hash('',$request->password);
        // simpan data ke db : 'nama_column' => $request->name_input
        Letter_type::create([
            'letter_code' => $request->letter_code.$letterCount,
            'name_type' => $request->name_type,
        ]);


        // abis simpen, arahin ke halaman mana
        return redirect()->back()->with('success', 'berhasil menambahkan Surat Klasifikasi!');
    
    }
    
    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $letter_type =Letter_type::find($id);
        // mengembalikan bentuk json dikirim data yang diambil dari response status code 200
        // response status code api :
        // 200 -> success/ok
        // 400 an -> errror kode/validasi input
        // 419 ->error token csrf
        // 500 an -> error server hosting
        return response()->json($letter_type,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
         // mengambil data yang belum dimunculkan
        // find: mencari berdasarkan column
        // bisa jkuga : where ('id',$id)->first()
        $letter_type = Letter_type::find($id);

        return view('letters.klasifikasi.edit', compact('letter_type'));
    }
    
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // validasi
        $request->validate([
            'letter_code' => 'required|min:3',
            'name_type' => 'required',
        ]);
        $letterCount = '-'.Letter_type::count('letter_code');

        // cari berdasarkan id terus update
        Letter_type::where('id',$id)->update([
            'letter_code' => $request->letter_code.$letterCount,
            'name_type' => $request->name_type,
        ]);
        // redirect ke html letter_type data
        // route digunakan untuk memindahkan suatu ke page yang lain jika ingin menambahkan notif ke tempat lain bisa di ganti ke medicine.tambah atau medicine.edit
        return redirect()->route('letter_type.index')->with('success','Berhasil mengubah data Klasifikasi Surat!');
    }
    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Letter_type::where('id',$id)->delete();
        return redirect()->back()->with('deleted','Berhasil menghapus data!');
    }

    public function downloadPDF($id)
    {
        //get data yang akan ditampilkan pada pdf
        //data yang dikirim ke PDF wajib array
        // toArray : merubah fungsi dari model apapun menjadi sebuah array
        // first = mengambil data haya satu
        $letter_type = Letter_type::where('id',$id)->first()->toArray();

        // ketika data dipanggil di blade pdf,akan dipanggil dengan $apa
        view()->share('letter_type',$letter_type);

        // lokasi dan nama blade yang akan didownload ke pdf serta data yang akan ditampilkan 
        $pdf = PDF::loadView('letters.surat.download',$letter_type);

                $pdf->setPaper('A3', 'landscape');

        // ketika didownload nama file apa
        return $pdf->download('Bukti Surat.pdf');   
    }

    public function letter_detail($id)
    {
        $letter_type = Letter_type::OrderBy('name_type')->where('id',$id)->first();
        $letters = Letter::all();
        $letter = Letter::where('id',$id+15)->first();
        return view('letters.klasifikasi.letter_list',compact('letter_type','letters','letter'));
        // return view('letters.klasifikasi.letter_list');
    }
}
