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
    $this->addOption('active', 'in:true,false,both', 'both');

    if (!$query = $this->getQuery()) {
      return $this->error();
    }

    // $employees = Employee::with('structures','entries');
    $employees = Employee::query();

    if (isset($query['combined']['_id'])) {
      $employees = $employees->where(['_id' => $query['combined']['_id']]);
    }

    if (isset($query['combined']['active']) && $query['combined']['active'] !== 'both') {
      if ($query['combined']['active'] === 'true') {
        $employees = $employees->where(['active' => true]);
      } else {
        $employees = $employees->where(['active' => false]);
      }
    }

    $employees = $employees->paginate(10);
    $this->addPaginate($employees);

    return $this->render($employees->items(),false);

  }

}
