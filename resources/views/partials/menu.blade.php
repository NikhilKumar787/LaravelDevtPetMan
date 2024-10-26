<aside class="main-sidebar sidebar-dark-primary" style="min-height: 917px;">
    <!-- Brand Logo -->
    @if(auth()->user()->is_admin)
    <a href="{{route('admin.home')}}" class="brand-link text-center">
        <!-- <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span> -->
        <img src="{{asset('img/logo-w.png')}}" width="" alt="razorpay">
    </a>
    @else
    <a href="{{route('frontend.home')}}" class="brand-link text-center">
        <!-- <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span> -->
        <img src="{{asset('img/logo-w.png')}}" width="" alt="razorpay">
    </a>
    @endif
    @php
    if(auth()->user()->is_admin)
    {
    $company = App\Models\Company::where('team_id',null)->first();
    }else{
        if(auth()->user()->team != null){
            $company = App\Models\Company::where('team_id',auth()->user()->team->id)->first();
            if(auth()->user()->profile != 'complete' || (empty($company) || (!empty($company) && $company->profile != 'complete')))
            {
                $pointer = 'none';
            }else{
                $pointer = 'auto';
            }
        }else{
            $pointer = 'none';
        }    
    }


    @endphp

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        @if(auth()->user()->is_admin)
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
              
                @can('user_management_access')
                <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }} {{ request()->is("admin/groups*") ? "menu-open" : "" }} {{ request()->is("admin/user-addresses*") ? "menu-open" : "" }} {{ request()->is("admin/teams*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-users"></i>
                        <p>
                            {{ trans('cruds.userManagement.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('permission_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-unlock-alt"></i>
                                <p>
                                    {{ trans('cruds.permission.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('role_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-briefcase">

                                </i>
                                <p>
                                    {{ trans('cruds.role.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-user">

                                </i>
                                <p>
                                    {{ trans('cruds.user.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('audit_log_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-file-alt">

                                </i>
                                <p>
                                    {{ trans('cruds.auditLog.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('group_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.groups.index") }}" class="nav-link {{ request()->is("admin/groups") || request()->is("admin/groups/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-object-group">

                                </i>
                                <p>
                                    {{ trans('cruds.group.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_address_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.user-addresses.index") }}" class="nav-link {{ request()->is("admin/user-addresses") || request()->is("admin/user-addresses/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-map-marker">

                                </i>
                                <p>
                                    {{ trans('cruds.userAddress.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('team_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-users">

                                </i>
                                <p>
                                    {{ trans('cruds.team.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('user_alert_access')
                <li class="nav-item">
                    <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-bell">

                        </i>
                        <p>
                            {{ trans('cruds.userAlert.title') }}
                        </p>
                    </a>
                </li>
                @endcan
                @can('master_access')
                <li class="nav-item has-treeview {{ request()->is("admin/customers*") ? "menu-open" : "" }} {{ request()->is("admin/vendors*") ? "menu-open" : "" }} {{ request()->is("admin/companies*") ? "menu-open" : "" }} {{ request()->is("admin/terms*") ? "menu-open" : "" }} {{ request()->is("admin/account-types*") ? "menu-open" : "" }} {{ request()->is("admin/account-names*") ? "menu-open" : "" }} {{ request()->is("admin/department-head*") ? "menu-open" : "" }} {{ request()->is("admin/manage-task*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-chart-pie">

                        </i>
                        <p>
                            {{ trans('cruds.master.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('company_access')
                        <li class="nav-item has-treeview {{ request()->is("admin/customers*") ? "menu-open" : "" }} {{ request()->is("admin/vendors*") ? "menu-open" : "" }} {{ request()->is("admin/companies*") ? "menu-open" : "" }} {{ request()->is("admin/terms*") ? "menu-open" : "" }} {{ request()->is("admin/account-types*") ? "menu-open" : "" }} {{ request()->is("admin/account-names*") ? "menu-open" : "" }}  {{ request()->is("admin/department-head*") ? "menu-open" : "" }} {{ request()->is("admin/manage-task*") ? "menu-open" : "" }}">
                            <a class="nav-link {{ request()->is("admin/companies") || request()->is("admin/companies/*") || request()->is("admin/manage-task") || request()->is("admin/manage-task/*")|| request()->is("admin/department-head") || request()->is("admin/department-head/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-building">
                                </i>
                                <p>
                                    {{ trans('cruds.company.title') }} Management
                                    <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route("admin.companies.index") }}" class="nav-link {{ request()->is("admin/companies") || request()->is("admin/companies/*") ||  request()->is("admin/department-head") || request()->is("admin/department-head/*") ||  request()->is("admin/manage-task") || request()->is("admin/manage-task/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.company.title') }}
                                        </p>
                                    </a>
                                </li>
                                @can('customer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.customers.index") }}" class="nav-link {{ request()->is("admin/customers") || request()->is("admin/customers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-friends">

                                        </i>
                                        <p>
                                            {{ trans('cruds.customer.title') }}
                                        </p>
                                    </a>
                                </li>
                                @endcan
                                @can('vendor_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vendors.index") }}" class="nav-link {{ request()->is("admin/vendors") || request()->is("admin/vendors/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-sellcast">

                                        </i>
                                        <p>
                                            {{ trans('cruds.vendor.title') }}
                                        </p>
                                    </a>
                                </li>
                                @endcan

                            </ul>

                        </li>
                        @can('term_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.terms.index") }}" class="nav-link {{ request()->is("admin/terms") || request()->is("admin/terms/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-terminal">

                                </i>
                                <p>
                                    {{ trans('cruds.term.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('account_type_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.account-types.index") }}" class="nav-link {{ request()->is("admin/account-types") || request()->is("admin/account-types/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-object-group">

                                </i>
                                <p>
                                    {{ trans('cruds.accountType.title') }}
                                </p>
                            </a>

                        </li>
                        @endcan
                        @can('account_name_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.account-names.index") }}" class="nav-link {{ request()->is("admin/account-names") || request()->is("admin/account-names/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-file-invoice">

                                </i>
                                <p>
                                    {{ trans('cruds.accountName.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @endcan

                    </ul>
                </li>
                @endcan
                @can('setting_access')
                <li class="nav-item has-treeview {{ request()->is("admin/countries*") ? "menu-open" : "" }} {{ request()->is("admin/states*") ? "menu-open" : "" }} {{ request()->is("admin/cities*") ? "menu-open" : "" }} {{ request()->is("admin/departments*") ? "menu-open" : "" }} {{ request()->is("admin/department_funcations*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-cogs">

                        </i>
                        <p>
                            {{ trans('cruds.setting.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('country_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-flag">

                                </i>
                                <p>
                                    {{ trans('cruds.country.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('state_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.states.index") }}" class="nav-link {{ request()->is("admin/states") || request()->is("admin/states/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-map-marked">

                                </i>
                                <p>
                                    {{ trans('cruds.state.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('city_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.cities.index") }}" class="nav-link {{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-map-marker">

                                </i>
                                <p>
                                    {{ trans('cruds.city.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('department_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.departments.index") }}" class="nav-link {{ request()->is("admin/departments") || request()->is("admin/departments/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-bezier-curve">

                                </i>
                                <p>
                                    {{ trans('cruds.department.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('department_funcation_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.department_funcations.index") }}" class="nav-link {{ request()->is("admin/department_funcations") || request()->is("admin/department_funcations/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-bezier-curve">

                                </i>
                                <p>
                                    {{ trans('cruds.department.fields.department_funcation') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('sale_access')
                <li class="nav-item has-treeview {{ request()->is("admin/products*") ? "menu-open" : "" }} {{ request()->is("admin/gst*") ? "menu-open" : "" }} {{ request()->is("admin/invoices*") ? "menu-open" : "" }} {{ request()->is("admin/invoice-details*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-rupee-sign"></i>
                        <p>
                            {{ trans('cruds.sale.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            a href="{{ route("admin.invoices.all-invoices") }}" class="nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-box">

                        </i>
                        <p>
                            All Invoices
                        </p>
                        </a>
                  </li> --}}
                @can('product_access')
                <li class="nav-item">
                    <a href="{{ route("admin.products.index") }}" class="nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-box">

                        </i>
                        <p>
                            {{ trans('cruds.product.title') }}
                        </p>
                    </a>
                </li>
                @endcan

                @can('gst_access')
                <li class="nav-item">
                    <a href="{{ route("admin.gst.index") }}" class="nav-link {{ request()->is("admin/gst") || request()->is("admin/gst/*") ? "active" : "" }}">
                        <i style="margin-left: 5px" class="fa-fw nav-icon bi bi-percent"></i>
                        <p>
                            {{ trans('cruds.gst.title') }}
                        </p>
                    </a>
                </li>
                @endcan

                @can('invoice_access')
                <li class="nav-item has-treeview {{ request()->is("admin/invoices/*") ? "menu-open" : "" }} {{ request()->is("admin/invoices/create") ? "menu-open" : "" }} {{ request()->get("type")=="paid" || request()->get("type")=="unpaid" || request()->get("type")=="myrequests" ? "menu-open active" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-receipt">

                        </i>
                        <p>
                            {{ trans('cruds.invoice.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('create_invoice_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.invoices.create") }}" class="nav-link {{ request()->is("admin/invoices/create") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-receipt">

                                </i>
                                <p>
                                    {{ trans('cruds.invoice.fields.create_invoice') }}
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('paid_invoice_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.invoices.index",['type'=>'paid']) }}" class="nav-link {{ request()->get("type")=="paid" ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-receipt">

                                </i>
                                <p>
                                    {{ trans('cruds.invoice.fields.paid_invoice') }}
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('unpaid_invoice_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.invoices.index",['type'=>'unpaid']) }}" class="nav-link {{ request()->get("type")=="unpaid" ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-receipt">

                                </i>
                                <p>
                                    {{ trans('cruds.invoice.fields.unpaid_invoice') }}
                                </p>
                            </a>
                        </li>
                        @endcan


                        @can('my_requests_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.invoices.index",['type'=>'myrequests']) }}" class="nav-link {{ request()->get("type")=="myrequests" ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-receipt">

                                </i>
                                <p>
                                    {{ trans('cruds.invoice.fields.my_requests') }}
                                </p>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @endcan

                @can('invoice_detail_access')
                <li class="nav-item">
                    <a href="{{ route("admin.invoice-details.index") }}" class="nav-link {{ request()->is("admin/invoice-details") || request()->is("admin/invoice-details/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-receipt"></i>
                        <p>
                            {{ trans('cruds.invoiceDetail.title') }}
                        </p>
                    </a>
                </li>
                @endcan
            </ul>
         </li>
        @endcan

        @can('task_management_access')
            
            <li class="nav-item has-treeview {{ request()->is("admin/task-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/sub-tasks*") ? "menu-open" : "" }} {{ request()->is("admin/task-tags*") ? "menu-open" : "" }} {{ request()->is("admin/tasks*") ? "menu-open" : "" }} {{ request()->is("admin/tasks-calendars*") ? "menu-open" : "" }} {{ request()->is("admin/assigned-tasks*") ? "menu-open" : "" }} {{ request()->is("admin/assigned-sub-tasks") ? "menu-open" : "" }} {{ request()->is("admin/assigned-task-details*") ? "menu-open" : "" }} {{ request()->is("admin/assigned-sub-task-details*") ? "menu-open" : "" }}">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa-fw nav-icon fas fa-list">

                    </i>
                    <p>
                        {{ trans('cruds.taskManagement.title') }}
                        <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('task_status_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.task-statuses.index") }}" class="nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-server">

                            </i>
                            <p>
                                {{ trans('cruds.taskStatus.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('task_tag_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.task-tags.index") }}" class="nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-server">

                            </i>
                            <p>
                                {{ trans('cruds.taskTag.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('task_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-briefcase">

                            </i>
                            <p>
                                {{ trans('cruds.task.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('sub_task_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.sub-tasks.index") }}" class="nav-link {{ request()->is("admin/sub-tasks") || request()->is("admin/sub-tasks/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-briefcase">

                            </i>
                            <p>
                                {{ trans('cruds.subTask.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('tasks_calendar_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.tasks-calendars.index") }}" class="nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-calendar">

                            </i>
                            <p>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('assigned_task_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.assigned-tasks.index") }}" class="nav-link {{ request()->is("admin/assigned-tasks") || request()->is("admin/assigned-tasks/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-tasks">

                            </i>
                            <p>
                                {{ trans('cruds.assignedTask.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('assigned_sub_task_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.assigned-sub-tasks.index") }}" class="nav-link {{ request()->is("admin/assigned-sub-tasks") || request()->is("admin/assigned-sub-tasks/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-tasks">

                            </i>
                            <p>
                                {{ trans('cruds.assignedSubTask.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('assigned_task_detail_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.assigned-task-details.index") }}" class="nav-link {{ request()->is("admin/assigned-task-details") || request()->is("admin/assigned-task-details/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-info-circle">

                            </i>
                            <p>
                                {{ trans('cruds.assignedTaskDetail.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('assigned_sub_task_detail_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.assigned-sub-task-details.index") }}" class="nav-link {{ request()->is("admin/assigned-sub-task-details") || request()->is("admin/assigned-sub-task-details/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-info-circle">

                            </i>
                            <p>
                                {{ trans('cruds.assignedSubTaskDetail.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                    <i class="fas fa-fw fa-calendar nav-icon">

                    </i>
                    <p>
                        {{ trans('global.systemCalendar') }}
                    </p>
                </a>
            </li>
            @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                    <i class="fa-fw fa fa-envelope nav-icon">

                    </i>
                    <p>{{ trans('global.messages') }}</p>
                    @if($unread > 0)
                    <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
            <li class="nav-item">
                <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }} nav-link" href="{{ route("admin.team-members.index") }}">
                    <i class="fa-fw fa fa-users nav-icon">
                    </i>
                    <p>
                        {{ trans("global.team-members") }}
                    </p>
                </a>
            </li>
            @endif
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                    <i class="fa-fw fas fa-key nav-icon">
                    </i>
                    <p>
                        {{ trans('global.change_password') }}
                    </p>
                </a>
            </li>
            @endcan
            @endif

            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <p>
                        <i class="fas fa-fw fa-sign-out-alt nav-icon">

                        </i>
                        <p>{{ trans('global.logout') }}</p>
                    </p>
                </a>
            </li>
            </ul>
        </nav>
        @else

        <nav class="mt-2" style="pointer-events: {{$pointer}}">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("frontend.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }} {{ request()->is("admin/groups*") ? "menu-open" : "" }} {{ request()->is("admin/user-addresses*") ? "menu-open" : "" }} {{ request()->is("admin/teams*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-users"></i>
                        <p>
                            {{ trans('cruds.userManagement.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('permission_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-unlock-alt">

                                </i>
                                <p>
                                    {{ trans('cruds.permission.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('role_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-briefcase">

                                </i>
                                <p>
                                    {{ trans('cruds.role.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-user">

                                </i>
                                <p>
                                    {{ trans('cruds.user.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('audit_log_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-file-alt">

                                </i>
                                <p>
                                    {{ trans('cruds.auditLog.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('group_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.groups.index") }}" class="nav-link {{ request()->is("admin/groups") || request()->is("admin/groups/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-object-group">

                                </i>
                                <p>
                                    {{ trans('cruds.group.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_address_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.user-addresses.index") }}" class="nav-link {{ request()->is("admin/user-addresses") || request()->is("admin/user-addresses/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-map-marker">

                                </i>
                                <p>
                                    {{ trans('cruds.userAddress.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('team_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.teams.index") }}" class="nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-users">

                                </i>
                                <p>
                                    {{ trans('cruds.team.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('user_alert_access')
                <li class="nav-item">
                    <a href="{{ route("frontend.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-bell">

                        </i>
                        <p>
                            {{ trans('cruds.userAlert.title') }}
                        </p>
                    </a>
                </li>
                @endcan
                @can('master_access')
                <li class="nav-item has-treeview {{ request()->is("customers*") ? "menu-open" : "" }} {{ request()->is("vendors*") ? "menu-open" : "" }} {{ request()->is("companies*") ? "menu-open" : "" }} {{ request()->is("terms*") ? "menu-open" : "" }} {{ request()->is("account-types*") ? "menu-open" : "" }} {{ request()->is("account-names*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-chart-pie">

                        </i>
                        <p>
                            {{ trans('cruds.master.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('customer_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.customers.index") }}" class="nav-link {{ request()->is("customers") || request()->is("customers/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-user-friends">

                                </i>
                                <p>
                                    {{ trans('cruds.customer.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('vendor_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.vendors.index") }}" class="nav-link {{ request()->is("vendors") || request()->is("vendors/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fab fa-sellcast">

                                </i>
                                <p>
                                    {{ trans('cruds.vendor.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('company_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.companies.index") }}" class="nav-link {{ request()->is("companies") || request()->is("companies/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-building">

                                </i>
                                <p>
                                    {{ trans('cruds.company.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('term_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.terms.index") }}" class="nav-link {{ request()->is("admin/terms") || request()->is("admin/terms/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-terminal">

                                </i>
                                <p>
                                    {{ trans('cruds.term.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('account_type_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.account-types.index") }}" class="nav-link {{ request()->is("admin/account-types") || request()->is("admin/account-types/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-object-group">

                                </i>
                                <p>
                                    {{ trans('cruds.accountType.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('account_name_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.account-names.index") }}" class="nav-link {{ request()->is("admin/account-names") || request()->is("admin/account-names/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-file-invoice">

                                </i>
                                <p>
                                    {{ trans('cruds.accountName.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('setting_access')
                <li class="nav-item has-treeview {{ request()->is("admin/countries*") ? "menu-open" : "" }} {{ request()->is("admin/states*") ? "menu-open" : "" }} {{ request()->is("admin/cities*") ? "menu-open" : "" }} {{ request()->is("admin/departments*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-cogs">

                        </i>
                        <p>
                            {{ trans('cruds.setting.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('country_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.countries.index") }}" class="nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-flag">

                                </i>
                                <p>
                                    {{ trans('cruds.country.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('state_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.states.index") }}" class="nav-link {{ request()->is("admin/states") || request()->is("admin/states/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-map-marked">

                                </i>
                                <p>
                                    {{ trans('cruds.state.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('city_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.cities.index") }}" class="nav-link {{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-map-marker">

                                </i>
                                <p>
                                    {{ trans('cruds.city.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('department_access')
                        <li class="nav-item">
                            <a href="{{ route("frontend.departments.index") }}" class="nav-link {{ request()->is("admin/departments") || request()->is("admin/departments/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-bezier-curve">

                                </i>
                                <p>
                                    {{ trans('cruds.department.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('sale_access')
                <li class="nav-item has-treeview {{ request()->is("products*") ? "menu-open" : "" }} {{ request()->is("invoices*") ? "menu-open" : "" }} {{ request()->is("invoice-details*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-rupee-sign"></i>
                        <p>
                            {{ trans('cruds.sale.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                                        <a href="{{ route("frontend.invoices.all-invoices") }}" class="nav-link {{ request()->is("products") || request()->is("products/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-box">

                        </i>
                        <p>
                            All Invoices
                        </p>
                        </a>
                </li> --}}
                @can('product_access')
                <li class="nav-item">
                    <a href="{{ route("frontend.products.index") }}" class="nav-link {{ request()->is("products") || request()->is("products/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-box">

                        </i>
                        <p>
                            {{ trans('cruds.product.title') }}
                        </p>
                    </a>
                </li>
                @endcan
                @can('invoice_access')
                <li class="nav-item">
                    <a href="{{ route("frontend.invoices.index") }}" class="nav-link {{ request()->is("invoices") || request()->is("invoices/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-receipt">

                        </i>
                        <p>
                            {{ trans('cruds.invoice.title') }}
                        </p>
                    </a>
                </li>
                @endcan
                @can('invoice_detail_access')
                <li class="nav-item">
                    <a href="{{ route("frontend.invoice-details.index") }}" class="nav-link {{ request()->is("admin/invoice-details") || request()->is("admin/invoice-details/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-receipt"></i>
                        <p>
                            {{ trans('cruds.invoiceDetail.title') }}
                        </p>
                    </a>
                </li>
                @endcan
            </ul>
            </li>
            @endcan
            @can('task_management_access')
            <li class="nav-item has-treeview {{ request()->is("admin/task-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/task-tags*") ? "menu-open" : "" }} {{ request()->is("admin/tasks*") ? "menu-open" : "" }} {{ request()->is("admin/tasks-calendars*") ? "menu-open" : "" }} {{ request()->is("admin/assigned-tasks*") ? "menu-open" : "" }} {{ request()->is("admin/assigned-task-details*") ? "menu-open" : "" }}">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa-fw nav-icon fas fa-list"></i>
                    <p>
                        {{ trans('cruds.taskManagement.title') }}
                        <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('task_status_access')
                    <li class="nav-item">
                        <a href="{{ route("frontend.task-statuses.index") }}" class="nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-server">

                            </i>
                            <p>
                                {{ trans('cruds.taskStatus.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('task_tag_access')
                    <li class="nav-item">
                        <a href="{{ route("frontend.task-tags.index") }}" class="nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-server">

                            </i>
                            <p>
                                {{ trans('cruds.taskTag.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('task_access')
                    <li class="nav-item">
                        <a href="{{ route("frontend.tasks.index") }}" class="nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-briefcase">

                            </i>
                            <p>
                                {{ trans('cruds.task.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('tasks_calendar_access')
                    <li class="nav-item">
                        <a href="{{ route("frontend.tasks-calendars.index") }}" class="nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-calendar">

                            </i>
                            <p>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('assigned_task_access')
                    <li class="nav-item">
                        <a href="{{ route("frontend.assigned-tasks.index") }}" class="nav-link {{ request()->is("admin/assigned-tasks") || request()->is("admin/assigned-tasks/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-tasks">

                            </i>
                            <p>
                                {{ trans('cruds.assignedTask.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('assigned_task_detail_access')
                    <li class="nav-item">
                        <a href="{{ route("frontend.assigned-task-details.index") }}" class="nav-link {{ request()->is("admin/assigned-task-details") || request()->is("admin/assigned-task-details/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-info-circle">

                            </i>
                            <p>
                                {{ trans('cruds.assignedTaskDetail.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                    <i class="fas fa-fw fa-calendar nav-icon">

                    </i>
                    <p>
                        {{ trans('global.systemCalendar') }}
                    </p>
                </a>
            </li>
            @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="nav-item">
                            <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
            <i class="fa-fw fa fa-envelope nav-icon">

            </i>
            <p>{{ trans('global.messages') }}</p>
            @if($unread > 0)
            <strong>( {{ $unread }} )</strong>
            @endif

            </a>
            </li>
            @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
            <li class="nav-item">
                <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }} nav-link" href="{{ route("admin.team-members.index") }}">
                    <i class="fa-fw fa fa-users nav-icon">
                    </i>
                    <p>
                        {{ trans("global.team-members") }}
                    </p>
                </a>
            </li>
            @endif
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                    <i class="fa-fw fas fa-key nav-icon">
                    </i>
                    <p>
                        {{ trans('global.change_password') }}
                    </p>
                </a>
            </li>
            @endcan
            @endif
            <li class="nav-item" style="pointer-events: auto">
                <a class="{{ request()->is("frontend/profile") || request()->is("frontend/profile") ? "active" : "" }} nav-link" href="{{ route("frontend.profile.edit") }}">
                    <i class="fa-fw fa fa-users nav-icon">
                    </i>
                    <p>
                        Profile
                    </p>
                </a>
            </li>
            <li class="nav-item" style="pointer-events: auto">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <p>
                        <i class="fas fa-fw fa-sign-out-alt nav-icon">

                        </i>
                        <p>{{ trans('global.logout') }}</p>
                    </p>
                </a>
            </li>
            </ul>
        </nav>
        @endif
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>