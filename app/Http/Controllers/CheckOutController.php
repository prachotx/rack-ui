<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\PackingDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Stream;
use PhpOffice\PhpSpreadsheet\Reader;
use PhpOffice\PhpSpreadsheet\Writer;
use PhpOffice\PhpSpreadsheet\Shared;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $check_outs = CheckOut::where('code', 'like', '%' . $search . '%')
            ->orderByDesc('id')->paginate(10)->withQueryString();
        return view("check_out", compact(['check_outs', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('/add_check_out');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $request->validate([
            'out_date' => 'required',
            'remark' => 'required',
        ]);
        $data = [
            'code' => uniqid('CO-'),
            'out_date' => $request->out_date,
            'remark' => $request->remark,
            'out_user_id' => Auth::user()->id,
        ];
        $check_out = CheckOut::create($data);
        $data = [
            'code' => 'CO-'.str_pad($check_out->id,10,'0',STR_PAD_LEFT),
        ];
        $check_out->update($data);
        return redirect('/check_out_detail/'.$check_out->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(CheckOut $checkOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $check_out = CheckOut::find($id);
        return view('/edit_check_out', compact(['check_out']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'out_date' => 'required',
            'remark' => 'required',
        ]);
        $data = [
            'out_date' => $request->out_date,
            'remark' => $request->remark,
        ];
        CheckOut::find($id)->update($data);
        return redirect('/check_out_detail/'.$id);
    }

    public function delete($id)
    {
        $check_out = CheckOut::find($id);
        $data = [
            'status' => 'cancel',
        ];
        $check_out->update($data);
        return redirect('/check_outs/');
    }

    public function confirm($id)
    {
        $check_out = CheckOut::find($id);
        $data = [
            'status' => 'confirm'
        ];
        $check_out->update($data);
        return redirect('/check_outs');
    }

    public function checkoutapp(Request $request)
    {
        $key = $request->input('code');
        $check_out = CheckOut::where('code', $key)->first();

        if ($check_out) {
            $items = [];

            foreach ($check_out->check_out_details as $check_out_items) {
                $packingDetail = $check_out_items->packing_detail;
                $product = $packingDetail->product ?? null;
                $block = $packingDetail->block ?? null;
                //$rack = $block ? $block->rack : null;

                $items[] = [
                    'product_code' => $product ? $product->code : null,
                    'quantity' => $check_out_items->quantity,
                    //'rack' => $rack ? $rack->name : null,
                    'location' => $block ? $block->code : null,
                ];
            }

            return response()->json([
                'Check Out ID' => $check_out->code,
                'items' => $items,
            ]);
        } else {
            return response()->json(['error' => 'CheckOut code not found'], 404);
        }
    }

    public function approve($id)
    {
        $check_out = CheckOut::find($id);
        $data = [
            'status' => 'approve',
            'apporve_user_id' => Auth::user()->id,
        ];
        $check_out->update($data);
        foreach($check_out->check_out_details as $item)
        {
            $packing_detail = PackingDetail::find($item->packing_detail_id);
            $data = [
                'remain_quantity' => $packing_detail->remain_quantity - $item->quantity,
            ];
            $packing_detail->update($data);
        }
        return redirect('/check_outs');
    }

    public function reject($id)
    {
        $check_out = CheckOut::find($id);
        $data = [
            'status' => 'draft'
        ];
        $check_out->update($data);
        return redirect('/check_outs');
    }
    public function print($id)
    {
        $check_out = CheckOut::find($id);
        $check_out_details = $check_out->check_out_details;
        
        $reader = new Reader\Xlsx();
        $spreadsheet = $reader->load("storage/1/excel/check_out.xlsx");
        $sheet = $spreadsheet->getSheetByName('Sheet1');
        
        $cell = $sheet->getCell('B' . ("2"));
        $cell->setValue($check_out->out_date);

        $cell = $sheet->getCell('G' . ("2"));
        $cell->setValue($check_out->code);

        $cell = $sheet->getCell('B' . ("3"));
        $cell->setValue($check_out->remark);

        $rowNo = 4;
        $i=1;
        foreach ($check_out_details as $item) {
            $cell = $sheet->getCell('A' . ($rowNo+$i));
            $cell->setValue($i);
            $cell = $sheet->getCell('B' . ($rowNo+$i));
            $cell->setValue($item->packing_detail->product->code);
            $cell = $sheet->getCell('C' . ($rowNo+$i));
            $cell->setValue($item->packing_detail->product->name);
            $cell = $sheet->getCell('D' . ($rowNo+$i));
            $cell->setValue($item->packing_detail->ref_no);
            $cell = $sheet->getCell('E' . ($rowNo+$i));
            $cell->setValue($item->quantity);
            $cell = $sheet->getCell('F' . ($rowNo+$i));
            $cell->setValue($item->packing_detail->block->rack->name);
            $cell = $sheet->getCell('G' . ($rowNo+$i));
            $cell->setValue($item->packing_detail->block->code);

            $barcodeCell = $sheet->getCell('H' . ($rowNo + $i));
            $barcodeValue = '*' . $item->check_out->code . '*';
            $barcodeCell->setValue($barcodeValue);

            $sheet->getStyle('H' . ($rowNo + $i))->getFont()->setName('Code128');
            $sheet->getStyle('H' . ($rowNo + $i))->getFont()->setSize(20); 

            $i++;
        }
        $cell = $sheet->getCell('G48');
        $pack_by = User::find($check_out->out_user_id);
        $cell->setValue($pack_by->name);
        
        if($check_out->approve_user_id!=null){
            $approve_by = User::find($check_out->approve_user_id);
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
                'Content-Disposition' => 'attachment; filename="check_out-'.$check_out->code.'.xlsx"'
            ]);
    }
}
