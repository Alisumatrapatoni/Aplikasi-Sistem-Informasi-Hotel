<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengunjungExport;

class PengunjungController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $data = Pengunjung::where('nama', 'LIKE', '%' .$request->search.'%')->paginate(5);
        }else{
            $data = Pengunjung::paginate(5);
        }

        return view('datapengunjung', compact('data'));
    }

    public function tambahpengunjung(){
        return view('tambahdatapengunjung');
    }

    public function insertdatapengunjung(Request $request){
        //dd($request->all());
        $this->validate($request, [
            'noktp' => 'required|min:11|max:12',
            'nama' => 'required|min:7|max:25',
            'nohp' => 'required|min:11|max:12',
            'alamat' => 'required|max:55',
        ]);
        $data = Pengunjung::create($request -> all());
        return redirect()->route('pengunjung')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampilkandatapengunjung($noktp){
        $data = Pengunjung::find($noktp);
        //dd($data);
        return view('tampilkandatapengunjung', compact('data'));
    }

    public function updatedatapengunjung(Request $request,$noktp){
        $data = Pengunjung::find($noktp);
        $data->update($request-> all());
        return redirect()->route('pengunjung')->with('success', 'Data Berhasil DiUpdate');
    }

    public function deletedatapengunjung($noktp){
        $data = Pengunjung::find($noktp);
        //dd($data);
        $data->delete();
        return redirect()->route('pengunjung')->with('success', 'Data Berhasil DiHapus');
    }

    public function exportpdfdatapengunjung(){

        $data =Pengunjung::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('datapengunjung-pdf');
        return $pdf->download('datapengunjung.pdf');
    }

    public function exportexceldatapengunjung(){
        return Excel::download(new PengunjungExport, 'datapengunjung.xlsx');
    }

}
