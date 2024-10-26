@extends('layouts.customer')
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
                                <div class="col-md-12">
                                    <h2>Welcome to TaxTube</h2>
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
@endsection
@endif