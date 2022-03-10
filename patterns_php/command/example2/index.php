<?php

use App\{Document, Menu, OpenDocumentCommand, SaveDocumentCommand, CloseDocumentCommand};

require 'vendor/autoload.php';

// El receptor
$document = new Document();

// El comando
$commandOpen = new OpenDocumentCommand($document);
$commandClose = new CloseDocumentCommand($document);
$commandSave = new SaveDocumentCommand($document);

// El invocador
$menu = new Menu($commandOpen, $commandClose, $commandSave);

// El cliente
$menu->open();
$menu->save();
$menu->close();
