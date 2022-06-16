<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(function () {
        var table = $('#students-table').DataTable({
          "lengthMenu": [
                      [ 10, 25, 50, 100, -1 ],
                      [ '10', '25', '50', '100', 'All' ]
                  ],
            dom: 'lBfrtip',
            buttons: [
                      'excel', 'pdf', 'csv', 'print'
                    ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('students.index') }}", 	
            order: [ 1, 'asc' ],
            columns: [
              {data: null, sortable: false,
                  render: function (data, type, row, meta) {
                      return meta.row + meta.settings._iDisplayStart + 1;
                  }
              },
                {data: 'nisn', name: 'nisn'},
                {data: 'nama', name: 'nama'},
                {data: 'kelas.nama_kelas', name: 'kelas.nama_kelas'},
                {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        table.buttons().container().appendTo($('#buttons'))
      });

      $('body').on('click', '.delete', function () {
        if (confirm("Hapus siswa?") == true) {
          var id = $(this).data('id');
          // ajax
          $.ajax({
            type:"POST",
            url: "{{ url('delete-student') }}",
            data: { id: id},
            dataType: 'json',
            success: function(res){
              var oTable = $('#students-table').dataTable();
              oTable.fnDraw(false);
              toastr.success("Siswa berhasil dihapus !")
            }
          });
        }
      });
    });
  </script>