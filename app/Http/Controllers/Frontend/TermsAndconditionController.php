<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTermsAndconditionRequest;
use App\Http\Requests\StoreTermsAndconditionRequest;
use App\Http\Requests\UpdateTermsAndconditionRequest;
use App\Models\TermsAndcondition;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TermsAndconditionController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('terms_andcondition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $termsAndconditions = TermsAndcondition::with(['team'])->get();

        return view('frontend.termsAndconditions.index', compact('termsAndconditions'));
    }

    public function create()
    {
        abort_if(Gate::denies('terms_andcondition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.termsAndconditions.create');
    }

    public function store(StoreTermsAndconditionRequest $request)
    {
        $termsAndcondition = TermsAndcondition::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $termsAndcondition->id]);
        }

        return redirect()->route('frontend.terms-andconditions.index');
    }

    public function edit(TermsAndcondition $termsAndcondition)
    {
        abort_if(Gate::denies('terms_andcondition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $termsAndcondition->load('team');

        return view('frontend.termsAndconditions.edit', compact('termsAndcondition'));
    }

    public function update(UpdateTermsAndconditionRequest $request, TermsAndcondition $termsAndcondition)
    {
        $termsAndcondition->update($request->all());

        return redirect()->route('frontend.terms-andconditions.index');
    }

    public function show(TermsAndcondition $termsAndcondition)
    {
        abort_if(Gate::denies('terms_andcondition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $termsAndcondition->load('team');

        return view('frontend.termsAndconditions.show', compact('termsAndcondition'));
    }

    public function destroy(TermsAndcondition $termsAndcondition)
    {
        abort_if(Gate::denies('terms_andcondition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $termsAndcondition->delete();

        return back();
    }

    public function massDestroy(MassDestroyTermsAndconditionRequest $request)
    {
        TermsAndcondition::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('terms_andcondition_create') && Gate::denies('terms_andcondition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TermsAndcondition();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function getTermCondition(Request $request)
    {
        $term = $request->q['term'];

        if(auth()->user())
        {
            if(isset(auth()->user()->team))
            {
                $termsAndcondition = TermsAndcondition::where('team_id',auth()->user()->team->id);
            }else{
                $termsAndcondition = TermsAndcondition::where('team_id',null);
            }

            $termsAndcondition = $termsAndcondition->where('name', 'LIKE', "%$term%")->get();
        }


        $termsAndcondition = $termsAndcondition->toArray();
        if(empty($termsAndcondition)){
            $termsAndcondition[] = [
                'id' => 0,
                'name' => 'Add New Terms & Conditions',
            ];
        }
        echo json_encode($termsAndcondition);
    }

    public function storeTermCondition(Request $request)
    {
        $termsAndcondition = TermsAndcondition::create([
            'name' => $request->condition_name,
            'body'  => $request->term_editor,

        ]);
        if(isset(auth()->user()->team))
        {
            $termsAndcondition->update(['team_id' => auth()->user()->team->id]);

        }

        return $termsAndcondition;
    }
}
