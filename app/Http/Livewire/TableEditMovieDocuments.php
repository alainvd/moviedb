<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use App\Models\Document;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class TableEditMovieDocuments extends TableEditBase
{

    use WithFileUploads;

    public Movie $movie;

    public $documentTypes;

    protected function defaults()
    {
        return [
            'document_type' => '',
            'filename' => '',
            'file' => '',
            'comments' => '',
        ] + parent::defaults();
    }

    protected function rules()
    {
        return [
            'editing.movie_id' => '',
            'editing.document_type' => 'required|string',
            'editing.filename' => 'required|string',
            'editing.file' => 'required',
            'editing.comments' => 'required|string',
        ] + parent::rules();
    }

    protected $upload_rules = [
        'editing.document_type' => 'required|string',    
        'editing.file' => 'required|mimetypes:application/pdf,application/excel,application/vnd.ms-excel, application/vnd.msexcel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:12288',
        'editing.comments' => 'required|string',
    ];

    protected function validationAttributes()
    {
        return [
            'editing.movie_id' => 'movie_id',
            'editing.document_type' => 'document type',
            'editing.filename' => 'filename',
            'editing.file' => 'file',
            'editing.comments' => 'comments',
        ];
    }

    public function messages()
    {
      return [            
        'editing.file.required' => "You must use the 'Choose file' button to select which file you wish to upload",
        'editing.file.mimetypes' => "Only PDF or spreadsheet files are allowed",
      ];
    }

    private function loadItems()
    {
        $this->items = Document::where('movie_id', $this->movie->id)->get()->toArray();
        $this->addUniqueKeys();
    }

    public function mount($movie_id = null, $isApplicant = false, $isEditor = false)
    {
        parent::mount($movie_id, $isApplicant, $isEditor);
        if ($movie_id) {
            $this->movie = Movie::find($movie_id);
            $this->loadItems();
        }
    }

    public function render()
    {
        return view('livewire.table-edit-movie-documents', ['rules' => $this->rules()]);
    }

    public function saveItem()
    {
        $do_file_upload = false;
        $item = $this->getItemByKey($this->editing['key']);
        if (empty($item['file'])) {
            // new item, required to upload new file
            $this->validate($this->upload_rules);
            $do_file_upload = true;
        } else {
            // existing item with file
            // can upload new file, can save without changing file
            if (is_a($this->editing['file'], 'Livewire\TemporaryUploadedFile')) {
                $this->validate($this->upload_rules);
                $do_file_upload = true;
            }
        }
        if ($do_file_upload) {
            $this->editing['filename'] = $this->editing['file']->getClientOriginalName();
            $this->editing['file'] = $this->editing['file']->store('/', 'files');
        }
        parent::saveItem();
    }

    protected function sendItems()
    {
        $this->emitUp('updateMovieDocuments', $this->items);
    }

    public function can_download($file)
    {
        if (Document::where('file', $file)->first()) {
            return true;
        }
        return false;
    }

    public function download(Request $request)
    {
        if ($request->user()->cannot('view', $this->movie->fiche)) {
            abort(404);
        }

        $file = Document::where('file', $request->input('file'))->first();
        return response()->download(storage_path('files/' . $file->file), $file->filename);
    }
    
}
