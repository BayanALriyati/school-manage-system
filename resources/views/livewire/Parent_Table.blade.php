
<div class="container text-center">
    <div class="row justify-content-md-center">
      <div class="col col-lg-2">
        <button class="btn btn-success btn-lg btn-lg pull-right" wire:click="showformadd" type="button">{{ trans('Parent_trans.Add_Parent') }}</button>
      </div>
    </div>
  </div>
<br>
@if (!empty($successMessage))
<div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    {{ $successMessage }}
</div>
@endif
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('Parent_trans.Email') }}</th>
            <th>{{ trans('Parent_trans.Parents') }}</th>
            <th>{{ trans('Parent_trans.Name') }}</th>
            <th>{{ trans('Parent_trans.ID_National') }}</th>
            <th>{{ trans('Parent_trans.Passport') }}</th>
            <th>{{ trans('Parent_trans.Phone') }}</th>
            <th>{{ trans('Parent_trans.Job') }}</th>
            <th>{{ trans('Parent_trans.Address') }}</th>
            <th>{{ trans('Parent_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($my_parents as $my_parent)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $my_parent->Email }}</td>
                <td>
                    {{ trans('Parent_trans.Father') }}
                    <hr>
                    {{ trans('Parent_trans.Mother') }}
                </td>
                <td>
                    {{ $my_parent->Name_Father }}
                    <hr>
                    {{ $my_parent->Name_Mother }}
                </td>
                <td>
                    {{ $my_parent->National_ID_Father }}
                    <hr>
                    {{ $my_parent->National_ID_Mother }}
                </td>
                <td>
                    {{ $my_parent->Passport_ID_Father }}
                    <hr>
                    {{ $my_parent->Passport_ID_Mother }}
                </td>
                <td>
                    {{ $my_parent->Phone_Father }}
                    <hr>
                    {{ $my_parent->Phone_Mother }}
                </td>
                <td>
                    {{ $my_parent->Job_Father }}
                    <hr>
                    {{ $my_parent->Job_Mother }}
                </td>
                <td>
                    {{ $my_parent->Address_Father }}
                    <hr>
                    {{ $my_parent->Address_Mother }}
                </td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('Parent_trans.edit_parent') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})" title="{{ trans('Parent_trans.delete_parent') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>
