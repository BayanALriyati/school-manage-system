@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('My_Classes_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('My_Classes_trans.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-sm-6">
        <h4 class="mb-0"> {{ trans('My_Classes_trans.List_classes') }}</h4>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
            <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
            <li class="breadcrumb-item active">{{ trans('My_Classes_trans.List_classes') }}</li>
        </ol>
    </div>

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
    <div class="container text-center">
        <div class="row d-flex justify-content-between">
            <div class="d-flex justify-content-start">
                <div class="me-auto p-3">
                        <button type="button" class="btn-lg btn-success" data-toggle="modal" data-target="#exampleModal">
                            {{ trans('My_Classes_trans.add_class') }}
                        </button>
                </div>
                <div class="me-auto p-3">
                        <button type="button" class="btn-danger btn-lg" id="btn_delete_all" data-toggle="modal">
                            <i class="fa fa-trash"></i>
                            {{ trans('My_Classes_trans.delete_checkbox') }}
                        </button>
                </div>
            </div>
            <div class="me-auto p-3">
                    <form action="{{ route('Filter_Classes') }}" method="POST">
                      @csrf    
                      <select class="fancyselect form-select-lg mb-3" aria-label="Large select example" data-style="btn-info" name="Grade_id" required
                              onchange="this.form.submit()">
                          <option value="" selected disabled>{{ trans('My_Classes_trans.Search_By_Grade') }}</option>
                          @foreach ($Grades as $Grade)
                              <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                          @endforeach
                      </select>
                    </form>
                </div>
            </div>
        </div>
              
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr class="table-success">
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                            <th>#</th>
                            <th>{{ trans('My_Classes_trans.Name_class') }}</th>
                            <th>{{ trans('My_Classes_trans.Name_Grade') }}</th>
                            <th>{{ trans('My_Classes_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($details))

                            <?php $List_Classes = $details; ?>
                         @else

                            <?php $List_Classes = $My_Classes; ?>
                         @endif

                        <?php $i = 0; ?>
                        @foreach ($List_Classes as $My_Class)
                            <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $My_Class->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{ $My_Class->Name_class }}</td>
                                <td>{{ $My_Class->Grades->Name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $My_Class->id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $My_Class->id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('My_Classes_trans.edit_class') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- edit_form -->
                                            <form action="{{ route('Classrooms.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name"
                                                               class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                                            :</label>
                                                        <input id="Name" type="text" name="Name"
                                                               class="form-control"
                                                               value="{{ $My_Class->getTranslation('Name_class', 'ar') }}"
                                                               >
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $My_Class->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en"
                                                               class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ $My_Class->getTranslation('Name_class', 'en') }}"
                                                               name="Name_en" >
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('My_Classes_trans.Name_Grade') }}
                                                        :</label>
                                                    <select class="form-control form-control-lg"
                                                            id="exampleFormControlSelect1" name="Grade_id">
                                                        <option value="{{ $My_Class->Grades->id }}">
                                                            {{ $My_Class->Grades->Name }}
                                                        </option>
                                                        @foreach ($Grades as $Grade)
                                                            <option value="{{ $Grade->id }}">
                                                                {{ $Grade->Name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('My_Classes_trans.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('My_Classes_trans.delete_class') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Classrooms.destroy', 'test') }}"
                                                  method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                <h6>{{ trans('My_Classes_trans.Warning_class') }}</h6>
                                                <input id="Name" type="text" name="Name"
                                                            class="form-control"
                                                            value="({{$My_Class->getTranslation('Name_class', 'ar')}}),({{$My_Class->getTranslation('Name_class', 'en')}}) "
                                                            required>
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $My_Class->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('My_Classes_trans.add_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('Classrooms.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                                :</label>
                                            <input class="form-control" type="text" name="Name" />
                                        </div>


                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                                :</label>
                                            <input class="form-control" type="text" name="Name_class_en"/>
                                        </div>


                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}
                                                :</label>

                                            <div class="box">
                                                <select class="fancyselect" name="Grade_id">
                                                    <option value="" selected disabled>{{ trans('My_Classes_trans.Name_Grade') }}</option>
                                                    @foreach ($Grades as $Grade)
                                                        <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="{{ trans('My_Classes_trans.delete_row') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('My_Classes_trans.add_row') }}"/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                <button type="submit"
                                    class="btn btn-success">{{ trans('My_Classes_trans.submit') }}</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

  </div>
</div>
<!-- حذف مجموعة صفوف -->
<!-- Delete rowgroup -- حذف مجموعة صفوف --->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('My_Classes_trans.delete_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('delete_all') }}" method="POST">
                @csrf
                <div class="modal-body">
                    {{ trans('My_Classes_trans.Warning_class') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>

                    <input type="text" class="form-control" id="delete_all_Name_class" name="delete_all_Name_class" 
                    value="" 
                    required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- </div>

</div> --}}

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection