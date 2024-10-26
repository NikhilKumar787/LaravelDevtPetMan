<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCityRequest;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CitiesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::with(['state'])->get();

        return view('frontend.cities.index', compact('cities'));
    }

    public function create()
    {
        abort_if(Gate::denies('city_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.cities.create', compact('states'));
    }

    public function store(StoreCityRequest $request)
    {
        $city = City::create($request->all());

        return redirect()->route('frontend.cities.index');
    }

    public function edit(City $city)
    {
        abort_if(Gate::denies('city_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $city->load('state');

        return view('frontend.cities.edit', compact('city', 'states'));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->all());

        return redirect()->route('frontend.cities.index');
    }

    public function show(City $city)
    {
        abort_if(Gate::denies('city_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->load('state');

        return view('frontend.cities.show', compact('city'));
    }

    public function destroy(City $city)
    {
        abort_if(Gate::denies('city_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->delete();

        return back();
    }

    public function massDestroy(MassDestroyCityRequest $request)
    {
        City::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getCity(Request $request)
    {
        $state = $request->state;
        $city = City::where('state_id',$state)->get();

        return $city->toArray();

    }

    public function getParticularCity(Request $request)
    {
        $state  = $request->state;
        $city = City::where('state_id',$state)->get();

        return $city;
    }
}
