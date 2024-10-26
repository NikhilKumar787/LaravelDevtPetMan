<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\DepartmentHead;
use Yajra\DataTables\Facades\DataTables;

use function PHPSTORM_META\type;

class DepartmentHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company_id = $request->company;   
        if ($request->ajax()) {
            $query = DepartmentHead::with(['department_name','department_head'])->where('company_id',$request->comp_id)->select(sprintf('%s.*', (new DepartmentHead())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'department_heads_show';
                $editGate = 'department_funcation_edit';
                $deleteGate = 'department_heads_delete';
                $crudRoutePart = 'department-head';
                $department_heads = DepartmentHead::where('id',$row->id)->first();
    
                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row',
                'department_heads',
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('department_name', function ($row) {
                return $row->department_name ? $row->department_name->name : '';
            });
            $table->addColumn('department_head', function ($row) {
                return $row->department_head ? $row->department_head->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'department_name']);

            return $table->make(true);
        }
    

        return view('admin.departmentHead.index',compact('company_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { 
        $company_id = $request->company; 
        $departmentTypes = Department::pluck('name','id')->prepend(trans('global.pleaseSelect'), '');
        $departmentHead = User::join('role_user','role_user.user_id','=','users.id')
        ->whereIn('role_id',[3,4,5])
        ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.departmentHead.create',compact('departmentTypes','departmentHead','company_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for($i=0;$i<count($request->company_department);$i++)
        {
            $department[$i]['department_id'] = $request->company_department[$i];
            $department[$i]['company_id'] = $request->company_id;
            $department[$i]['head_of_department_id'] = $request->head_id[$i];
        }
        $department = DepartmentHead::insert($department);
        return redirect()->route('admin.department-head.index',['company' => $request->company_id])->with('success','Success !Department head added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentHead $departmentHead)
    {
        $departmentHead->load('department_name','department_head');
        return view('admin.departmentHead.show', compact('departmentHead'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentHead $departmentHead)
    {
        $departmentTypes = Department::pluck('name','id')->prepend(trans('global.pleaseSelect'), '');
        $departmenthead = User::join('role_user','role_user.user_id','=','users.id')->whereIn('role_id',[3,4,5])->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $departmentHead->load('department_name','department_head');
        return view('admin.departmentHead.edit',compact('departmentHead','departmentTypes','departmenthead'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $department = DepartmentHead::where('id',$id)->first();
            $department->update([
              'head_of_department_id' => $request->head_id,  
            ]);
        return redirect()->route('admin.department-head.index',['company' => $department->company_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentHead $departmentHead)
    {
        $departmentHead->delete();
        return back();
    }
}
