<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Kamar;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KamarExport;

class KamarController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $data = Kamar::where('namapemesan', 'LIKE', '%' .$request->search.'%')->paginate(5);
        }else{
            $data = Kamar::paginate(15);
        }
        return view('datakamar', compact('data'));
    }

    public function tambahkamar(){
        return view('tambahdatakamar');
    }

    public function insertdatakamar(Request $request){
        //dd($request->all());
        $this->validate($request, [
            'namapemesan' => 'required|min:7|max:25',
            'keterangan' => 'required|max:70',
        ]);
        Kamar::create($request->all());
        return redirect()->route('kamar')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampilkandatakamar($id){

        $data = Kamar::find($id);
        //dd($data);
        return view('tampilkandatakamar', compact('data'));
    }

    public function updatedatakamar(Request $request, $id){

        $data = Kamar::find($id);
        $data-> update($request->all());
        return redirect()->route('kamar')->with('success', 'Data Berhasil DiUpdate');
    }

    public function deletedatakamar($id){
        $data = Kamar::find($id);
        $data->delete();
        return redirect()->route('kamar')->with('success', 'Data Berhasil DiHapus');
    }

    public function exportpdfdatakamar(){

        $data =Kamar::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('datakamar-pdf');
        return $pdf->download('datakamar.pdf');
    }

    public function exportexceldatakamar(){
        return Excel::download(new KamarExport, 'datakamar.xlsx');
    }
}
