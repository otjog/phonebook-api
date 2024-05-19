<?php

namespace App\DTO;

class StoreContactDTO
{
    private string $fio;
    private string $phone;
    private bool $isFavorite;

    public function __construct(array $args)
    {
        $this->fio = $args['fio'];
        $this->phone = $args['phone'];
        $this->isFavorite = $args['is_favorite'] ?? false;

    }

    public function getArray(): array
    {
        return [
            'fio' => $this->fio,
            'phone' => $this->phone,
            'is_favorite' => $this->isFavorite,
        ];
    }
}
