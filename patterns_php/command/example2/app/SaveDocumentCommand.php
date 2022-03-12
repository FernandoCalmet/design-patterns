<?php

namespace App;

class SaveDocumentCommand implements Command
{
    protected Document $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function execute()
    {
        $this->document->save();
    }
}
