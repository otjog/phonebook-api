<?php

namespace App\Services;

use App\DTO\StoreContactDTO;
use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PhoneBookService
{
    public function getAll(): LengthAwarePaginator
    {
        return Contact::belongsToUser()
            ->orderBy('fio')
            ->paginate(10)
            ->withQueryString();
    }

    public function create(StoreContactDTO $dto): Contact
    {
        return Contact::create([
            'user_id' => auth()->user()->id,
            ...$dto->getArray()
        ]);
    }

    public function getById(int $id): Contact
    {
        return Contact::belongsToUser()->findOrFail($id);
    }

    public function update(array $data, int $id): void
    {
        Contact::belongsToUser()->hasId($id)->update($data);
    }

    public function delete(int $id): void
    {
        Contact::belongsToUser()->hasId($id)->delete();
    }


}
