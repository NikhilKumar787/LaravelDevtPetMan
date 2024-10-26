<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTermRequest;
use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Models\Term;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TermsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('term_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $terms = Term::with(['team'])->get();

        return view('frontend.terms.index', compact('terms'));
    }

    public function create()
    {
        abort_if(Gate::denies('term_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.terms.create');
    }

    public function store(StoreTermRequest $request)
    {
        $term = Term::create($request->all());

        return redirect()->route('frontend.terms.index');
    }

    public function edit(Term $term)
    {
        abort_if(Gate::denies('term_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $term->load('team');

        return view('frontend.terms.edit', compact('term'));
    }

    public function update(UpdateTermRequest $request, Term $term)
    {
        $term->update($request->all());

        return redirect()->route('frontend.terms.index');
    }

    public function show(Term $term)
    {
        abort_if(Gate::denies('term_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $term->load('team');

        return view('frontend.terms.show', compact('term'));
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
