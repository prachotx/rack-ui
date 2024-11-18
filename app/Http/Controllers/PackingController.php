<?php

namespace App\Http\Controllers;

use App\Models\Packing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Stream;
use PhpOffice\PhpSpreadsheet\Reader;
use PhpOffice\PhpSpreadsheet\Writer;
use PhpOffice\PhpSpreadsheet\Shared;

class PackingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $packings = Packing::where('code', 'like', '%' . $search . '%')
            ->orderByDesc('id')->paginate(10)->withQueryString();
        return view("packing", compact(['packings', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('/add_packing');
    }

    public function create(Request $request)
    {
        $request->validate([
            'pack_date' => 'required',
            'remark' => 'required',
        ]);
        $data = [
            'code' => uniqid('PK-'),
            'pack_date' => $request->pack_date,
            'remark' => $request->remark,
            'pack_user_id' => Auth::user()->id,
        ];
        $packing = Packing::create($data);
        $data = [
            'code' => 'PK-'.str_pad($packing->id,10,'0',STR_PAD_LEFT),
        ];
        $packing->update($data);
        return redirect('/view_packing/'.$packing->id);
    }

    /**
     * Display the specified resource.
     */
    public function view($id)
    {
        $packing = Packing::find($id);
        return view('/view_packing', compact(['packing']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    function edit($id)
    {
        $packing = Packing::find($id);
        return view('/edit_packing', compact(['packing']));
    }

    /**
     * Update the specified resource in storage.
     */
    function update($id, Request $request)
    {
        $request->validate([
            'pack_date' => 'required',
            'remark' => 'required',
        ]);
        $data = [
            'pack_date' => $request->pack_date,
            'remark' => $request->remark,
        ];
        Packing::find($id)->update($data);
        return redirect('/view_packing/'.$id);
    }

    public function delete($id)
    {
        $packing = Packing::find($id);
        $data = [
            'status' => 'cancel',
        ];
        $packing->update($data);
        return redirect('/packings/');
    }
    
    public function confirm($id)
    {
        $packing = Packing::find($id);
        $data = ['status' => 'confirm'];
        $packing->update($data);
        return redirect('/packings');
    }
    
    public function checkinapp(Request $request)
    {

        $key = $request->input('code');
        $packing = Packing::where('code', $key)->first();

        if ($packing) {
            $items = [];

            foreach ($packing->packing_details as $detail) {
                $items[] = [
                    'product_code' => $detail->product->code,
                    'quantity' => $detail->quantity,
                    //'rack' => $detail->block->rack->name,
                    'location' => $detail->block->code,
                ];
            }

            return response()->json([
                'PackingList' => $packing->code,
                'items' => $items,
            ]);
        } else {
            return response()->json(['error' => 'Packing code not found'], 404);
        }
    }

    public function approveapp(Request $request)
    {
        $key = $request->input('code');
        $memberID = $request->input('memberID');

        $packing = Packing::where('code', $key)->first();

        if ($packing) {
            $data = [
                'status' => 'approve',
                'approve_user_id' => $memberID,
            ];

            $packing->update($data);

            return response()->json([
                'PackingCode' => $packing->code,
                'status' => 'approved',
            ]);
        } else {
            return response()->json(['error' => 'Packing code not found'], 404);
        }
    }
    
    public function approve($id)
    {
        $packing = Packing::find($id);
        $data = [
            'status' => 'approve',
            'approve_user_id' => Auth::user()->id,
        ];
        $packing->update($data);
        return redirect('/packings');
    }

    public function reject($id)
    {
        $packing = Packing::find($id);
        $data = [
            'status' => 'draft',        
            'approve_user_id' => null,
        ];
        $packing->update($data);
        return redirect('/packings');
    }
    public function print($id)
    {
        $packing = Packing::find($id);
        $packing_details = $packing->packing_details;
        
        $reader = new Reader\Xlsx();
        $spreadsheet = $reader->load("storage/1/excel/packing.xlsx");
        $sheet = $spreadsheet->getSheetByName('Sheet1');
        
        $cell = $sheet->getCell('B' . ("2"));
        $cell->setValue($packing->pack_date);

        $cell = $sheet->getCell('G' . ("2"));
        $cell->setValue($packing->code);

        $cell = $sheet->getCell('B' . ("3"));
        $cell->setValue($packing->remark);  

        $rowNo = 4;
        $i=1;
        foreach ($packing_details as $item) {
            $cell = $sheet->getCell('A' . ($rowNo+$i));
            $cell->setValue($i);
            $cell = $sheet->getCell('B' . ($rowNo+$i));
            $cell->setValue($item->product->code);
            $cell = $sheet->getCell('C' . ($rowNo+$i));
            $cell->setValue($item->product->name);
            $cell = $sheet->getCell('D' . ($rowNo+$i));
            $cell->setValue($item->ref_no);
            $cell = $sheet->getCell('E' . ($rowNo+$i));
            $cell->setValue($item->quantity);
            $cell = $sheet->getCell('F' . ($rowNo+$i));
            $cell->setValue($item->block->rack->name);
            $cell = $sheet->getCell('G' . ($rowNo+$i));
            $cell->setValue($item->block->code);

            $barcodeCell = $sheet->getCell('H' . ($rowNo + $i));
            $barcodeValue = '*' . $item->packing->code . '*';
            $barcodeCell->setValue($barcodeValue);

            $sheet->getStyle('H' . ($rowNo + $i))->getFont()->setName('Code128');
            $sheet->getStyle('H' . ($rowNo + $i))->getFont()->setSize(20); 

            $i++;
        }
        $cell = $sheet->getCell('G48');
        $pack_by = User::find($packing->pack_user_id);
        $cell->setValue($pack_by->name);
        
        if($packing->approve_user_id!=null){
            $approve_by = User::find($packing->approve_user_id);
            $cell = $sheet->getCell('G49');
            $cell->setValue($approve_by->name);
        }

        $excelWriter = new Writer\Xlsx($spreadsheet);
        $tempFile = tempnam(Shared\File::sysGetTempDir(), 'phpxltmp');
        $tempFile = $tempFile ?: __DIR__ . '/temp.xlsx';
        $excelWriter->save($tempFile);

        $stream = fopen($tempFile, 'r+');
        return response(new Stream($stream))
            ->withHeaders([
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="packing-'.$packing->code.'.xlsx"'
            ]);
    }
}
