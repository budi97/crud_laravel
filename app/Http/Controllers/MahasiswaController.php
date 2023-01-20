<?php

namespace App\Http\Controllers;
use App\Models\mahasiswa;
use Illuminate\Http\Request;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kata = $request->kata;
        if (strlen($kata)) {
            $data = mahasiswa::where('nim','like', "%$kata%")
            ->orwhere('nama','like', "%$kata%")
            ->orwhere('alamat','like', "%$kata%")
            ->orwhere('jurusan','like', "%$kata%")
            ->paginate(5);
        } else {
            $data = mahasiswa::orderby('nim','desc')->paginate(5);$data = mahasiswa::orderby('nim','desc')->paginate(5);    
        }                
        return view('mahasiswa.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
           
        // Session::flash('nim',$request->nim);
        // Session::flash('nama',$request->nama);
        // Session::flash('alamat',$request->alamat);
        // Session::flash('jurusan',$request->jurusan);
        
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required',
            'alamat' => 'required',
            'jurusan' => 'required',
        ],[
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM wajib angka',
            'nim.unique' => 'NIM yang diinputkan sudah ada',
            'nama.required' => 'NAMA wajib diisi',
            'alamat.required' => 'ALAMAT wajib diisi',
            'jurusan.required' => 'JURUSAN wajib diisi',
        ]);
        $data=[
            'nim' => $request->nim,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jurusan' => $request->jurusan,
        ];
        mahasiswa::create($data);
        return redirect('/home')->with('status','berhasil menambahkan data');    
        
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mahasiswa::where('nim', $id)->first();
        return view('mahasiswa.update')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([            
            'nama' => 'required',
            'alamat' => 'required',
            'jurusan' => 'required',
        ],[            
            'nama.required' => 'NAMA wajib diisi',
            'alamat.required' => 'ALAMAT wajib diisi',
            'jurusan.required' => 'JURUSAN wajib diisi',
        ]);
        $data=[            
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jurusan' => $request->jurusan,
        ];
        mahasiswa::where('nim',$id)->update($data);
        return redirect('/home')->with('status','data berhasil diupdate');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mahasiswa::where('nim', $id)->delete();
        return redirect('/home')->with('status','data berhasil dihapus');  
    }
}
