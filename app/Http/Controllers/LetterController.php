<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Letter_type;
use App\Models\User;


use Illuminate\Http\Request;
use App\Exports\LetterExport;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use illuminate\Support\Arr;

use Excel;
use PDF;

class LetterController extends Controller
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
        $letter_types = Letter_type::orderBy('id','ASC')->simplePaginate(5);
        $users = User::get();
        // $letter_ = Letter_::all();
        // $letter_ = Letter_::OrderBy('name_')->where('id',$id)->first();

        // mannggil html yang ada di folder resources/views/letter.index.blade.php
        //compact : mengirim data ke blade 
        return view('letters.surat.index', compact('letters','letter_types','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $letters = Letter_type::all();

        $gurus = User::where('role', 'guru')->orderBy('name', 'ASC')->simplePaginate(5);
        return view('letters.surat.create',compact('letters','gurus'));
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
    public function letter_data(Request $request)
    {
        // validasi
        // 'name_input' => 'validasi1/validasi2'
        $request->validate([
            'letter_perihal' => 'required|min:3',
            'name_type' => 'required',
            'content' => 'required',
            'recipients' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            // Validasi untuk gambar
            'notulis' => 'required',
        ]);

        
        // hasilnya berbentuk : "itemnya" => "jumlah yang sama"
    // menentutak quantity (qty)
    $arrayrecipient = array_count_values($request->recipients);
    

    // Ambil data dari checkbox yang terpilih
    $guruRecipients = User::where('role', 'guru')->get();

    // Proses untuk menyimpan data penerima ke dalam array $dataRecipients
    $dataRecipients = [];
    foreach ($request->recipients as $recipientId) {
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
    $request['recipients'] = $dataRecipients;

    $selectedNotulisId = $request->input('notulis');
    $notulis = User::find($selectedNotulisId);
    // $datarecipients = [];
        // foreach($arrayrecipient as $key => $value){
        //     // $recipient = User::where('role','guru')->where('id',$key)->first();
        //     $user = User::find($key);
        //     // $user = Letter::where('id',$key)->first();
        //     if($user){
        //     $arrayAssoc = [
        //         "id" => $key,
        //         "name_recipients" => $user->name,
        //     ];
        //     // format assoc dimasukkan ke array penampung sebelumnya
        //     array_push($datarecipients,$arrayAssoc);
        // }
        // }
        // $request['recipients'] = $datarecipients;
        $gurus = User::where('role', 'guru')->orderBy('name', 'ASC')->get();

        $letter_import = Letter_type::orderBy('name_type');

        $selectedLetterType = Letter_type::find($request->name_type);
        // $selectedRecipients = $request->input('recipients', []);

        // Simpan informasi penerima ke dalam basis data
        // simpan data ke db : 'nama_column' => $request->name_input
        if($request->image){
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        }
        else{
            $imageName = 'azqi'. '.' . 'png';
        }
        // Simpan data surat termasuk nama file gambar ke database

        if ($notulis) {
            
        $prosesTambahData = Letter::create([
            // 'letter_type_id' => Letter_type::with('id'),
            'letter_type_id' => $selectedLetterType->id,
            'letter_perihal' => $request->letter_perihal,
            'name_type' => $selectedLetterType->name_type,
            'content' => $request->content,
            // 'recipients' => $selectedRecipients,
            'recipients' => $request->recipients,
            // 'recipients' => $dataRecipients,
            'attachment' => $imageName,
            'notulis' => $notulis->id,
            // 'notulis' => $request->notulis,
        ]);
} else {
    // Lakukan sesuatu jika user tidak ditemukan, misalnya beri pesan error atau handling khusus
    // Contoh:
    return redirect()->back()->with('error', 'User not found.');
}
        // foreach ($selectedRecipients as $recipientId) {
        //     // Misalnya, asumsikan kita menyimpan penerima dalam tabel pivot `letter_recipients`
        //     'recipients'->recipients()->attach($recipientId); // Ubah `recipients` sesuai dengan nama relasi yang sesuai
        // }

        // abis simpen, arahin ke halaman mana
        // return redirect()->back()->with('succes', 'berhasil menambahkan data obat!');
        return redirect()->route('letter.rapat',$prosesTambahData['id']);    
    }

    public function rapat($id)
    {
        //
        $letters = Letter::all();
        $letter_types = Letter_type::all();
        $letter = Letter::where('id',$id)->first();
        return view('letters.surat.rapat',compact('letter','letter_types','letters'));
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

        return view('letters.surat.edit', compact('letter'));
    }
    public function downloadPDF($id)
    {
        //get data yang akan ditampilkan pada pdf
        //data yang dikirim ke PDF wajib array
        // toArray : merubah fungsi dari model apapun menjadi sebuah array
        // first = mengambil data haya satu
        $letter = Letter::where('id',$id)->first()->toArray();
        // $letters = Letter::where('id',$id)->first();

        // ketika data dipanggil di blade pdf,akan dipanggil dengan $apa
        view()->share('letter',$letter);
        // view()->share('letters',$letters);

        // lokasi dan nama blade yang akan didownload ke pdf serta data yang akan ditampilkan 
        $pdf = PDF::loadView('letters.surat.download',$letter);

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
        return view('letters.surat.stock',compact('letters'));
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
    public function letter_detail($id)
    {
        // $letters = Letter::all()->first();
        // return view('letters.surat.letter_list',compact('letters'));
        
        $letter_types = Letter_type::all();
        $letter = Letter::where('id',$id)->first();
        // $gurus = User::where('role', 'guru')->orderBy('name', 'ASC')->simplePaginate(5);
        $gurus = Letter::orderBy('recipients', 'ASC')->get();
        $recipients = $letter->recipients; // Ambil data penerima dari surat

        return view('letters.surat.letter_list',compact('letter','letter_types','gurus','recipients'));

        // return view('letters.klasifikasi.letter_list');
    }
}