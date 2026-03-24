<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    public function index(Request $request){

        $clients = Client::orderBy('created_at', 'desc')
                                    ->get();

        if($request->ajax()){

            try {
                return DataTables::of($clients)
                    ->addColumn('action', function ($client) {
                        $html = '<div class="text-center d-flex justify-content-center gap-2">';

                        $html .= '<a class="mr-2 btn btn-info btn-sm editClient"  data-id="'. $client->id .'"><i class="fa fa-edit"></i> Edit</a>';


                        $html .= '<a class="btn btn-danger btn-sm deleteClient" href="#" data-id="'. $client->id .'"><i class="fa fa-trash"></i> Delete</a>';
                        $html .= '</div>';

                        return $html;
                    })
                    ->editColumn('first_name', function ($client) {
                         return $client->first_name.' '.$client->last_name;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Throwable $th) {
               dd($th->getMessage());
            }

        }
        return view('clients.index');
    }

    // store
    public function store(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:clients,email',
            'ssn' => 'required',
            'dob' => 'required',
        ]);

        try {
            $client = new Client();
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->email = $request->email;
            $client->ssn = $request->ssn;
            $client->dob = $request->dob;
            $client->save();

            return response()->json(['success' => 'created successfully!']);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['error' => 'Error creating.'], 500);
        }
    }

    // edit
    public function edit($id){
        $client = Client::findOrFail($id);

        return response()->json($client);
    }

    // //update
    public function update(Request $request){
        $request->validate([
            'edit_first_name' => 'required|string|max:255',
            'edit_last_name'  => 'required|string|max:255',
            'edit_email'      => 'required|email|unique:clients,email,' . $request->client_id,
            'edit_ssn'        => 'required',
            'edit_dob'        => 'required|date',
        ], [
            'edit_first_name.required' => 'First name is required',
            'edit_last_name.required'  => 'Last name is required',
            'edit_email.required'      => 'Email is required',
            'edit_email.unique'        => 'Email already taken',
            'edit_ssn.required'        => 'SSN is required',
            'edit_dob.required'        => 'Date of birth is required',
        ]);


        try {
            $client = Client::find($request->client_id);
            $client->first_name = $request->edit_first_name;
            $client->last_name  = $request->edit_last_name;
            $client->email      = $request->edit_email;
            $client->ssn = $request->edit_ssn;
            $client->dob = $request->edit_dob;
            $client->save();

            return 'success';
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error updating cleint.'], 500);
        }
    }

    // delete
    public function delete($id){

        try {
            $client = Client::find($id);

            $client->delete();

            return response()->json(['success' => 'Deleted successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error deleting.'], 500);
        }
    }
}
