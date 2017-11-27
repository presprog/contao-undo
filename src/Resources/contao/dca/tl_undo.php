<?php

$dc = &$GLOBALS['TL_DCA']['tl_undo'];
$dc['list']['label']['showColumns'] = true;
$dc['list']['label']['label_callback'] = ['PresProg\\Undo\\UndoLabelHelper', 'generateLabel'];

$dc['list']['label']['fields'] = ['tstamp', 'content_type', 'description'];

// virtual fields
$dc['fields']['content_type'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_undo']['content_type']
];
$dc['fields']['description'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_undo']['description']
];