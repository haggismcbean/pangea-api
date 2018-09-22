<?php

namespace App\MessageFormer;
use App\Traits\Traits;

class MessageFormer
{
    public $message = "";
    private $sentence = "";

    public function formSentence($trait, $subject=null)
    {
        $this->sentence = "";

        $splitString = preg_split("/({{)|(}})/", $trait->defaultLayout);

        foreach ($splitString as $string) {
            if (property_exists($trait, $string)) {
                $string = $trait->string;
            } else {
                if ($subject && $subject->$string) {
                    $string = $subject->$string;
                }
            }
            if ($string === "key") {
                $string = $trait->name;
            }

            if ($string === "value") {
                $string = $trait->trait;
            }

            $this->sentence = $this->sentence . $string;
        }

        $this->sentence = $this->tidy($this->sentence);


        if ($this->areCurlyBraces($this->sentence)) {
            $trait->defaultLayout = $this->sentence;
            $this->formSentence($trait, $subject, true);
        } else {
            $this->message = $this->message . $this->sentence . ". ";
            return $this->sentence;
        }
    }

    public function addSentence($sentence, $subject) {
        $sentence = $this->insertValues($sentence, $subject);
        $sentence = $this->tidy($sentence);
        
        $this->message = $this->message . " " . $sentence . ". ";
    }

    private function tidy($string) {
        $string = ucfirst(trim($string));
        return $string;
    }

    private function insertValues($string, $subject) {
        $sentence = "";

        $splitString = preg_split("/({{)|(}})/", $string);

        foreach ($splitString as $string) {
            if ($subject && $subject->$string) {
                $string = $subject->$string;
            }

            $sentence = $sentence . $string;
        }

        if ($this->areCurlyBraces($sentence)) {
            $string = $sentence;
            $this->formSentence($string, $subject, true);
        } else {
            return $sentence;
        }
    }

    private function areCurlyBraces($string) {
        $splitString = preg_split("/({{)|(}})/", $string);

        if (count($splitString) > 1) {
            return true;
        }

        return false;
    }
}
