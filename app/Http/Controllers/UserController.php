<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Letter_type;
use App\Models\Letter;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  karena function diakses detelah login maka diatmabahkan request
    // public function permission (){
    //     return view('error.permission');

    // }
    public function dashboard(){
        $users = User::where('role','staff')->count();
        $guru = User::where('role','guru')->count();
        $klasifikasi = Letter_type::orderBy('id')->count();
        $surat = Letter::orderBy('id')->count();
        $result = Result::orderBy('id')->count();
        return view('dashboard', compact('users','guru','klasifikasi','surat','result'))->with('success','login berhasil!');

    }
     public function authLogin(Request $request){
        $request->validate([
            // email dns digunakan untuk mengecek user apakah memeiliki alamt google,yahoo dll yang bersifat dns
            // 'email' => 'required|email:dns',
            'email' => 'required',
            'password' => 'required',
        
        ]);
        // simpan data dari dalam email dan password ke dalam variabel untuk memudahkan panggilan 
        $user = $request->only(['email','password']);
        // mengecek kecocokkan email dan password kemudian menyimopannya d dalam class beranama auth(memberi didentitas data riwayat login ke project)
        if(Auth::attempt($user)){
            return redirect('/dashboard');
            // perbedaan redirecxt dan route 
        }else{
            return redirect()->back()->with('failed','Login gagal! silakan coba lagi');
        }
     }

    public function logout(){
        // menghapus atau menghilangkan data session login 
        Auth::logout();
        return redirect()->route('login');
    }
   
    public function index()
    {
        $useres = User::where('role','staff')->count();

        //proses ambil data
        $role = 'staff'; // Misalnya, role diperoleh dari request

        // if ($role == 'guru') {
            $users = User::where('role', 'staff')->orderBy('name', 'ASC')->simplePaginate(5);
            return view('user.index', compact('users','useres'));
        // $users = User::orderBy('name','ASC')->simplePaginate(5);
        // mannggil html yang ada di folder resources/views/user.index.blade.php
        //compact : mengirim data ke blade 
    }
    public function indexGuru(Request $request)
    {
        $role = 'guru'; // Misalnya, role diperoleh dari request

        // if ($role == 'guru') {
            $users = User::where('role', 'guru')->orderBy('name', 'ASC')->simplePaginate(5);
            return view('guru.index', compact('users'));
        // } else {
            // $users = User::where('role', 'staff')->orderBy('name', 'ASC')->simplePaginate(5);
            // return view('user.index', compact('users'));
        // }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');

    }
    
    public function createGuru()
    {
        return view('guru.create');

    }
    /**
     * Store a newly created resource in storage.
     */
    public function user_data(Request $request)
    {
        //
        
        // validasi
        // 'name_input' => 'validasi1/validasi2'

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            
        ]);
        $namaku=substr($request->name,0,3);
        $emailku=substr($request->email,0,3);
        $pw=hash::make($namaku.$emailku);
        // $pw=password_hash('',$request->password);
        // simpan data ke db : 'nama_column' => $request->name_input
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pw,  
            'role' => "staff",
        ]);

        // abis simpen, arahin ke halaman mana
        return redirect()->back()->with('success', 'berhasil menambahkan data staff!');
    
    }
    public function guru_data(Request $request)
    {
        //
        
        // validasi
        // 'name_input' => 'validasi1/validasi2'

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            
        ]);
        $namaku=substr($request->name,0,3);
        $emailku=substr($request->email,0,3);
        $pw=hash::make($namaku.$emailku);
        // $pw=password_hash('',$request->password);
        // simpan data ke db : 'nama_column' => $request->name_input
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pw,
            'role' => "guru",
        ]);

        // abis simpen, arahin ke halaman mana
        return redirect()->back()->with('success', 'berhasil menambahkan data Guru!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $user =User::find($id);
        // mengembalikan bentuk json dikirim data yang diambil dari response status code 200
        // response status code api :
        // 200 -> success/ok
        // 400 an -> errror kode/validasi input
        // 419 ->error token csrf
        // 500 an -> error server hosting
        return response()->json($user,200);
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
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }
    
    public function editGuru($id)
    {
        //
         // mengambil data yang belum dimunculkan
        // find: mencari berdasarkan column
        // bisa jkuga : where ('id',$id)->first()
        $user = User::find($id);

        return view('guru.edit', compact('user'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // validasi
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'password' => '',
        ]);
        $pw=password_hash($request->password,PASSWORD_DEFAULT);

        // cari berdasarkan id terus update
        User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => "staff",
            'password' => $pw,
        ]);
        // redirect ke html user data
        // route digunakan untuk memindahkan suatu ke page yang lain jika ingin menambahkan notif ke tempat lain bisa di ganti ke medicine.tambah atau medicine.edit
        return redirect()->route('user.data')->with('success','Berhasil mengubah data staff!');
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateGuru(Request $request, $id)
    {
        //
        // validasi
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'password' => '',
        ]);
        $pw=password_hash($request->password,PASSWORD_DEFAULT);

        // cari berdasarkan id terus update
        User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => "guru",
            'password' => $pw,
        ]);
        // redirect ke html user data
        // route digunakan untuk memindahkan suatu ke page yang lain jika ingin menambahkan notif ke tempat lain bisa di ganti ke medicine.tambah atau medicine.edit
        return redirect()->route('guru.index')->with('success','Berhasil mengubah data obat!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        User::where('id',$id)->delete();
        return redirect()->back()->with('deleted','Berhasil menghapus data!');
    }

    public function search(Request $request){
        $get = $request->input('search');
        
        $users = User::where('name',$get)->simplePaginate(5);

        
            // $medicine = Medicine::where('created_at',$order)->first();
            
            // format assoc dimasukkan ke array penampung sebelumnya

        return view('user.index', compact('users'));

    }
    public function searchGuru(Request $request){
        $get = $request->input('search');
        
        $users = User::where('name',$get)->simplePaginate(5);

        
            // $medicine = Medicine::where('created_at',$order)->first();
            
            // format assoc dimasukkan ke array penampung sebelumnya

        return view('guru.index', compact('users'));

    }
    
}
