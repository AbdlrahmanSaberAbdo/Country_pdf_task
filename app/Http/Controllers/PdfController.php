<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pdf as Model;
class PdfController extends Controller
{
    public function fileUpload(Model $pdf, Request $request) {
        // check the validation of file
        $validation = $request->validate([
            'file' => 'required|mimes:pdf'
        ]);

        $fileModel = new Model;
        if($validation) {
            // get the name of file
            $fileName = $request->file->getClientOriginalName();
            // get the size of file
            $fileSize = $request->file('file')->getsize();

            /**
             * check if file contain word 'Proposal or no'
             * pseudocode 
                * $containProbasal = $this->pdfService->searchFor('propasal')
                * if($containProbasal)
                  * continue
                * else
                  * return: error the file should contain propasal word
             */
            /**
             * ==== check if file with same name and size In database
             */
            $getFile = $pdf->where('name', $fileName)->where('size', $fileSize)->first();
            if($getFile) { // if found will update
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $getFile->update([
                    'file_path' => $filePath
                ]);
                return [
                    'response' => 'the file updated successfully',
                    'code' => 200,
                ];
            } else { // create new one
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $fileModel->name = $fileName;
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->size = $fileSize;
                $fileModel->save();
                return [
                    'response' => 'the file created successfully',
                    'code' => 200,
                ];
            }
        }
    }
}
