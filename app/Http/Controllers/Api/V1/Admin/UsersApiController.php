<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['roles', 'departments', 'team'])->get());
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->departments()->sync($request->input('departments', []));
        foreach ($request->input('identity_proof', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identity_proof');
        }

        foreach ($request->input('address_proof', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('address_proof');
        }

        if ($request->input('passport_size_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport_size_photo'))))->toMediaCollection('passport_size_photo');
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['roles', 'departments', 'team']));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->departments()->sync($request->input('departments', []));
        if (count($user->identity_proof) > 0) {
            foreach ($user->identity_proof as $media) {
                if (!in_array($media->file_name, $request->input('identity_proof', []))) {
                    $media->delete();
                }
            }
        }
        $media = $user->identity_proof->pluck('file_name')->toArray();
        foreach ($request->input('identity_proof', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identity_proof');
            }
        }

        if (count($user->address_proof) > 0) {
            foreach ($user->address_proof as $media) {
                if (!in_array($media->file_name, $request->input('address_proof', []))) {
                    $media->delete();
                }
            }
        }
        $media = $user->address_proof->pluck('file_name')->toArray();
        foreach ($request->input('address_proof', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('address_proof');
            }
        }

        if ($request->input('passport_size_photo', false)) {
            if (!$user->passport_size_photo || $request->input('passport_size_photo') !== $user->passport_size_photo->file_name) {
                if ($user->passport_size_photo) {
                    $user->passport_size_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport_size_photo'))))->toMediaCollection('passport_size_photo');
            }
        } elseif ($user->passport_size_photo) {
            $user->passport_size_photo->delete();
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
