<?php
namespace Pages\Components;
class modal
{
    protected $modalContent = "";

    public function __construct($modalContent = "")
    {
        $this->modalContent = $modalContent;
    }

    public function showModal()
    {
        echo $this->modalContent;
    }
}