@extends('layouts.master')
@section('css')

@section('title')
{{ trans('main_trans.Grades list') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('Grades_trans.Grades list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ trans('Grades_trans.Grades list') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">   
    <div class="col-xl-12 mb-30">     
      <div class="card card-statistics h-100"> 
        <div class="card-body">
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('Grades_trans.Name') }}</th>
                    <th>{{ trans('Grades_trans.Notes') }}</th>
                    <th>{{ trans('Grades_trans.Processes') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($collection as $item)
                    
                @endforeach
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td> 
                </tr>  
            </tbody>            
         </table>
        </div>
        </div>
      </div>   
    </div>
</div> 
<!-- row closed -->
@endsection
@section('js')

@endsection
