<?php

namespace toubeelib\core\dto;

use toubeelib\core\dto\DTO;

class InputSpecialiteDTO extends DTO
{
    protected string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}