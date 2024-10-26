@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                           {{-- Widget - latest entries --}}
                        <div class="{{ $settings2['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings2['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach ($settings2['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings2['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings2['data'] as $entry)
                                        <tr>
                                            @foreach ($settings2['fields'] as $key => $value)
                                                <td>
                                                    @if ($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach ($entry->{$key} as $subEentry)
                                                            <span
                                                                class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ data_get($entry, $key . '.' . $value) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($settings2['fields']) }}">
                                                {{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if (auth()->user()->roles[0]->id == 5)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-6">
                                                    <!-- small box -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3>{{$tEmp}}</h3>

                                                            <p>Total Employee</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-bag"></i>
                                                        </div>
                                                        <a href="{{route('admin.users.index')}}"
                                                            class="small-box-footer">More info <i
                                                                class="fas fa-arrow-circle-right"></i></a>
                                                    </div>
                                                </div>
                                                <!-- ./col -->
                                                <div class="col-lg-4 col-6">
                                                    <!-- small box -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3>{{$pEmp}}</h3>
                                                            <p>Present Employee</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-stats-bars"></i>
                                                        </div>
                                                        <a href="{{route('admin.users.index',['type' => 'pe'])}}"
                                                            class="small-box-footer">More info <i
                                                                class="fas fa-arrow-circle-right"></i></a>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-6">
                                                    <!-- small box -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3>{{$aEmp}}</h3>

                                                            <p>Absent Employees</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-person-add"></i>
                                                        </div>
                                                        <a href="{{route('admin.users.index',['type' => 'ae'])}}"
                                                            class="small-box-footer">More info <i
                                                                class="fas fa-arrow-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="{{ $chart1->options['column_class'] }}">
                                    <h3>{!! $chart1->options['chart_title'] !!}</h3>
                                    {!! $chart1->renderHtml() !!}
                                </div>
                                {{-- Widget - latest entries --}}
                                {{-- <div class="{{ $settings2['column_class'] }}" style="overflow-x: auto;">
                                    <h3>{{ $settings2['chart_title'] }}</h3>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                @foreach ($settings2['fields'] as $key => $value)
                                                    <th>
                                                        {{ trans(sprintf('cruds.%s.fields.%s', $settings2['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($settings2['data'] as $entry)
                                                <tr>
                                                    @foreach ($settings2['fields'] as $key => $value)
                                                        <td>
                                                            @if ($value === '')
                                                                {{ $entry->{$key} }}
                                                            @elseif(is_iterable($entry->{$key}))
                                                                @foreach ($entry->{$key} as $subEentry)
                                                                    <span
                                                                        class="label label-info">{{ $subEentry->{$value} }}</span>
                                                                @endforeach
                                                            @else
                                                                {{ data_get($entry, $key . '.' . $value) }}
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="{{ count($settings2['fields']) }}">
                                                        {{ __('No entries found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div> --}}

                                <div class="{{ $chart3->options['column_class'] }}">
                                    <h3>{!! $chart3->options['chart_title'] !!}</h3>
                                    {!! $chart3->renderHtml() !!}
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@if(auth()->user()->roles[0]->id != 5)
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart1->renderJs() !!}{!! $chart3->renderJs() !!}
@endsection
@endif