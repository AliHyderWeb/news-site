<?php

namespace App\Exports;

use PDF;

class GenericPDFExport
{
    protected $data;
    protected $view;
    protected $filename;

    public function __construct($data, $view, $filename = 'document.pdf')
    {
        $this->data = $data;
        $this->view = $view;
        $this->filename = $filename;
    }

    public function download()
    {
        $pdf = PDF::loadView($this->view, $this->data);
        return $pdf->download($this->filename);
    }
}

