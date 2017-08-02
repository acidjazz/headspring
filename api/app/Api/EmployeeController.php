<?php

namespace App\Api;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends MetApiController {

  public function __construct(Request $request)
  {
    parent::__construct($request);
  }

  public function get(Request $request)
  {

    $this->addOption('_id', 'regex:/[0-9a-fA-F]{24}/');

    if (!$query = $this->getQuery()) {
      return $this->error();
    }

    // $employees = Employee::with('structures','entries');
    $employees = Employee::query();

    if (isset($query['combined']['_id'])) {
      $employees = $employees->where(['_id' => $query['combined']['_id']]);
    }

    $employees = $employees->paginate(20);
    $this->addPaginate($employees);

    return $this->render($employees->items(),false);

  }

}
