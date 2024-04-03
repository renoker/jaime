<?php

namespace App\Http\Controllers;

use App\Imports\MedicamentosImport;
use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportarMedicamentosController extends Controller
{
    private $folder;
    private $view;
    private $index;
    private $create;
    private $store;
    private $update;
    private $edit;

    function __construct()
    {
        $this->folder = 'medicamentos.importador';
        $this->view = 'Importador de medicamentos';
        $this->index = 'medicine.index';
        $this->store = 'medicamentos.importStore';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.{$this->folder}.create", [
            'view'  => $this->view,
            'index' => $this->index,
            'store' => $this->store,
        ]);
    }

    public function store(Request $request)
    {
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '3072M');

        if ($request->hasFile('excel')) {
            $file = $request->file('excel');
            $destinationPath = public_path('assets/xls/');
            $file->move($destinationPath, 'medicamentos.xlsx');

            Excel::import(new MedicamentosImport, public_path('assets/xls/medicamentos.xlsx'));

            return redirect()->route($this->index)->with('alertaSistema', 'All good!');
        }
    }
}
