<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CsvData;
use League\Csv\Reader;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Auth;


class CsvController extends Controller
{
    public function showUploadForm()
    {
        return view('csv.upload_csv');
    }

    public function process(Request $request)
    {
        $csvFiles = $request->file('csvFiles');
        $headers = [];
    
        foreach ($csvFiles as $csvFile) {
            $fileName = $csvFile->getClientOriginalName();
            $csvFile->storeAs('csv', $fileName, 'public');
            $reader = Reader::createFromPath($csvFile->getPathname());
            $currentHeaders = $reader->fetchOne();
            if (!$currentHeaders) {
                // Handle error: Invalid CSV file or missing headers
            }
            $headers[$fileName] = $currentHeaders;
        }
        session()->put('headers', $headers);
        session()->put('csvFiles', array_keys($headers));
        return view('csv.process_csv', ['headers' => $headers]);
    }

    public function uploadToDatabase(Request $request)
    {
        $headers = $request->input('headers');
        // dd($headers);
        foreach ($headers as $filename => $fileHeaders) {
            // Fetch the CSV data and process it accordingly
            $csvFile = Storage::disk('public')->get('csv/' . $filename);
            $reader = Reader::createFromString($csvFile);
            $reader->setHeaderOffset(0);

            foreach ($reader->getRecords() as $record) {
                $dataToSave = [
                    'first_name' => $record[$fileHeaders['first_name']] ?? null,
                    'last_name' => $record[$fileHeaders['last_name']] ?? null,
                    'email' => $record[$fileHeaders['email']] ?? null,
                    'phone' => $record[$fileHeaders['phone']] ?? null,
                    'address' => $record[$fileHeaders['address']] ?? null,
                ];
                $dataUploaded = CsvData::create($dataToSave);
                if($dataUploaded){
                    $details = [
                        'title' => 'Data has been uploaded',
                        'email' => Auth::user()->email,
                    ];
                   
                }
            }
        }
        return redirect()->back()->with('success', 'Data uploaded to the database.');
    }
}
