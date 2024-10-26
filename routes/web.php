<?php
use App\Http\Controllers\Admin\CompanyController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'auth/login');

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'leleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Customers
    Route::delete('customers/destroy', 'CustomersController@massDestroy')->name('customers.massDestroy');
    Route::post('customers/media', 'CustomersController@storeMedia')->name('customers.storeMedia');
    Route::get('get-customers', 'CustomersController@getCustomers')->name('get-customers');
    
    Route::get('get-groups', 'CustomersController@getGroups')->name('get-groups');
    Route::get('customers/gst', 'CustomersController@gst')->name('customers.gst');
    Route::post('customers/store-customer', 'CustomersController@storeCustomer')->name('store-customer');
    Route::post('customers/ckmedia', 'CustomersController@storeCKEditorImages')->name('customers.storeCKEditorImages');
    Route::post('customers/parse-csv-import', 'CustomersController@parseCsvImport')->name('customers.parseCsvImport');
    Route::post('customers/process-csv-import', 'CustomersController@processCsvImport')->name('customers.processCsvImport');
    Route::resource('customers', 'CustomersController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // States
    Route::delete('states/destroy', 'StatesController@massDestroy')->name('states.massDestroy');
    Route::post('states/parse-csv-import', 'StatesController@parseCsvImport')->name('states.parseCsvImport');
    Route::post('states/process-csv-import', 'StatesController@processCsvImport')->name('states.processCsvImport');
    Route::resource('states', 'StatesController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::get('get-city', 'CitiesController@getCity')->name('get-city');
    Route::post('cities/parse-csv-import', 'CitiesController@parseCsvImport')->name('cities.parseCsvImport');
    Route::post('cities/process-csv-import', 'CitiesController@processCsvImport')->name('cities.processCsvImport');
    Route::resource('cities', 'CitiesController');

    // Vendor
    Route::delete('vendors/destroy', 'VendorController@massDestroy')->name('vendors.massDestroy');
    Route::post('vendors/parse-csv-import', 'VendorController@parseCsvImport')->name('vendors.parseCsvImport');
    Route::post('vendors/process-csv-import', 'VendorController@processCsvImport')->name('vendors.processCsvImport');
    Route::resource('vendors', 'VendorController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::get('get-products', 'ProductController@getProduct')->name('get-products');
    Route::get('products-store', 'ProductController@productStore')->name('products-store');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductController');

    // Gst
    Route::resource('gst', 'GSTController');

    // Invoices
    Route::delete('invoices/destroy', 'InvoicesController@massDestroy')->name('invoices.massDestroy');
    Route::post('invoices/parse-csv-import', 'InvoicesController@parseCsvImport')->name('invoices.parseCsvImport');
    Route::post('invoices/process-csv-import', 'InvoicesController@processCsvImport')->name('invoices.processCsvImport');
    Route::get('invoices/all-invoices', 'InvoicesController@allInvoices')->name('invoices.all-invoices');
    Route::get('invoices/pdf', 'InvoicesController@pdf')->name('invoices.pdf');
    Route::get('invoices/accept_invoice_request', 'InvoicesController@accept_invoice_request')->name('invoices.accept_invoice_request');
    Route::get('invoices/products', 'InvoicesController@products')->name('invoices.products');
    Route::get('invoices/get-companies', 'InvoicesController@getCompanies')->name('invoices.get-companies');
    Route::get('invoices/get-invoice', 'InvoicesController@getInvoice')->name('invoices.get-invoice');
    Route::get('invoices/get-product_detail', 'InvoicesController@getProductDetail')->name('invoices.get-product_detail');
    Route::get('invoices/get-customer-by-id', 'InvoicesController@getCustomer')->name('invoices.get-customer-by-id');
    Route::post('invoices/create/group-add', 'InvoicesController@addgroup')->name('invoices.addgroup');
    Route::get('invoices/get-customfields', 'InvoicesController@getCustomFields')->name('invoices.get-customfields');
    Route::get('invoices/count-customfields', 'InvoicesController@countCustomFields')->name('invoices.count-customfields');
    Route::get('invoices/edit-customfields', 'InvoicesController@editCustomFields')->name('invoices.edit-customfields');
    Route::get('invoices/get-inactive-customfields', 'InvoicesController@getAllInactiveCustomField')->name('invoices.get-inactivecustomfields');
    Route::get('invoices/get-review-products', 'InvoicesController@getReviewProducts')->name('invoices.get-review-products');
    Route::post('invoices/update-review-products', 'InvoicesController@getUpdateReviewProducts')->name('invoices.update-review-products');
    Route::resource('invoices', 'InvoicesController');

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::post('tasks/parse-csv-import', 'TaskController@parseCsvImport')->name('tasks.parseCsvImport');
    Route::post('tasks/process-csv-import', 'TaskController@processCsvImport')->name('tasks.processCsvImport');
    Route::get('tasks/get-funcation','TaskController@getFuncation')->name('tasks.get-funcation');
    Route::post('tasks/assigned-task-employee', 'TaskController@assignedTaskEmployee')->name('tasks.assigned-task-employee');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Department
    Route::delete('departments/destroy', 'DepartmentController@massDestroy')->name('departments.massDestroy');
    Route::post('departments/parse-csv-import', 'DepartmentController@parseCsvImport')->name('departments.parseCsvImport');
    Route::post('departments/process-csv-import', 'DepartmentController@processCsvImport')->name('departments.processCsvImport');
    Route::resource('departments', 'DepartmentController');

    // DepartmentFuncations
    Route::resource('department_funcations','DepartmentFuncationController');

    // Company
    Route::delete('companies/destroy', 'CompanyController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompanyController@storeMedia')->name('companies.storeMedia');
    Route::post('companies/ckmedia', 'CompanyController@storeCKEditorImages')->name('companies.storeCKEditorImages');
    Route::post('companies/parse-csv-import', 'CompanyController@parseCsvImport')->name('companies.parseCsvImport');
    Route::post('companies/process-csv-import', 'CompanyController@processCsvImport')->name('companies.processCsvImport');
    Route::get('companies/get-role','CompanyController@getRole')->name('companies.get-role');
    Route::get('companies/store-user','CompanyController@storeUser')->name('companies.store-user');
    Route::get('companies/gstin-check','CompanyController@checkGstin')->name('companies.check-gstin');
    Route::get('companies/comp_name-check','CompanyController@checkCompanyName')->name('companies.check-comp_name');
    Route::get('companies/get-city','CompanyController@getCity')->name('companies.get-city');


    Route::get('companies/store-team-user','CompanyController@storeTeamUser')->name('companies.store-team-user');
    Route::get('companies/get-user-ajax','CompanyController@getUserAjax')->name('companies.get-user-ajax');
    Route::get('companies/get-team-user-ajax','CompanyController@getTeamUserAjax')->name('companies.get-team-user-ajax');

    Route::get('companies/setpassword-user/{token}', 'CompanyController@setPasswordPage');
    Route::post('companies/user-setpassword/store', 'CompanyController@userSetPassword')->name('companies.user-setpassword-store');
    Route::get('search-companies','CompanyController@searchCompany')->name('companies.search-companies');
    Route::get('search-isEmpty-companies','CompanyController@searchIsEmptyCompany')->name('companies.search-isEmpty-companies');
    Route::get('remove-owner','CompanyController@removeOwner')->name('companies.remove-owner');
    Route::get('restore-company','CompanyController@restore')->name('companies.restore');

    Route::resource('companies', 'CompanyController');

    // Invoice Details
    Route::delete('invoice-details/destroy', 'InvoiceDetailsController@massDestroy')->name('invoice-details.massDestroy');
    Route::post('invoice-details/parse-csv-import', 'InvoiceDetailsController@parseCsvImport')->name('invoice-details.parseCsvImport');
    Route::post('invoice-details/process-csv-import', 'InvoiceDetailsController@processCsvImport')->name('invoice-details.processCsvImport');
    Route::resource('invoice-details', 'InvoiceDetailsController');

    // Assigned Task
    Route::delete('assigned-tasks/destroy', 'AssignedTaskController@massDestroy')->name('assigned-tasks.massDestroy');
    Route::post('assigned-tasks/media', 'AssignedTaskController@storeMedia')->name('assigned-tasks.storeMedia');
    Route::post('assigned-tasks/ckmedia', 'AssignedTaskController@storeCKEditorImages')->name('assigned-tasks.storeCKEditorImages');
    Route::post('assigned-tasks/parse-csv-import', 'AssignedTaskController@parseCsvImport')->name('assigned-tasks.parseCsvImport');
    Route::post('assigned-tasks/process-csv-import', 'AssignedTaskController@processCsvImport')->name('assigned-tasks.processCsvImport');
    Route::get('assigned-tasks/agents', 'AssignedTaskController@agents')->name('assigned-tasks.agents');
    Route::get('assigned-tasks/users', 'AssignedTaskController@users')->name('assigned-tasks.users');
    Route::get('assigned-tasks/get-customer', 'AssignedTaskController@getCustomer')->name('assigned-tasks.get-customer');
    Route::post('assigned-tasks/update-customer', 'AssignedTaskController@customerUpdate')->name('assigned-tasks.update-customer');

    Route::post('assigned-tasks/tracker', 'AssignedTaskController@tracker')->name('assigned-tasks.tracker');
    Route::resource('assigned-tasks', 'AssignedTaskController');
    
    // Assigned Task Details
    Route::delete('assigned-task-details/destroy', 'AssignedTaskDetailsController@massDestroy')->name('assigned-task-details.massDestroy');
    Route::resource('assigned-task-details', 'AssignedTaskDetailsController');

    // Terms Andcondition
    Route::delete('terms-andconditions/destroy', 'TermsAndconditionController@massDestroy')->name('terms-andconditions.massDestroy');
    Route::post('terms-andconditions/media', 'TermsAndconditionController@storeMedia')->name('terms-andconditions.storeMedia');
    Route::get('get-termCondition', 'TermsAndconditionController@getTermCondition')->name('get-termCondition');
    Route::get('store-termCondition', 'TermsAndconditionController@storeTermCondition')->name('store-termCondition');
    Route::post('terms-andconditions/ckmedia', 'TermsAndconditionController@storeCKEditorImages')->name('terms-andconditions.storeCKEditorImages');
    Route::post('terms-andconditions/parse-csv-import', 'TermsAndconditionController@parseCsvImport')->name('terms-andconditions.parseCsvImport');
    Route::post('terms-andconditions/process-csv-import', 'TermsAndconditionController@processCsvImport')->name('terms-andconditions.processCsvImport');
    Route::resource('terms-andconditions', 'TermsAndconditionController');

    // Terms
    Route::delete('terms/destroy', 'TermsController@massDestroy')->name('terms.massDestroy');
    Route::get('term-store', 'TermsController@termStore')->name('term-store');
    Route::get('get-terms', 'TermsController@getTerms')->name('get-terms');
    Route::post('terms/parse-csv-import', 'TermsController@parseCsvImport')->name('terms.parseCsvImport');
    Route::post('terms/process-csv-import', 'TermsController@processCsvImport')->name('terms.processCsvImport');
    Route::resource('terms', 'TermsController');

    // Groups
    Route::delete('groups/destroy', 'GroupsController@massDestroy')->name('groups.massDestroy');
    Route::get('groups/store', 'GroupsController@groupStore')->name('group-store');
    Route::resource('groups', 'GroupsController');

    // User Addresses
    Route::delete('user-addresses/destroy', 'UserAddressesController@massDestroy')->name('user-addresses.massDestroy');
    Route::resource('user-addresses', 'UserAddressesController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Account Type
    Route::delete('account-types/destroy', 'AccountTypeController@massDestroy')->name('account-types.massDestroy');
    Route::get('get-account-types', 'AccountTypeController@getaccountType')->name('get-account-types');
    Route::get('account-types-store', 'AccountTypeController@accountTypeStore')->name('account-types-store');
    Route::resource('account-types', 'AccountTypeController');

    // Account Name
    Route::delete('account-names/destroy', 'AccountNameController@massDestroy')->name('account-names.massDestroy');
    Route::get('get-account-names', 'AccountNameController@getAccountName')->name('get-account-names');
    Route::get('account-names-store', 'AccountNameController@accountNameStore')->name('account-names-store');
    Route::resource('account-names', 'AccountNameController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
    Route::get('get-category', 'CategoryController@getCategory')->name('get-category');
    Route::get('category-store', 'CategoryController@categoryStore')->name('category-store');
    Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
    Route::post('categories/parse-csv-import', 'CategoryController@parseCsvImport')->name('categories.parseCsvImport');
    Route::post('categories/process-csv-import', 'CategoryController@processCsvImport')->name('categories.processCsvImport');
    Route::resource('categories', 'CategoryController');

    // Sub Task
    Route::delete('sub-tasks/destroy', 'SubTaskController@massDestroy')->name('sub-tasks.massDestroy');
    Route::post('sub-tasks/media', 'SubTaskController@storeMedia')->name('sub-tasks.storeMedia');
    Route::post('sub-tasks/ckmedia', 'SubTaskController@storeCKEditorImages')->name('sub-tasks.storeCKEditorImages');
    Route::post('sub-tasks/parse-csv-import', 'SubTaskController@parseCsvImport')->name('sub-tasks.parseCsvImport');
    Route::post('sub-tasks/process-csv-import', 'SubTaskController@processCsvImport')->name('sub-tasks.processCsvImport');
    Route::get('sub-tasks/create-subtasks', 'SubTaskController@createSubTasks')->name('sub-tasks.create-subtasks');
    Route::post('sub-tasks/store-subtasks', 'SubTaskController@storeSubTasks')->name('sub-tasks.store-subtasks');
    Route::get('sub-tasks/edit-subtasks', 'SubTaskController@editSubTasks')->name('sub-tasks.edit-subtasks');
    Route::post('sub-tasks/update-subtasks', 'SubTaskController@updateSubTasks')->name('sub-tasks.update-subtasks');
    Route::get('sub-tasks/show-subtasks', 'SubTaskController@showSubTasks')->name('sub-tasks.show-subtasks');
    Route::resource('sub-tasks', 'SubTaskController');

    // Assigned Sub Task
    Route::delete('assigned-sub-tasks/destroy', 'AssignedSubTaskController@massDestroy')->name('assigned-sub-tasks.massDestroy');
    Route::post('assigned-sub-tasks/media', 'AssignedSubTaskController@storeMedia')->name('assigned-sub-tasks.storeMedia');
    Route::post('assigned-sub-tasks/ckmedia', 'AssignedSubTaskController@storeCKEditorImages')->name('assigned-sub-tasks.storeCKEditorImages');
    Route::post('assigned-sub-tasks/parse-csv-import', 'AssignedSubTaskController@parseCsvImport')->name('assigned-sub-tasks.parseCsvImport');
    Route::post('assigned-sub-tasks/process-csv-import', 'AssignedSubTaskController@processCsvImport')->name('assigned-sub-tasks.processCsvImport');
    Route::post('assigned-sub-tasks/tracker', 'AssignedSubTaskController@tracker')->name('assigned-sub-tasks.tracker');
    Route::resource('assigned-sub-tasks', 'AssignedSubTaskController');

    // Assigned Sub Task Details
    Route::delete('assigned-sub-task-details/destroy', 'AssignedSubTaskDetailsController@massDestroy')->name('assigned-sub-task-details.massDestroy');
    Route::resource('assigned-sub-task-details', 'AssignedSubTaskDetailsController');

    // Messangers and Calender
    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
    
    //custom_fields
    Route::resource('customfields', 'CustomFieldController');
    Route::post('customfields/inactive-field', 'CustomFieldController@inactiveCustomField')->name('customfields.inactivefield');
    
    //company custom fields
    Route::resource('company_custom_fields', 'CompanyCustomFieldsController');


    //Invoice Customization
    Route::get('invoice-customize/template','InvoiceCustomizeController@templateSet')->name('invoiceCustomize.templateSet');
    Route::get('invoice-customize/email_tab','InvoiceCustomizeController@emailTabSet')->name('invoiceCustomize.emailTabSet');
    Route::get('invoice-customize/all_template_listing','InvoiceCustomizeController@allTemplateListing')->name('invoiceCustomize.allTemplateListing');
    Route::get('invoice-customize/get_template_by_id','InvoiceCustomizeController@edit')->name('invoiceCustomizeTemplate.edit');
    Route::get('invoice-customize/delete_template_by_id','InvoiceCustomizeController@destroy')->name('invoiceCustomizeTemplate.destroy');
    Route::post('invoice-customize/update_template_by_id','InvoiceCustomizeController@update')->name('invoiceCustomizeTemplate.update');
    Route::post('invoice-customize/store/template','InvoiceCustomizeController@store')->name('invoiceCustomize.store');
    Route::post('invoice-customize/save-template-content', 'InvoiceCustomizeController@templateContentSave')->name('invoiceCustomize.save-template-content');
    Route::post('invoice-customize/save-email-content', 'InvoiceCustomizeController@emailContentSave')->name('invoiceCustomize.save-email-content');
    Route::post('invoice-customize/update-template-content', 'InvoiceCustomizeController@templateContentUpdate')->name('invoiceCustomize.update-template-content');
    Route::get('invoice-customize/template-properties', 'InvoiceCustomizeController@templateProperies')->name('invoiceCustomize.template-properties');
    Route::get('invoice-customize/email-content-properties', 'InvoiceCustomizeController@emailContentProperies')->name('invoiceCustomize.email-content-properties');
    Route::resource('invoice-customize', 'InvoiceCustomizeController');
               
    //Conpany department head
    Route::resource('department-head','DepartmentHeadController');
    
    //Manage task according the department and company
    Route::resource('manage-task','ManageTaskController');

    //Customer approval routes
    Route::resource('customer-approval','CustomerApprovalController');
    
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth','user']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Customers
    Route::delete('customers/destroy', 'CustomersController@massDestroy')->name('customers.massDestroy');
    Route::post('customers/media', 'CustomersController@storeMedia')->name('customers.storeMedia');
    Route::get('get-customers', 'CustomersController@getCustomers')->name('get-customers');
    Route::get('get-groups', 'CustomersController@getGroups')->name('get-groups');
    Route::get('customers/gst', 'CustomersController@gst')->name('customers.gst');
    Route::get('customers/store-customer', 'CustomersController@storeCustomer')->name('store-customer');
    Route::post('customers/ckmedia', 'CustomersController@storeCKEditorImages')->name('customers.storeCKEditorImages');
    Route::resource('customers', 'CustomersController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // States
    Route::delete('states/destroy', 'StatesController@massDestroy')->name('states.massDestroy');
    Route::resource('states', 'StatesController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::get('get-city', 'CitiesController@getCity')->name('get-city');
    Route::get('part-city', 'CitiesController@getParticularCity')->name('part-city');
    Route::resource('cities', 'CitiesController');

    // Vendor
    Route::delete('vendors/destroy', 'VendorController@massDestroy')->name('vendors.massDestroy');
    Route::resource('vendors', 'VendorController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::get('get-products', 'ProductController@getProduct')->name('get-products');
    Route::get('products-store', 'ProductController@productStore')->name('products-store');
    Route::resource('products', 'ProductController');

    // Invoices
    Route::delete('invoices/destroy', 'InvoicesController@massDestroy')->name('invoices.massDestroy');
    Route::get('invoices/all-invoices', 'InvoicesController@allInvoices')->name('invoices.all-invoices');
    Route::get('invoices/accept_invoice_request', 'InvoicesController@accept_invoice_request')->name('invoices.accept_invoice_request');
    Route::get('invoices/pdf', 'InvoicesController@pdf')->name('invoices.pdf');
    Route::resource('invoices', 'InvoicesController');

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Department
    Route::delete('departments/destroy', 'DepartmentController@massDestroy')->name('departments.massDestroy');
    Route::resource('departments', 'DepartmentController');

    // Company
    Route::delete('companies/destroy', 'CompanyController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompanyController@storeMedia')->name('companies.storeMedia');
    Route::post('companies/ckmedia', 'CompanyController@storeCKEditorImages')->name('companies.storeCKEditorImages');
    Route::resource('companies', 'CompanyController');

    // Invoice Details
    Route::delete('invoice-details/destroy', 'InvoiceDetailsController@massDestroy')->name('invoice-details.massDestroy');
    Route::resource('invoice-details', 'InvoiceDetailsController');

    // Assigned Task
    Route::delete('assigned-tasks/destroy', 'AssignedTaskController@massDestroy')->name('assigned-tasks.massDestroy');
    Route::post('assigned-tasks/media', 'AssignedTaskController@storeMedia')->name('assigned-tasks.storeMedia');
    Route::post('assigned-tasks/ckmedia', 'AssignedTaskController@storeCKEditorImages')->name('assigned-tasks.storeCKEditorImages');
    Route::resource('assigned-tasks', 'AssignedTaskController');

    // Assigned Task Details
    Route::delete('assigned-task-details/destroy', 'AssignedTaskDetailsController@massDestroy')->name('assigned-task-details.massDestroy');
    Route::resource('assigned-task-details', 'AssignedTaskDetailsController');

    // Terms
    Route::delete('terms/destroy', 'TermsController@massDestroy')->name('terms.massDestroy');
    Route::get('term-store', 'TermsController@termStore')->name('term-store');
    Route::get('get-terms', 'TermsController@getTerms')->name('get-terms');
    Route::resource('terms', 'TermsController');

    // Groups
    Route::delete('groups/destroy', 'GroupsController@massDestroy')->name('groups.massDestroy');
    Route::get('groups/store', 'GroupsController@groupStore')->name('group-store');
    Route::resource('groups', 'GroupsController');

    // User Addresses
    Route::delete('user-addresses/destroy', 'UserAddressesController@massDestroy')->name('user-addresses.massDestroy');
    Route::resource('user-addresses', 'UserAddressesController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Account Type
    Route::delete('account-types/destroy', 'AccountTypeController@massDestroy')->name('account-types.massDestroy');
    Route::get('get-account-types', 'AccountTypeController@getaccountType')->name('get-account-types');
    Route::get('account-types-store', 'AccountTypeController@accountTypeStore')->name('account-types-store');
    Route::resource('account-types', 'AccountTypeController');

    // Account Name
    Route::delete('account-names/destroy', 'AccountNameController@massDestroy')->name('account-names.massDestroy');
    Route::get('get-account-names', 'AccountNameController@getAccountName')->name('get-account-names');
    Route::get('account-names-store', 'AccountNameController@accountNameStore')->name('account-names-store');
    Route::resource('account-names', 'AccountNameController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
    Route::get('get-category', 'CategoryController@getCategory')->name('get-category');
    Route::get('category-store', 'CategoryController@categoryStore')->name('category-store');
    Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
    Route::post('categories/parse-csv-import', 'CategoryController@parseCsvImport')->name('categories.parseCsvImport');
    Route::post('categories/process-csv-import', 'CategoryController@processCsvImport')->name('categories.processCsvImport');
    Route::resource('categories', 'CategoryController');

    // Sub Task
    Route::delete('sub-tasks/destroy', 'SubTaskController@massDestroy')->name('sub-tasks.massDestroy');
    Route::post('sub-tasks/media', 'SubTaskController@storeMedia')->name('sub-tasks.storeMedia');
    Route::post('sub-tasks/ckmedia', 'SubTaskController@storeCKEditorImages')->name('sub-tasks.storeCKEditorImages');
    Route::post('sub-tasks/parse-csv-import', 'SubTaskController@parseCsvImport')->name('sub-tasks.parseCsvImport');
    Route::post('sub-tasks/process-csv-import', 'SubTaskController@processCsvImport')->name('sub-tasks.processCsvImport');
    Route::resource('sub-tasks', 'SubTaskController');
    
    // Assigned Sub Task
    Route::delete('assigned-sub-tasks/destroy', 'AssignedSubTaskController@massDestroy')->name('assigned-sub-tasks.massDestroy');
    Route::post('assigned-sub-tasks/media', 'AssignedSubTaskController@storeMedia')->name('assigned-sub-tasks.storeMedia');
    Route::post('assigned-sub-tasks/ckmedia', 'AssignedSubTaskController@storeCKEditorImages')->name('assigned-sub-tasks.storeCKEditorImages');
    Route::post('assigned-sub-tasks/parse-csv-import', 'AssignedSubTaskController@parseCsvImport')->name('assigned-sub-tasks.parseCsvImport');
    Route::post('assigned-sub-tasks/process-csv-import', 'AssignedSubTaskController@processCsvImport')->name('assigned-sub-tasks.processCsvImport');
    Route::resource('assigned-sub-tasks', 'AssignedSubTaskController');

    // Terms Andcondition
    Route::delete('terms-andconditions/destroy', 'TermsAndconditionController@massDestroy')->name('terms-andconditions.massDestroy');
    Route::get('get-termCondition', 'TermsAndconditionController@getTermCondition')->name('get-termCondition');
    Route::get('store-termCondition', 'TermsAndconditionController@storeTermCondition')->name('store-termCondition');
    Route::post('terms-andconditions/media', 'TermsAndconditionController@storeMedia')->name('terms-andconditions.storeMedia');
    Route::post('terms-andconditions/ckmedia', 'TermsAndconditionController@storeCKEditorImages')->name('terms-andconditions.storeCKEditorImages');
    Route::resource('terms-andconditions', 'TermsAndconditionController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::match(['GET','POST'],'profile', 'ProfileController@edit')->name('profile.edit');
    Route::post('storeStep1', 'ProfileController@storeStep1')->name('profile.storeStep1');
    Route::post('storeStep2', 'ProfileController@storeStep2')->name('profile.storeStep2');
    Route::get('frontend/profile/step2', 'ProfileController@step2')->name('profile.step2');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});

    Route::get('customer/login', 'Customer\LoginController@index');
    Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer', 'middleware' => ['auth']], function () {
    Route::get('home', 'HomeController@index')->name('home');

        // Invoices
        Route::delete('invoices/destroy', 'InvoicesController@massDestroy')->name('invoices.massDestroy');
        Route::post('invoices/parse-csv-import', 'InvoicesController@parseCsvImport')->name('invoices.parseCsvImport');
        Route::post('invoices/process-csv-import', 'InvoicesController@processCsvImport')->name('invoices.processCsvImport');
        Route::get('invoices/all-invoices', 'InvoicesController@allInvoices')->name('invoices.all-invoices');
        Route::get('invoices/pdf', 'InvoicesController@pdf')->name('invoices.pdf');
        Route::get('invoices/accept_invoice_request', 'InvoicesController@accept_invoice_request')->name('invoices.accept_invoice_request');
        Route::get('invoices/products', 'InvoicesController@products')->name('invoices.products');
        Route::get('invoices/get-companies', 'InvoicesController@getCompanies')->name('invoices.get-companies');
        Route::get('invoices/get-invoice', 'InvoicesController@getInvoice')->name('invoices.get-invoice');
        Route::get('invoices/get-product_detail', 'InvoicesController@getProductDetail')->name('invoices.get-product_detail');
        Route::get('invoices/get-customer-by-id', 'InvoicesController@getCustomer')->name('invoices.get-customer-by-id');
        Route::get('invoices/get-customfields', 'InvoicesController@getCustomFields')->name('invoices.get-customfields');
        Route::get('invoices/count-customfields', 'InvoicesController@countCustomFields')->name('invoices.count-customfields');
        Route::get('invoices/invoice-posted', 'InvoicesController@invoicePosted')->name('invoices.invoice-posted');
        Route::resource('invoices', 'InvoicesController');

        // Company
        Route::delete('companies/destroy', 'CompanyController@massDestroy')->name('companies.massDestroy');
        Route::post('companies/media', 'CompanyController@storeMedia')->name('companies.storeMedia');
        Route::post('companies/ckmedia', 'CompanyController@storeCKEditorImages')->name('companies.storeCKEditorImages');
        Route::post('companies/parse-csv-import', 'CompanyController@parseCsvImport')->name('companies.parseCsvImport');
        Route::post('companies/process-csv-import', 'CompanyController@processCsvImport')->name('companies.processCsvImport');
        Route::get('companies/get-role','CompanyController@getRole')->name('companies.get-role');
        Route::get('companies/store-user','CompanyController@storeUser')->name('companies.store-user');
        Route::get('companies/get-user-ajax','CompanyController@getUserAjax')->name('companies.get-user-ajax');
        Route::resource('companies', 'CompanyController');

        //Sub-Customer
    
        Route::delete('subcustomers/destroy', 'SubCustomerController@massDestroy')->name('subcustomers.massDestroy');
        Route::post('subcustomers/media', 'SubCustomerController@storeMedia')->name('subcustomers.storeMedia');
        Route::get('get-subcustomers', 'SubCustomerController@getSubCustomers')->name('get-subcustomers');
        Route::get('get-groups', 'SubCustomerController@getGroups')->name('get-groups');
        Route::post('store-groups', 'SubCustomerController@storeGroups')->name('store-groups');
        Route::get('subcustomers/gst', 'SubCustomerController@gst')->name('subcustomers.gst');
        Route::post('subcustomers/store-customer', 'SubCustomerController@storeCustomer')->name('store-subcustomer');
        Route::post('subcustomers/ckmedia', 'SubCustomerController@storeCKEditorImages')->name('subcustomers.storeCKEditorImages');
        Route::post('subcustomers/parse-csv-import', 'SubCustomerController@parseCsvImport')->name('subcustomers.parseCsvImport');
        Route::post('subcustomers/process-csv-import', 'SubCustomerController@processCsvImport')->name('subcustomers.processCsvImport');
        Route::resource('subcustomers', 'SubCustomerController');
    
        //Product&&services
        Route::delete('products/destroy', 'ProductServicesController@massDestroy')->name('products.massDestroy');
        Route::get('get-products', 'ProductServicesController@getProduct')->name('get-products');
        Route::get('products-store', 'ProductServicesController@productStore')->name('products-store');
        Route::post('products/parse-csv-import', 'ProductServicesController@parseCsvImport')->name('products.parseCsvImport');
        Route::post('products/process-csv-import', 'ProductServicesController@processCsvImport')->name('products.processCsvImport');
        Route::resource('products', 'ProductServicesController');

        //Payments for Invoices.
        Route::resource('payments', 'PaymentsController'); 
        Route::get('payment-destroy', 'PaymentsController@PaymentDelete')->name('payment.delete-payment');
        Route::post('payment-update', 'PaymentsController@PaymentUpdate')->name('payment.update-payment');
        // Route::post('assigned-tasks/update-customer', 'AssignedTaskController@customerUpdate')->name('assigned-tasks.update-customer');

        //Custom-Fields
        Route::resource('customfields', 'CustomFieldController');

        //Customer Team Management
        Route::resource('team','TeamManagementController');

        //Customer Team Head
        Route::get('team-head/get-team-members', 'TeamHeadController@getTeamMembers')->name('team-head.get-teams');
        Route::post('team-head/assigned-team-members', 'TeamHeadController@assignedTeamMembers')->name('team-head.assigned-team-members');
        Route::resource('team-head', 'TeamHeadController');

        //Bank-Details
        Route::resource('bank-details', 'BankDetailController');
   
});




