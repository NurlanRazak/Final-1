array('employees.emp_no','employees.first_name','employees.last_name','departments.dept_name','employees.birth_date','employees.gender','employees.hire_date')


      return datatables()->query(DB::table('employees')->join('dept_emp','dept_emp.emp_no','=','employees.emp_no')->join('departments','departments.dept_no','=','dept_emp.dept_no')->get([DB::raw('employees.emp_no'),DB::raw('employees.first_name'),DB::raw('employees.last_name'),DB::raw('departments.dept_name'),DB::raw('employees.birth_date'),DB::raw('employees.gender'),DB::raw('employees.hire_date')]))->toJson();
employees.emp_no,