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

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );
</script>
@if (App::getLocale() == 'en')
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
@else
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
@endif


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

<script>
    $(document).ready(function () {
        $('select[name="Grade_id"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('classes') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {  // اذا نجح
                        $('select[name="Class_id"]').empty(); // روح ع select in section 
                        $.each(data, function (key, value) {
                            $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });                                                  
                            console.log("data");
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });

</script>
