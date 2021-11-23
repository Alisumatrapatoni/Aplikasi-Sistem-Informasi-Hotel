<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;

class EmployeeController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $data = Employee::where('nama', 'LIKE', '%' .$request->search.'%')->paginate(5);
        }else{
            $data = Employee::paginate(15);
        }
        return view('datapegawai', compact('data'));
    }

    public function tambahpegawai(){
        return view('tambahdatapegawai');
    }

    public function insertdatapegawai(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'nama' => 'required|min:7|max:25',
            'notelpon' => 'required|min:11|max:12',
        ]);

        $data = Employee::create($request-> all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampilkandatapegawai($id){

        $data = Employee::find($id);
        //dd($data);
        return view('tampilkandatapegawai', compact('data'));
    }

    public function updatedatapegawai(Request $request, $id){
        $data = Employee::find($id);
        $data->update($request->all());

        return redirect()->route('pegawai')->with('success', 'Data Berhasil Diupdate');
    }

    public function deletedatapegawai($id){
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Dihapus');
    }

    public function exportpdfdatapegawai(){
        $data =Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('datapegawai.pdf');

    }

    public function exportexceldatapegawai(){
        return Excel::download(new EmployeeExport, 'datapegawai.xlsx');
    }

    public function importexceldatapegawai(Request $request){
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('DataPegawai', $namafile);

        Excel::import(new EmployeeImport, \public_path('/DataPegawai/' .$namafile));
        return \redirect()->back();
    }
}
