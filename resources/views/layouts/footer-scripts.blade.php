
<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">var plugin_path = '{{ asset('assets/js') }}/';</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>


@if (App::getLocale() == 'en')
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
@else
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
@endif

{{-- <script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
</script> --}}
<script>
    // وظيفة لتحديد أو إلغاء تحديد جميع مربعات الاختيار
    function CheckAll(className, elem) {
        var checkboxes = document.getElementsByClassName(className);
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = elem.checked;
        }
    }

    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = [];
            var selectedNames = [];
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            $("#datatable input[type=checkbox]:checked").each(function() {
                var row = $(this).closest("tr");
                var nameClass = row.find("td:nth-child(3)").text();
                selected.push(this.value);
                selectedNames.push(nameClass);
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show'); // اعرض موديل delete_all
                $('input[id="delete_all_id"]').val(selected.join(', ')); // خذ منها ال value.selected(delete_all_id)
                $('input[id="delete_all_Name_class"]').val(selectedNames.join(', ')); // خذ منها ال value.selected(delete_all_Name_class)
            }
        });
    });
</script>
{{-- <script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show') //delete_all اعرض موديل
                $('input[id="delete_all_id"]').val(selected); // خذ منها ال value.selected(delete_all_id)
                // $('input[Name_class="delete_all_Name_class"]').val(selected); // خذ منها ال value.selected(delete_all_id)
                $('input[id="delete_all_Name_class"]').val(selectedNames.join(', ')); // خذ منها ال value.selected(delete_all_Name_class)

            }
        });
    });

   

</script> --}}
<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>
{{-- <script>
    // وظيفة لتحديد أو إلغاء تحديد جميع مربعات الاختيار
    function CheckAll(className, elem) {
        var checkboxes = document.getElementsByClassName(className);
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = elem.checked;
        }
        updateTextBox();
    }

    // وظيفة لتحديث حقل النص بناءً على الاختيارات
    function updateTextBox() {
        var selectedOptions = [];
        document.querySelectorAll('.box1:checked').forEach(function(checkedBox) {
            selectedOptions.push(checkedBox.value);
        });
        document.getElementById('delete_all_id').value = selectedOptions.join(', ');
    }

    // إضافة مستمعات للأحداث لكل مربع اختيار لتحديث حقل النص عند التغيير
    document.querySelectorAll('.box1').forEach(function(checkbox) {
        checkbox.addEventListener('change', updateTextBox);
    });
</script> --}}
