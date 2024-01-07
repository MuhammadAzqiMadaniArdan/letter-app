<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Letter_type;
use App\Models\User;
use App\Models\Result;


use Illuminate\Http\Request;
use App\Exports\LetterExport;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use illuminate\Support\Arr;

use Excel;
use PDF;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //proses ambil data
        // $id = Letter::with('letter__id')->get();
        $letters = Letter::orderBy('id','ASC')->simplePaginate(5);
        // $letters = Letter::all();
        $letter_types = Letter_type::get();
        $users = User::get();
        // $letter_ = Letter_::all();
        // $letter_ = Letter_::OrderBy('name_')->where('id',$id)->first();

        // mannggil html yang ada di folder resources/views/letter.index.blade.php
        //compact : mengirim data ke blade 
        return view('letters.suratMasuk.index', compact('letters','letter_types','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $letters = Letter_type::all();

        $gurus = User::where('role', 'guru')->orderBy('name', 'ASC')->simplePaginate(5);
        $letter = Letter::where('id',$id)->first();
        // $gurus = User::where('role', 'guru')->orderBy('name', 'ASC')->simplePaginate(5);
        // $gurus = Letter::orderBy('recipients', 'ASC')->get();
        $recipients = $letter->recipients; // Ambil data penerima dari surat

        return view('letters.suratMasuk.create',compact('letters','gurus','letter','recipients'));
    }
    public function data(){
        $letters = Letter_type::with('letter')->simplePaginate(5);
        return view('letters.klasifikasi.index', compact('letters'));
    }
    public function downloadExcel(){
        $file_name = 'Surat.xlsx';
        return Excel::download(new LetterExport,$file_name);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function result_data(Request $request)
    {
        // validasi
        // 'name_input' => 'validasi1/validasi2'
        $request->validate([
            'notes' => 'required',
            'presence_recipients' => 'required',
        ]);

        
        // hasilnya berbentuk : "itemnya" => "jumlah yang sama"
    // menentutak quantity (qty)
    
        // Ambil data dari checkbox yang terpilih
$guruRecipients = User::where('role', 'guru')->get();

// Proses untuk menyimpan data penerima ke dalam array $dataRecipients
$dataRecipients = [];
foreach ($request->presence_recipients as $recipientId) {
    // Cari penerima di antara guru-guru yang ada
    $guru = $guruRecipients->where('id', $recipientId)->first();

    // Jika guru ditemukan, tambahkan ke dalam array $dataRecipients
    if ($guru) {
        $dataRecipients[] = [
            'id' => $guru->id,
            'name_recipients' => $guru->name,
        ];
    }
}
$request['presence_recipients'] = $dataRecipients;

    // Ambil data dari checkbox yang terpilih
     $gurus = User::where('role', 'guru')->orderBy('name', 'ASC')->get();


        // $selectedLetter = Letter::find($request->recipients);
        // $selectedRecipients = $request->input('recipients', []);

        // Simpan informasi penerima ke dalam basis data
        // simpan data ke db : 'nama_column' => $request->name_input
        // Simpan data surat termasuk nama file gambar ke database

        $prosesTambahData = Result::create([
            // 'letter_id' => $selectedLetter->id,
            // 'recipients' => $selectedRecipients,
            'letter_id' => '1',
            'presence_recipients' => json_encode($request->presence_recipients), // Sesuaikan dengan kolom basis data
            'notes' => $request->notes,
        ]);
    // Lakukan sesuatu jika user tidak ditemukan, misalnya beri pesan error atau handling khusus
    // Contoh:
        // foreach ($selectedRecipients as $recipientId) {
        //     // Misalnya, asumsikan kita menyimpan penerima dalam tabel pivot `letter_recipients`
        //     'recipients'->recipients()->attach($recipientId); // Ubah `recipients` sesuai dengan nama relasi yang sesuai
        // }

        // abis simpen, arahin ke halaman mana
        return redirect()->back()->with('success', 'berhasil menambahkan data rapat!');
        // return redirect()->route('letter.rapat',$prosesTambahData['id']);    
    }

    public function rapat($id)
    {
        //
        $letters = Letter::all();
        $letter_types = Letter_type::all();
        $letter = Letter::where('id',$id)->first();
        return view('letters.suratMasuk.rapat',compact('letter','letter_types','letters'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $letter =Letter::find($id);
        // mengembalikan bentuk json dikirim data yang diambil dari response status code 200
        // response status code api :
        // 200 -> success/ok
        // 400 an -> errror kode/validasi input
        // 419 ->error token csrf
        // 500 an -> error server hosting
        return response()->json($letter,200);
    }   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // mengambil data yang belum dimunculkan
        // find: mencari berdasarkan column
        // bisa jkuga : where ('id',$id)->first()
        $letter = Letter::find($id);

        return view('letters.suratMasuk.edit', compact('letter'));
    }
    public function downloadPDF($id)
    {
        //get data yang akan ditampilkan pada pdf
        //data yang dikirim ke PDF wajib array
        // toArray : merubah fungsi dari model apapun menjadi sebuah array
        // first = mengambil data haya satu
        $letter = Letter::where('id',$id)->first()->toArray();

        // ketika data dipanggil di blade pdf,akan dipanggil dengan $apa
        view()->share('letter',$letter);

        // lokasi dan nama blade yang akan didownload ke pdf serta data yang akan ditampilkan 
        $pdf = PDF::loadView('letters.suratMasuk.download',$letter);

        // ketika didownload nama file apa
        return $pdf->download('Bukti Surat.pdf');   
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // validasi
        $request->validate([
            'name' => 'required|min:3',
            'type' => 'required',
            'price' => 'required|numeric',
        ]);
        // cari berdasarkan id terus update
        Letter::where('id',$id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
        ]);
        // redirect ke html letter data
        // route digunakan untuk memindahkan suatu ke page yang lain jika ingin menambahkan notif ke tempat lain bisa di ganti ke letter.tambah atau letter.edit
        return redirect()->route('letter.data')->with('success','Berhasil mengubah data obat!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Letter::where('id',$id)->delete();
        return redirect()->back()->with('deleted','Berhasil menghapus data!');
    }

    public function stockData(){
        $letters = Letter::orderBy('stock','ASC')->simplePaginate(5);
        return view('letters.suratMasuk.stock',compact('letters'));
    }

    public function updateStock(Request $request, $id){
        $request->validate([
            'stock' => 'required|numeric',
        ],[
            "stock_required" => "Input stock harus diisi!",
        ]);

        $letterBefore = Letter::where('id',$id)->first();
        if ($request->stock <= $letterBefore['stock']){
            return response()->json(['message' => 'stock tidak boleh lebih/sama dengan stock sebelumnya serta kurang!'],400);
        }

        // kalau gamasuk ke if
        $letterBefore->update(['stock' => $request->stock]);
        return response()->json('berhasil',200);

    }
    public function result_detail($id)
    {
        // $letters = Letter::all()->first();
        // return view('letters.suratMasuk.letter_list',compact('letters'));
        
        $letter_types = Letter_type::all();
        $letter = Letter::where('id',$id)->first();
        // $gurus = User::where('role', 'guru')->orderBy('name', 'ASC')->simplePaginate(5);
        $gurus = Letter::orderBy('recipients', 'ASC')->get();
        $recipients = $letter->recipients; // Ambil data penerima dari suratMasuk

        return view('letters.suratMasuk.letter_list',compact('letter','letter_types','gurus','recipients'));

        // return view('letters.klasifikasi.letter_list');
    }
}