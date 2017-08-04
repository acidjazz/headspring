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

    // $employees = $employees->orderBy('updated_at', 'desc');
    // $employees = $employees->orderBy('_id', 'desc');
    $employees = $employees->paginate(10);
    $this->addPaginate($employees);

    return $this->render($employees->items(),false);

  }

  public function modify(Request $request)
  {

    $this->addOption('firstname', 'required|string');
    $this->addOption('lastname', 'required|string');
    $this->addOption('email', 'required|email');
    $this->addOption('title', 'required|string');
    $this->addOption('address.street', 'required|string');
    $this->addOption('address.city', 'required|string');
    $this->addOption('address.state', 'required|string');
    $this->addOption('address.zip', 'required|string');

    if (!$query = $this->getQuery()) {
      return $this->error();
    }

    $employee = new Employee();
    foreach ($query['combined'] as $key=>$value) {
      $employee->$key = $value;
    }

    $employee->save();

    return $this->render(['status' => 'Employee added successfully', '_id' => $employee->_id]);
  }

}
