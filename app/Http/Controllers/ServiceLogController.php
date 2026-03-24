<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ServiceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ServiceLogController extends Controller
{
    public function index(Request $request){

        $logs = ServiceLog::orderBy('created_at', 'desc')
                                    ->get();

        if($request->ajax()){

            try {
                return DataTables::of($logs)
                    ->editColumn('file_path', function ($log) {
                        if ($log->file_path) {
                            $url = Storage::url($log->file_path); // generate public URL
                            return '<a href="'. $url .'" target="_blank" class="btn btn-sm btn-primary">Download</a>';
                        }
                        return 'No File';
                    })
                    ->editColumn('client_id', function ($log) {
                        return ($log->client->first_name ?? '') . ' ' . ($log->client->last_name ?? '');
                    })
                    ->addColumn('action', function ($client) {
                        $html = '<div class="text-center d-flex justify-content-center gap-2">';

                        $html .= '<a class="mr-2 btn btn-info btn-sm editLog"  data-id="'. $client->id .'"><i class="fa fa-edit"></i> Edit</a>';


                        $html .= '<a class="btn btn-danger btn-sm deleteLog" href="#" data-id="'. $client->id .'"><i class="fa fa-trash"></i> Delete</a>';
                        $html .= '</div>';

                        return $html;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['action','file_path'])
                    ->make(true);
            } catch (\Throwable $th) {
               dd($th->getMessage());
            }

        }

        $clients = Client::all();
        return view('service_logs.index',compact('clients'));
    }

    // store
    public function store(Request $request){
        $request->validate([
            'client' => 'required',
            'notes' => 'required',
            'file' => 'nullable|file',
        ]);

        $file = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('service_logs', 'public');
        }

        try {
            $log = new ServiceLog();
            $log->client_id = $request->client;
            $log->notes = $request->notes;
            $log->file_path = $file;
            $log->save();

            return response()->json(['success' => 'created successfully!']);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['error' => 'Error creating.'], 500);
        }
    }

    // edit
    public function edit($id){
        $log = ServiceLog::find($id);

        return response()->json($log);
    }

    // //update
    public function update(Request $request){
        $request->validate([
            'edit_client' => 'required',
            'edit_notes' => 'required',
            'edit_file' => 'nullable|file',
        ], [
            'edit_client.required' => 'Client is required',
            'edit_notes.required'  => 'Notes is required',
            'edit_file.file'      => 'Invalid File',
        ]);


        try {
            $log = ServiceLog::find($request->log_id);
            $file = $log->file_path;
            if ($request->hasFile('edit_file')) {
                if ($file && Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
                $file = $request->file('edit_file')->store('service_logs', 'public');
            }
            $log->client_id = $request->edit_client;
            $log->notes = $request->edit_notes;
            $log->file_path = $file;
            $log->save();

            return 'success';
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error updating cleint.'], 500);
        }
    }

    // delete
    public function delete($id){

        try {
            $log = ServiceLog::find($id);

            if ($log->file_path && Storage::disk('public')->exists($log->file_path)) {
                Storage::disk('public')->delete($log->file_path);
            }

            $log->delete();

            return response()->json(['success' => 'Deleted successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error deleting.'], 500);
        }
    }
}
