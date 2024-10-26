<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Customers
    Route::post('customers/media', 'CustomersApiController@storeMedia')->name('customers.storeMedia');
    Route::apiResource('customers', 'CustomersApiController');

    // Vendor
    Route::apiResource('vendors', 'VendorApiController');

    // Product
    Route::apiResource('products', 'ProductApiController');

    // Invoices
    Route::apiResource('invoices', 'InvoicesApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Department
    Route::apiResource('departments', 'DepartmentApiController');

    // Company
    Route::post('companies/media', 'CompanyApiController@storeMedia')->name('companies.storeMedia');
    Route::apiResource('companies', 'CompanyApiController');

    // Invoice Details
    Route::apiResource('invoice-details', 'InvoiceDetailsApiController');

    // Assigned Task
    Route::post('assigned-tasks/media', 'AssignedTaskApiController@storeMedia')->name('assigned-tasks.storeMedia');
    Route::apiResource('assigned-tasks', 'AssignedTaskApiController');

    // Assigned Task Details
    Route::apiResource('assigned-task-details', 'AssignedTaskDetailsApiController');

    // Terms
    Route::apiResource('terms', 'TermsApiController');

    // Groups
    Route::apiResource('groups', 'GroupsApiController');

    // User Addresses
    Route::apiResource('user-addresses', 'UserAddressesApiController');

    // Account Type
    Route::apiResource('account-types', 'AccountTypeApiController');

    // Account Name
    Route::apiResource('account-names', 'AccountNameApiController');
});
