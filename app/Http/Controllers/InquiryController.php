<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $inquiry = new Inquiry;

        $inquiry->name = $request->name;
        $inquiry->email = $request->email;
        $inquiry->number = $request->number;
        $inquiry->message = $request->message;

        $inquiry->save();

        return response()->json(["result" => "ok"], 201);
    }
}
