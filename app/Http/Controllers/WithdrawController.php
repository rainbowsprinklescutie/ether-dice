<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;



class WithdrawController extends Controller
{
    public function create()
{
    return view('withdraw');
}
    public function store(Request $request)
    {
        $user = auth()->user();
        $balance = $user->coins;
    
        $request->validate([
            'coins' => 'required|integer|min:1|max:' . $balance,
            'eth_address' => 'required_without:bnb_address',
            'bnb_address' => 'required_without:eth_address',
        ]);
    
        $withdrawal = new withdrawal();
        $withdrawal->user_id = $user->id;
        $withdrawal->coins = $request->coins;
        $withdrawal->eth_address = $request->eth_address;
        $withdrawal->bnb_address = $request->bnb_address;
        $withdrawal->save();
    
        try {
            DB::beginTransaction();
    
            $withdrawal->save();
    
            $user->coins -= $request->coins;
            $user->save();
    
            DB::commit();
    
            return redirect()->back()->with('success', 'ETH withdrawal request submitted successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
    
    public function getAllWithdrawals()
{
    $withdrawals = Withdrawal::all();
    return view('admin.index', compact('withdrawals'));
}
public function withdrawETH(Request $request)
{
    $user = auth()->user();
    $balance = $user->coins;

    $request->validate([
        'coins' => 'required|integer|min:1|max:' . $balance,
        'eth_address' => 'required',
    ]);

    $withdrawal = new Withdrawal();
    $withdrawal->user_id = $user->id;
    $withdrawal->coins = $request->coins;
    $withdrawal->eth_address = $request->eth_address;
    $withdrawal->save();

    try {
        DB::beginTransaction();

        $withdrawal->save();

        $user->coins -= $request->coins;
        $user->save();

        DB::commit();

        return redirect()->back()->with('success', 'ETH withdrawal request submitted successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
    }
}

public function showETHWithdrawForm()
{
    return view('withdraw.eth');
}

}
