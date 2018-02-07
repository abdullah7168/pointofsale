<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;
use Illuminate\Contracts\Validation\Validator;
use QrCode;
class TableController extends Controller
{
    public function index(){
        $tables = Table::all();
        return view('backend.pages.tables.index',compact('tables'));
    }

    public function create(){
        return view('backend.pages.tables.create');
    }

    public function postTable(Request $request){
        $validator = $this->validate($request, [
                    'tablenumber' => 'required|unique:tables|max:255',
                    ]);
        if($validator){
            return redirect('/addtable')
                            ->withError($validator);
        } else {
                $table = new Table;
                $table->tablenumber = $request->tablenumber;

                $table->qrcode = QrCode::format('png')->size(250)->generate($request->tablenumber, "../public/qrcodes/".$request->tablenumber.".png");
                $table->save();

                return \redirect('/tables')->with('message','Successfully added the table');
        }
    }
    public function show($id){
        $table = Table::findOrFail($id);
        return view('backend.pages.tables.show',compact('table'));
    }
}
