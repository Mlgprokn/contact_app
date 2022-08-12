<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use App\Models\Inquiry;
use App\Mail\NewInquiry;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    /**
     * Get all inquiries
     *
     * @return jsonresponse
     */
    public function index()
    {
        return Inquiry::all();
    }

    /**
     * Get all inquiries
     *
     * @return jsonresponse
     */
    public function show()
    {
        return Inquiry::where('name', '=', 'test');
    }

    /**
     * Store a new inquiry
     *
     * @return jsonresponse
     */
    public function store(InquiryRequest $request)
    {
        $inquiry = new Inquiry;

        $inquiry->name = $request->name;
        $inquiry->email = $request->email;
        $inquiry->phone = $request->phone;
        $inquiry->message = $request->message;

        $inquiry->save();

        //if everything went succesfully, send a mail
        Mail::to('mail@example.com')->send(new NewInquiry($inquiry));

        //return a json response with the inquiry
        return response()->json(["inquiry" => $inquiry, "success" => "Message succesfully send."], 201);
    }

    /**
     * Delete an inquiry
     *
     * @return jsonresponse
     */
    public function destroy($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->delete();

        //return a json response with the inquiry
        return response()->json(["inquiry" => $inquiry, "success" => "Deleted succesfully."], 201);
    }

}
