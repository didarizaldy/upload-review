@extends('layouts.app')

@section('titlebar')
  User
@endsection

@section('title')
  Pengelolaan User
@endsection

@section('stylesheet')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-select/js/dataTables.select.min.js') }}" />
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
  <style>
    table {
      white-space: nowrap !important;
      width: 100% !important;
      border-collapse: collapse !important;
    }

    /* table.dataTable tbody tr:hover {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    background-color: #d7d7d7 !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                  } */
  </style>
@endsection

@section('javascript')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

  {{-- Custom BS Select --}}
  <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection

@section('init')
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      var usernameClear = document.querySelector('input[name="username"]');
      var passwordClear = document.querySelector('input[name="password"]');

      usernameClear.value = '';
      passwordClear.value = '';
    });


    //udah work nih coooyyy
    // $(document).ready(function() {
    //   showLoading();

    //   var table = $("#datatable").DataTable({
    //     serverSide: true,
    //     ajax: {
    //       url: "{{ route('admin.user-show') }}",
    //       method: "GET",
    //     },
    //     initComplete: function() {
    //       hideLoading();
    //       this.api()
    //         .columns()
    //         .every(function() {
    //           var column = this;
    //           var header = $(column.header());
    //           var columnData = column.dataSrc();
    //           if (
    //             columnData === "active" ||
    //             columnData === "roles" ||
    //             columnData === "last_login_at" ||
    //             columnData === "action"
    //           ) {
    //             return;
    //           }

    //           // var searchBox = $(
    //           //   '<input type="text" placeholder="Search ' +
    //           //   $(header).text() +
    //           //   '" style="width: 100%;"/>'
    //           // );
    //           var searchBox = $(
    //             '<input type="text" style="width: 100%;"/>'
    //           );

    //           header.append("<br>").append(searchBox);

    //           // Apply the search
    //           searchBox.on("keyup change", function() {
    //             if (column.search() !== this.value) {
    //               column.search(this.value).draw();
    //             }
    //           });
    //         });
    //     },
    //     columns: [{
    //         data: "name"
    //       },
    //       {
    //         data: "username"
    //       },
    //       {
    //         data: "active"
    //       },
    //       {
    //         data: "roles"
    //       },
    //       {
    //         data: "last_login_at"
    //       },
    //       {
    //         data: "action"
    //       },
    //     ],
    //     paging: false,
    //     deferRender: true,
    //     scrollY: "400px",
    //     scrollCollapse: true,
    //     scrollX: true,
    //     sScrollX: "100%",
    //     sScrollXInner: "110%",
    //     bScrollCollapse: true,
    //     columnDefs: [{
    //         className: "dt-body-center",
    //         targets: [2, 3, 5],
    //       },
    //       {
    //         className: "dt-body-right",
    //         targets: [4],
    //       },
    //       {
    //         orderable: false,
    //         targets: [4, 5]
    //       },
    //       {
    //         searchable: false,
    //         targets: [2, 3, 4, 5]
    //       }
    //     ],
    //     scroller: {
    //       loadingIndicator: true,
    //     },
    //     dom: 'lrtip'
    //   });

    //   table.page.len(100).draw(); // Set the initial page length to load the first chunk of 100 data

    //   table.on("draw", function() {
    //     var pageInfo = table.page.info();
    //     var totalRecords = pageInfo.recordsTotal;
    //     var displayedRecords = pageInfo.recordsDisplay;

    //     if (displayedRecords < totalRecords) {
    //       var remainingRecords = totalRecords - displayedRecords;
    //       var loadChunkSize = Math.min(100, remainingRecords); // Load the next chunk of 100 records or less

    //       table.page.len(displayedRecords + loadChunkSize).draw(
    //         false); // Append the next chunk of data without triggering a redraw
    //     }
    //   });

    //   table.buttons().container().appendTo("#datatable_wrapper .col-md-6:eq(0)");
    // });


    $(document).ready(function() {
      // showLoading();

      var table = $("#datatable").DataTable({
        serverSide: true,
        ajax: {
          url: "{{ route('admin.user-show') }}",
          method: "GET",
        },
        // dom: 'Blrtip',
        dom: 'Blrtip',
        buttons: [{
          text: '<i class="fas fa-user-plus"></i> Tambah Data',
          className: "btn btn-sm btn-success btn-track"
        }],
        initComplete: function() {
          var table = this;

          table.api().columns().every(function() {
            var column = this;
            var header = $(column.header());
            var columnData = column.dataSrc();

            if (columnData === "username" || columnData === "name") {
              var searchBox = $('<input type="text" style="width: 100%;"/>');
              header.append("<br>").append(searchBox);

              searchBox.on("keyup change", function() {
                if (column.search() !== this.value) {
                  column.search(this.value).draw();
                }
              });
            }

            if (columnData === "active") {
              var dropdown = $(
                '<select style="width: 100%;" class="custom-select"><option value="">All</option><option value="1">Aktif</option><option value="0">Tidak Aktif</option></select>'
              );
              header.append("<br>").append(dropdown);

              dropdown.on("change", function() {
                var values = $(this).val();
                console.log(values);
                if (column.search() !== this.value) {
                  column.search(this.value).draw();
                }
              });
            }

            // ini udah jalan suwer
            // if (columnData === "roles") {
            //   var dropdown = $(
            //     '<select style="width: 100%;" class="custom-select"><option value="">All</option></select>'
            //   );

            //   header.append("<br>").append(dropdown);

            //   var distinctValues = column.data().unique().sort().toArray();

            //   distinctValues = distinctValues.filter(function(value) {
            //     return value.trim() !== "";
            //   });

            //   $.each(distinctValues, function(index, value) {
            //     dropdown.append('<option value="' + value + '">' + value + '</option>');
            //   });

            //   dropdown.on("change", function() {
            //     var values = $(this).val();
            //     console.log(values);
            //     if (column.search() !== this.value) {
            //       column.search(this.value).draw();
            //     }
            //   });
            // }


            if (columnData === "roles") {
              var dropdown = $(
                '<select style="width: 100%;" class="custom-select"><option value="">All</option></select>'
              );

              header.append("<br>").append(dropdown);

              var distinctValues = column.data().unique().sort().toArray();

              distinctValues = distinctValues.filter(function(value) {
                return value.trim() !== "";
              });

              $.each(distinctValues, function(index, value) {
                dropdown.append('<option value="' + value + '">' + value + '</option>');
              });

              dropdown.on("change", function() {
                var values = $(this).val();
                console.log(values);
                // if (column.search() !== this.value) {
                //   // column.search(this.value).draw();
                //   column.search("^" + values + "$", true, false).draw();
                // }
                if (values === "") {
                  column.search("").draw();
                } else {
                  column.search("^" + values + "$", true, false).draw();
                }
              });
            }
          });
        },
        columns: [{
            data: "active",
            render: function(data, type, row) {
              if (data == 1) {
                // return '<span class="float-none badge bg-success">Aktif</span>';
                return '<i class="fas fa-check-square" style="color: #3b910d;"></i>';
              } else {
                // return '<span class="float-none badge bg-danger">Tidak Aktif</span>';
                return '<i class="fas fa-times-circle" style="color: #ad0000;"></i>';
              }
            },
          },
          {
            data: "name"
          },
          {
            data: "username"
          },
          {
            data: "roles"
          },
          {
            data: "last_login_at"
          }
        ],
        paging: false,
        deferRender: true,
        scrollY: "400px",
        scrollCollapse: true,
        scrollX: true,
        sScrollX: "100%",
        sScrollXInner: "110%",
        bScrollCollapse: true,
        aaSorting: [4],
        columnDefs: [{
            className: "dt-body-center",
            targets: [0],
          },
          {
            className: "dt-body-right",
            targets: [4],
          },
          {
            orderable: false,
            targets: [0, 3]
          },
          {
            searchable: false,
            targets: [4]
          }
        ],
        // "search": {
        //   "regex": true,
        //   "smart": false
        // },
        // scroller: {
        //   loadingIndicator: true,
        // },
      });

      table.buttons().container().appendTo("#datatable_wrapper .col-md-6:eq(0)");

      // Event listener for row click
      // $('#datatable tbody').on('click', 'tr', function() {
      //   var rowData = table.row(this).data();
      //   var clickedRow = $(this);
      //   var selectedRow = null;

      //   showModal(rowData);


      //   if (clickedRow.hasClass("selected")) {
      //     // Deselect the clicked row
      //     clickedRow.removeClass("selected");
      //     clickedRow.removeClass("bg-warning");
      //     selectedRow = null;
      //   } else {
      //     // Deselect the previously selected row
      //     if (selectedRow !== null) {
      //       selectedRow.removeClass("selected");
      //       selectedRow.removeClass("bg-warning");
      //     }

      //     // Select the clicked row
      //     clickedRow.addClass("selected");
      //     clickedRow.addClass("bg-warning");
      //     selectedRow = clickedRow;
      //   }
      // });
      var selectedRow = null;
      $("#myModal").on("hidden.bs.modal", function() {
        // Deselect the selected row when modal is closed
        if (selectedRow !== null) {
          selectedRow.removeClass("selected");
          selectedRow.removeClass("bg-secondary");
          selectedRow = null;
        }
      });

      function showModal(rowData) {
        // Populate modal with row data
        console.log(rowData);
        $("input[name*='name']").val(rowData.name);
        $("input[name*='username']").val(rowData.username);
        $("input[name*='password']").val(rowData.passkey);
        $("select[name*='role']").val(rowData.roles).trigger('change');

        var statusElement = document.getElementById("active");

        if (rowData.active == 1) {
          statusElement.innerHTML = '<span class="float-none badge bg-success">Aktif</span>';
        } else {
          statusElement.innerHTML = '<span class="float-none badge bg-danger">Tidak Aktif</span>';
        }

        // Show the modal
        $("#myModal").modal("show");
      }

      $("#datatable tbody").on("click", "tr", function() {
        var clickedRow = $(this);

        if (selectedRow !== null && selectedRow.get(0) !== clickedRow.get(0)) {
          // Deselect the previously selected row
          selectedRow.removeClass("selected");
          selectedRow.removeClass("bg-secondary");
        }

        if (clickedRow.hasClass("selected")) {
          // Deselect the clicked row
          clickedRow.removeClass("selected");
          clickedRow.removeClass("bg-secondary");
          selectedRow = null;
        } else {
          // Deselect the previously selected row
          if (selectedRow !== null) {
            selectedRow.removeClass("selected");
            selectedRow.removeClass("bg-secondary");
          }

          // Select the clicked row
          clickedRow.addClass("selected");
          clickedRow.addClass("bg-secondary");
          selectedRow = clickedRow;

          var rowData = table.row(clickedRow).data();
          showModal(rowData);
        }
      });

      var passwordInput = document.getElementById("passwordInput");
      var eyeIcon = document.getElementById("eyeIcon");
      var passwordToggle = document.getElementById("passwordToggle");

      passwordToggle.addEventListener("click", function() {
        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          eyeIcon.classList.remove("fa-eye");
          eyeIcon.classList.add("fa-eye-slash");
        } else {
          passwordInput.type = "password";
          eyeIcon.classList.remove("fa-eye-slash");
          eyeIcon.classList.add("fa-eye");
        }
      });

      // Function to show the modal with the row data
      // function showModal(data) {
      //   // Access the data properties and display them in the modal
      //   var name = data.name;
      //   var username = data.username;

      //   // Show the modal and set the content
      //   $('#modalName').text(name);
      //   $('#modalUsername').text(username);
      //   $('#myModal').modal('show');
      // }
      // $("#datatable tbody").on("click", "tr", function() {
      //   if ($(this).hasClass("selected")) {
      //     // Row is already selected, deselect it
      //     $(this).removeClass("selected");
      //   } else {
      //     // Deselect any previously selected row
      //     table.$("tr.selected").removeClass("selected");
      //     // Select the clicked row
      //     $(this).addClass("selected");
      //   }
      // });
    });





    // $(document).ready(function() {
    //   showLoading();

    //   var table = $("#datatable").DataTable({
    //     serverSide: true,
    //     ajax: {
    //       url: "{{ route('admin.user-show') }}",
    //       method: "GET",
    //     },
    //     initComplete: function() {
    //       hideLoading();
    //       this.api()
    //         .columns()
    //         .every(function() {
    //           var column = this;
    //           var header = $(column.header());
    //           var columnData = column.dataSrc();
    //           if (
    //             columnData === "active" ||
    //             columnData === "roles" ||
    //             columnData === "action"
    //           ) {
    //             return;
    //           }

    //           var searchBox = $(
    //             '<input type="text" placeholder="Search ' +
    //             $(header).text() +
    //             '" style="width: 100%;"/>'
    //           );

    //           header.append("<br>").append(searchBox);

    //           // Apply the search
    //           searchBox.on("keyup change", function() {
    //             if (column.search() !== this.value) {
    //               column.search(this.value).draw();
    //             }
    //           });
    //         });
    //     },
    //     columns: [{
    //         data: "name",
    //       },
    //       {
    //         data: "username",
    //       },
    //       {
    //         data: "active",
    //         searchable: false,
    //       },
    //       {
    //         data: "roles",
    //         searchable: false,
    //       },
    //       {
    //         data: "action",
    //         searchable: false,
    //       },
    //     ],
    //     ordering: false,
    //     paging: false,
    //     deferRender: true,
    //     scrollY: "400px",
    //     scrollCollapse: true,
    //     scrollX: true,
    //     sScrollX: "100%",
    //     sScrollXInner: "110%",
    //     bScrollCollapse: true,
    //     columnDefs: [{
    //       className: "dt-body-center",
    //       targets: [0],
    //     }, ],
    //     scroller: {
    //       loadingIndicator: true,
    //     },
    //     dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
    //       "<'row'<'col-sm-12'tr>>" +
    //       "<'row'<'col-sm-5'i><'col-sm-7'p>>", // Customize the DataTable layout
    //     language: {
    //       search: "", // Remove the default search label
    //       searchPlaceholder: "Search", // Add a placeholder for the individual column search
    //     },
    //   });

    //   table.page.len(100).draw(); // Set the initial page length to load the first chunk of 100 data

    //   table.on("draw", function() {
    //     var pageInfo = table.page.info();
    //     var totalRecords = pageInfo.recordsTotal;
    //     var displayedRecords = pageInfo.recordsDisplay;

    //     if (displayedRecords < totalRecords) {
    //       var remainingRecords = totalRecords - displayedRecords;
    //       var loadChunkSize = Math.min(100, remainingRecords); // Load the next chunk of 100 records or less

    //       table.page.len(displayedRecords + loadChunkSize).draw(
    //       false); // Append the next chunk of data without triggering a redraw
    //     }
    //   });

    //   table.buttons().container().appendTo("#datatable_wrapper .col-md-6:eq(0)");
    // });






    // var table = $("#datatable")
    //   .DataTable({
    //     // processing: true,
    //     serverSide: true,
    //     ajax: {
    //       url: "{{ route('admin.user-show') }}",
    //       method: 'GET',
    //     },
    //     // initComplete: function(settings, json) {
    //     //   hideLoading();
    //     // },
    //     // initComplete: function() {
    //     //   // Add individual search boxes for each column
    //     //   this.api().columns().every(function() {
    //     //     var column = this;
    //     //     var header = $(column.header());
    //     //     header.append('<br><input type="text" placeholder="Search ' + $(header).text() +
    //     //       '" style="width: 100%;"/>');

    //     //     // Apply the search
    //     //     $('input', header).on('keyup change', function() {
    //     //       if (column.search() !== this.value) {
    //     //         column.search(this.value).draw();
    //     //       }
    //     //     });
    //     //   });
    //     // },
    //     initComplete: function() {
    //       // Add individual search boxes for each column
    //       this.api().columns().every(function() {
    //         var column = this;
    //         var header = $(column.header());
    //         var columnData = column.dataSrc();

    //         // Hide search boxes for specific columns
    //         if (columnData === "active" || columnData === "roles" || columnData === "action") {
    //           return;
    //         }

    //         var searchBox = $('<input type="text" placeholder="Search ' + $(header).text() +
    //           '" style="width: 100%;"/>');

    //         header.append('<br>').append(searchBox);

    //         // Apply the search
    //         searchBox.on('keyup change', function() {
    //           if (column.search() !== this.value) {
    //             column.search(this.value).draw();
    //           }
    //         });
    //       });
    //     },
    //     columns: [
    //       // {
    //       //   "data": "DT_RowIndex",
    //       //   "searchable": false
    //       // },
    //       {
    //         "data": "name",
    //       },
    //       {
    //         "data": "username",
    //       },
    //       {
    //         "data": "active",
    //         "searchable": false
    //       },
    //       {
    //         "data": "roles",
    //         "searchable": false
    //       },
    //       {
    //         "data": "action",
    //         "searchable": false
    //       },
    //     ],
    //     paging: false,
    //     deferRender: true,
    //     scrollY: "400px",
    //     scrollCollapse: true,
    //     scrollX: true,
    //     sScrollX: "100%",
    //     sScrollXInner: "110%",
    //     bScrollCollapse: true,
    //     columnDefs: [{
    //       "className": "dt-body-center",
    //       "targets": [0]
    //     }],
    //     scroller: {
    //       loadingIndicator: true
    //     },
    //   })
    //   .buttons()
    //   .container()
    //   .appendTo("#datatable_wrapper .col-md-6:eq(0)");



    $(document).on('click', '.delete-button', function(e) {
      e.preventDefault();
      const userId = $(this).closest('form').find('input[name="user_id"]').val();
      console.log(userId);

      swal({
        title: 'Apakah anda yakin?',
        text: "Anda tidak akan dapat mengembalikan data ini!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
      }, function() {
        $('#delete-form-' + userId).submit();
      });
    });
  </script>
@endsection

@section('content')
  <section id="basic-tabs-components">
    <div class="row match-height">
      <div class="col-xl-12 col-lg-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#browsemode" role="tab"><i
                      class="fas fa-folder-open"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="data-permission-tab" data-toggle="tab" aria-controls="data-permission"
                    href="#data-permission" aria-expanded="false"><i class="fas fa-user-check"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="data-permission-tab" data-toggle="tab" aria-controls="data-permission"
                    href="#data-permission" aria-expanded="false"><i class="fas fa-id-card"></i></a>
                </li>
              </ul>
              <div class="tab-content px-1 pt-1">
                <div class="tab-pane active" id="browsemode" aria-labelledby="browsemode" role="tabpanel">
                  <section id="ajax">
                    <div class="row">
                      <div class="col-12">
                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped">
                              <thead>
                                <tr class="text-center">
                                  {{-- <th>No.</th> --}}
                                  <th></th>
                                  <th>Nama</th>
                                  <th>Username</th>
                                  {{-- <th>Status Akun</th> --}}
                                  <th>Role Akun</th>
                                  <th>Last Login</th>
                                  {{-- <th>Action</th> --}}
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
                {{--  --}}


                <div class="tab-pane" id="data-permission" aria-labelledby="data-permission-tab">
                  <form role="form" action="{{ route('admin.user-store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row mt-4">
                      <div class="col-md-12">
                        <fieldset>
                          <legend style="font-size: 18px"><i class="fas fa-hand-holding-usd"></i> Perizinan
                          </legend>
                          <hr>
                          <div class="form-group row">
                            <p class="col-lg-3 col-form-label">No. SI <span class="text-danger">*</span></p>
                            <div class="col-lg-9">
                              <select data-msg-required="Choose SI Number !" required name="idinstruction"
                                class="form-control" data-fouc id="idinstruction">
                                <option selected disabled></option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <p class="col-lg-3 col-form-label">Destination <span class="text-danger">*</span></p>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="instructionloader" name="instructionloader"
                                readonly />
                            </div>
                          </div>
                          <div class="form-group row">
                            <p class="col-lg-3 col-form-label">Vessel Name <span class="text-danger">*</span></p>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="instructionvesselname"
                                name="instructionvesselname" readonly />
                            </div>
                          </div>
                          <div class="form-group row">
                            <p class="col-lg-3 col-form-label">Cost Shipping <span class="text-danger">*</span></p>
                            <div class="col-lg-9">
                              <input type="tel" class="form-control"
                                placeholder="Number Format Only Allowed !! (e.g 1500000)" name="cost"
                                class="form-control" data-msg-required="Tidak boleh kosong !" required>
                            </div>
                          </div>
                        </fieldset>
                        <div class="text-right">
                          <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>



              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">User Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group row">
            <label class="col-form-label col-sm-3">Nama <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="name" data-msg-required="Tidak boleh kosong !" required
                placeholder="contoh : Muhammad Hatta" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-3">Username <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="username" data-msg-required="Tidak boleh kosong !" required
                placeholder="contoh : muhammadhatta" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-3">Password <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="password" id="passwordInput" name="password" data-msg-required="Tidak boleh kosong !"
                  required placeholder="contoh : muhammadhatta" class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text" id="passwordToggle">
                    <i class="fa fa-eye" id="eyeIcon"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-3">Role <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <div class="input-group">
                <select data-msg-required="Pilih Role !" name="role" class="form-control" required>
                  @foreach ($roles as $role)
                    <option value="{{ $role }}">{{ $role }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-3">Status <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <div class="input-group mt-2" id="active">
                {{-- isi --}}
              </div>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-9">
              <div class="input-group">
                @foreach ($permissions as $permission)
                  <div class="col-12 col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input custom-control-input-success" type="checkbox"
                        id="checkbox_{{ $permission->id }}" value="{{ $permission->id }}" name="permissions[]"
                        {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }} />
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
