<?php

namespace App\Http\Controllers;

use App\DTO\StoreContactDTO;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Services\PhoneBookService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function __construct(private PhonebookService $phonebookService){}

    /**
     * @throws AuthorizationException
     */
    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny',  Contact::class);

        $contacts = $this->phonebookService->getAll();

        return ContactResource::collection($contacts);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreContactRequest $request): JsonResponse
    {
        $this->authorize('create', Contact::class);

        $contactDTO = new StoreContactDTO($request->validated());

        $contact = $this->phonebookService->create($contactDTO);

        return response()->json(['data' => ['id' => $contact->id]], 201);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(int $id): ContactResource
    {
        $contact = $this->phonebookService->getById($id);

        $this->authorize('view', $contact);

        return new ContactResource($contact);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateContactRequest $request, int $id): Response
    {
        $data = $request->validated();

        $contact = $this->phonebookService->getById($id);

        $this->authorize('update', $contact);

        $this->phonebookService->update($data, $id);

        return response()->noContent();
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(int $id): Response
    {
        $contact = $this->phonebookService->getById($id);

        $this->authorize('delete', $contact);

        $this->phonebookService->delete($id);

        return response()->noContent();
    }
}
