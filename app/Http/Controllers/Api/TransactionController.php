<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function index(){
        $data = Transaction::all();
        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }

    public function store(Request $request, $id){
        $data = $request->all();
        $data['spp_student_id'] = $id;
        $data['user_id'] = Auth::user()->id;
        if($request->file('image')){
            $data['image'] = $request->file('image')->store('assets/image', 'public');
        }
        $transactions = Transaction::create($data);
        return response()->json([
            'meta' => [
                'status' => 'success',
                'code' => 200,
            ],
            'data' => $transactions
        ]);
    }

    public function cancel($id){
        $item = Transaction::where('user_id', Auth::user()->id)->where('status', 'PENDING')->where('id', $id)->first();
        $item->update([
            'status' => 'CANCEL',
        ]);
        return response()->json([
            'data' => $item
        ]);
    }
}
