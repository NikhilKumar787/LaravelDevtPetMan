<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTermRequest;
use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Models\Term;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TermsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('term_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Term::with(['team'])->select(sprintf('%s.*', (new Term())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'term_show';
                $editGate = 'term_edit';
                $deleteGate = 'term_delete';
                $crudRoutePart = 'terms';

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

        return view('admin.terms.index');
    }

    public function create()
    {
        abort_if(Gate::denies('term_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.terms.create');
    }

    public function store(StoreTermRequest $request)
    {
        $term = Term::create($request->all());

        return redirect()->route('admin.terms.index');
    }

    public function edit(Term $term)
    {
        abort_if(Gate::denies('term_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $term->load('team');

        return view('admin.terms.edit', compact('term'));
    }

    public function update(UpdateTermRequest $request, Term $term)
    {
        $term->update($request->all());

        return redirect()->route('admin.terms.index');
    }

    public function show(Term $term)
    {
        abort_if(Gate::denies('term_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $term->load('team');

        return view('admin.terms.show', compact('term'));
    }

    public function destroy(Term $term)
    {
        abort_if(Gate::denies('term_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $term->delete();

        return back();
    }

    public function massDestroy(MassDestroyTermRequest $request)
    {
        Term::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getTerms(Request $request)
    {
        $terms = $request->q['term'];

        if(auth()->user())
        {
            $term = Term::where('name','LIKE',"%$terms%")->get();
        }

        $term = $term->toArray();

        if(empty($term)){
            $term[] = [
                'id' => 0,
                'name' => 'Add New Credit Period',
            ];
        }
        echo json_encode($term);
    }

    public function termStore(Request $request)
    {

        if($request->credit_period == 1)
        {
            $credit_period_days = $request->credit_period_days1;
        }else{
            $credit_period_days = $request->credit_period_days2;
        }

        $term = Term::create([
            'name' => $request->term_name,
            'credit_period' => $request->credit_period,
            'credit_period_days' => $credit_period_days,

        ]);
        if(isset(auth()->user()->team))
        {
            $term->update(['team_id' => auth()->user()->team->id]);

        }

        return $term ;
    }
}
