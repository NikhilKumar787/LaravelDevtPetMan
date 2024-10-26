<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Http\Resources\Admin\TermResource;
use App\Models\Term;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TermsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('term_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TermResource(Term::with(['team'])->get());
    }

    public function store(StoreTermRequest $request)
    {
        $term = Term::create($request->all());

        return (new TermResource($term))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Term $term)
    {
        abort_if(Gate::denies('term_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TermResource($term->load(['team']));
    }

    public function update(UpdateTermRequest $request, Term $term)
    {
        $term->update($request->all());

        return (new TermResource($term))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Term $term)
    {
        abort_if(Gate::denies('term_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $term->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
