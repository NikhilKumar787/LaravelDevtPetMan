<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class TermsAndconditionController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('terms_andcondition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TermsAndcondition::with(['team'])->select(sprintf('%s.*', (new TermsAndcondition())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'terms_andcondition_show';
                $editGate = 'terms_andcondition_edit';
                $deleteGate = 'terms_andcondition_delete';
                $crudRoutePart = 'terms-andconditions';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.termsAndconditions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('terms_andcondition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.termsAndconditions.create');
    }

    public function store(StoreTermsAndconditionRequest $request)
    {
        $termsAndcondition = TermsAndcondition::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $termsAndcondition->id]);
        }

        return redirect()->route('admin.terms-andconditions.index');
    }

    public function edit(TermsAndcondition $termsAndcondition)
    {
        abort_if(Gate::denies('terms_andcondition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $termsAndcondition->load('team');

        return view('admin.termsAndconditions.edit', compact('termsAndcondition'));
    }

    public function update(UpdateTermsAndconditionRequest $request, TermsAndcondition $termsAndcondition)
    {
        $termsAndcondition->update($request->all());

        return redirect()->route('admin.terms-andconditions.index');
    }

    public function show(TermsAndcondition $termsAndcondition)
    {
        abort_if(Gate::denies('terms_andcondition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $termsAndcondition->load('team');

        return view('admin.termsAndconditions.show', compact('termsAndcondition'));
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
