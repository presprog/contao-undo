<?php

namespace PresProg\Undo;

/**
 * Generates the label in the restore section of Contao 
 *
 * @author: Benedict Zinke <bz@presentprogressive.de>
 */
class UndoLabelHelper
{
    public function generateLabel($row, $label, $dc, $args) {
        $data  = unserialize($row['data']);
        $key   = key($data);

        $return = [];

        $return['tstamp'] = sprintf('<span style="color:#999;">[%s]</span>', date(\Config::get('datimFormat'), $row['tstamp']));

        $type = sprintf('<strong>%s</strong>', $this->getContentTypeFromTable($key, $data[$key][0]));;
        if ('tl_content' === $key) {
            $type .= sprintf('<span> (%s)</span>', $this->getContentElementType($data[$key][0]['type']));
        }
        $return['type'] = $type;

        $description = $this->getDescriptionFromTable($key, $data[$key][0]);
        $return['description'] = $description;

        return $return;
    }


    public function getContentTypeFromTable($table) {
        \Controller::loadLanguageFile($table);
        if (($contentType = $GLOBALS['TL_LANG'][$table][$table][0])) {
            return $contentType;
        }
        return $table;
    }


    public function getContentElementType($type) {
        \Controller::loadLanguageFile('default');
        return ($GLOBALS['TL_LANG']['CTE'][$type][0]) ?: '';
    }


    public function getDescriptionFromTable($table, $data) {
        // TODO: Check for presence of calendar-bundle etc.
        // special cases
        switch ($table) {
            case 'tl_member':
                return $data['firstname'] . ' ' . $data['lastname'];
                break;
            case 'tl_news':
                return $data['headline'];
                break;
            case 'tl_user':
                return sprintf('%s (%s)', $data['username'], $data['name']);
                break;
            case 'tl_style':
                return '';
                break;
            case 'tl_comments':
                return $data['name'] . ': ' . \StringUtil::substr($data['comment'], 75);
                break;
            case 'tl_faq':
                return \StringUtil::substr($data['question'], 75);
                break;
            case 'tl_newsletter_recipients':
                return $data['email'];
                break;
            case 'tl_newsletter':
                return $data['subject'];
                break;
        }

        // if no special cases, check for (1) title or (2) name
        if (isset($data['title']) && !empty($data['title'])) {
            return $data['title'];
        }

        if (isset($data['name']) && !empty($data['name'])) {
            return $data['name'];
        }

        if (isset($data['headline']) && !empty($data['headline'])) {
            $headline = unserialize($data['headline']);
            return $headline['value'];
        }

        if (isset($data['module']) && !empty($data['module'])) {
            $module = \ModuleModel::findById($data['module']);
            return ($module) ? $module->name : $data['module'];
        }
        
    }
}