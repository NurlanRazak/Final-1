<?php

namespace App\Http\Controllers;
use App\DataTables\EmpDataTable;
use Yajra\DataTables\DataTables; 
use Illuminate\Http\Request;
use App\departments;
use App\dept_emp;
use App\employees;
use DB;
use App\Charts\SampleChart;
class MainController extends Controller
{
     

    public function showEmployees(){
      $employee=DB::table('employees')->count();
      $department=DB::table('departments')->count();
      $dept_m=DB::table('dept_manager')->count();
      /*$dept_name=DB::select(DB::raw("select count(departments.dept_name) from dept_emp join employees on employees.emp_no = dept_emp.emp_no join departments on departments.dept_no = dept_emp.dept_no where to_date = '9999-01-01' group by dept_name"));*/

      return view('index',['employee'=>$employee,'department'=>$department,'dept_m'=>$dept_m]);
    }
       public function index(){
        return view('tables');
      }
       public function showChart(){
         $showChart=DB::table('dept_emp')->leftjoin('employees','dept_emp.emp_no','=','employees.emp_no')->join('departments','departments.dept_no','=','dept_emp.dept_no')->where('to_date','=','9999-01-01')->groupBy('departments.dept_name')->get([ DB::raw('departments.dept_name'),DB::raw('COUNT(departments.dept_name) as value')])->toJson();
         return $showChart;
      }
      public function showSalary(){
        $salary=DB::table('employees')->leftjoin('salaries','employees.emp_no','salaries.emp_no')->join('titles','employees.emp_no','=','titles.emp_no')->join('dept_manager','dept_manager.emp_no','=','employees.emp_no')->join('departments','departments.dept_no','=','dept_manager.dept_no')->where('titles.title','=','Manager')->where('salaries.to_date','=','9999-01-01')->groupBy('departments.dept_name')->get([DB::raw('departments.dept_name'),DB::raw('MAX(salaries.salary) as value')])->toJson();
        return $salary;
         
      }
         public function countGender(){
        $gender=DB::table('employees')->groupBy('employees.gender')->get([DB::raw('employees.gender'),DB::raw('COUNT(employees.emp_no) as count')])->toArray();
        $json_data=array();  
        foreach($gender as $rec)  
         {  
          $json_array['label']=$rec->gender;  
          $json_array['value']=(($rec->count)*100)/300024;  
          array_push($json_data,$json_array);  
         }  
         return $json_data;
         
      }
      public function amountTitles(){
        $json_amount=DB::table('titles')->leftjoin('employees','employees.emp_no','=','titles.emp_no')->where('titles.to_date','=','9999-01-01')->groupBy('titles.title')->get([DB::raw('titles.title'),DB::raw('COUNT(titles.title) as amount')])->toJson();  
   
          return $json_amount; 

      }
       public function getEmployee(){
        $table=DB::table(DB::raw('employees'))->select(DB::raw('employees.emp_no,employees.first_name,employees.last_name,departments.dept_name,employees.birth_date,employees.gender,employees.hire_date'))->leftjoin('dept_emp','dept_emp.emp_no','=','employees.emp_no')->leftjoin('departments','departments.dept_no','=','dept_emp.dept_no');


            return Datatables::of($table)->make(true);
      }
      /*public function index(EmpDataTable $dataTable){
        $table=DB::table('employees')->join('dept_emp','dept_emp.emp_no','=','employees.emp_no')->join('departments','departments.dept_no','=','dept_emp.dept_no')->get();
            return Datatables::queryBuilder($table)->make(true);
      }*/
}
