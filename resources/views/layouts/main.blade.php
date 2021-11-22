<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweatalert/sweatalert.min.css') }}" />
    <link href="{{ asset("assets/plugins/datatables/datatables.bootstrap4.min.css") }}" rel="stylesheet" />
</head>
<body>
    @include('layouts.sidebar')
    <div class="main">
        @include('layouts.topbar')
        @yield('content')
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweatalert/sweatalert.min.js') }}"></script>
    <script src="{{ asset("assets/plugins/datatables/jquery.datatables.min.js") }}"></script>
    <script src="{{ asset("assets/plugins/datatables/datatables.bootstrap4.min.js") }}"></script>

    <script>
      // MenuToggle
      let toggle = document.querySelector(".toggle");
      let navigation = document.querySelector(".navigation");
      let main = document.querySelector(".main");

      toggle.onclick = function () {
        navigation.classList.toggle("active");
        main.classList.toggle("active");
      };

      // add hovered class in selected list item
      let list = document.querySelectorAll(".navigation li");
      function activeLink() {
        list.forEach((item) => item.classList.remove("hovered"));
        item.classList.add("hovered");
      }
      list.forEach((item) => item.addEventListener("mouseover", activeLink));
    </script>

    <script>

        const baseUrl = "{{  url('') }}";
        const btnArsipSurat = document.querySelector(".btn-arsip-surat");
        const inputFile = document.querySelector("#formFile");
        const judulSurat = document.querySelector("#judulSurat");
        const noSurat = document.querySelector("#noSurat");
        const kategoriSurat = document.querySelector("#kategoriSurat");

        var fileSurat = "";

        function pickFileSurat(){
            var files = inputFile.files;
            if(files[0].type == "application/pdf"){
                getBase64(files[0]);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'File yang dipilih bukan PDF',
                });
            }
        }

        function getBase64(file) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                fileSurat = reader.result;
                console.log(reader.result);
            };
        }

        function submitData(){
            Swal.fire({
                imageUrl: "https://www.boasnotas.com/img/loading2.gif",
                imageHeight: 100,
                text: 'Data sedang disimpan....',
                allowOutsideClick: false,
                showConfirmButton: false 
            });
            $.ajax({
                url: baseUrl + "/arsip-surat",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    "id_kategori" : kategoriSurat.value,
                    "no_surat": noSurat.value,
                    "judul": judulSurat.value,
                    "file_surat": fileSurat
                },
                success: function(res){
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Data surat berhasil disimpan',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = "{{ url('/') }}";
                        } 
                    });
                },error: function(err){
                    const { file_surat, no_surat, judul, id_kategori } = err.responseJSON.errors;
                    Swal.close();
                    Swal.fire({
                        title: '<strong class="text-danger">Peringatan</strong>',
                        icon: 'info',
                        html:
                            file_surat != null ? '<p>'+file_surat[0]+'</p>' : 
                            no_surat != null ? '<p>'+no_surat[0]+'</p>' : 
                            judul != null ? '<p>'+judul[0]+'</p>' : 
                            id_kategori != null ? '<p>'+id_kategori[0]+'</p>' : '',
                        showCloseButton: true,
                    });
                }
            });
        }

        function updateData(id){
            Swal.fire({
                imageUrl: "https://www.boasnotas.com/img/loading2.gif",
                imageHeight: 100,
                text: 'Data sedang diperbaruhi....',
                allowOutsideClick: false,
                showConfirmButton: false 
            });
            $.ajax({
                url: baseUrl + "/arsip-surat/"+id,
                type: "PUT",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    "id_kategori" : kategoriSurat.value,
                    "no_surat": noSurat.value,
                    "judul": judulSurat.value,
                    "file_surat": fileSurat
                },
                success: function(res){
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Data surat berhasil diperbaruhi',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = "{{ url('/') }}";
                        } 
                    });
                },error: function(err){
                    const { file_surat, no_surat, judul, id_kategori } = err.responseJSON.errors;
                    Swal.close();
                    Swal.fire({
                        title: '<strong class="text-danger">Peringatan</strong>',
                        icon: 'info',
                        html:
                            file_surat != null ? '<p>'+file_surat[0]+'</p>' : 
                            no_surat != null ? '<p>'+no_surat[0]+'</p>' : 
                            judul != null ? '<p>'+judul[0]+'</p>' : 
                            id_kategori != null ? '<p>'+id_kategori[0]+'</p>' : '',
                        showCloseButton: true,
                    });
                }
            });
        }

        function confirDelete(judul, id){
            Swal.fire({
                title: 'Apkah yakin menghapus surat '+judul,
                showDenyButton: true,
                confirmButtonText: 'Hapus',
                denyButtonText: 'Tidak',
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        imageUrl: "https://www.boasnotas.com/img/loading2.gif",
                        imageHeight: 100,
                        text: 'Data sedang dihapus....',
                        allowOutsideClick: false,
                        showConfirmButton: false 
                    });
                    $.ajax({
                        url: baseUrl+"/arsip-surat/"+id,
                        type: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function(res){
                            Swal.close();
                            Swal.fire('Berhasil!', res.message, 'success');
                            window.location.reload();
                        }
                    })
                } 
            })
        }

    </script>

    <script>
        $("#dataTable").DataTable({
            "dom": "fltpi",
            "oLanguage": {
                "sSearch": "Cari Surat: "
            }
        });
        $('.dataTables_filter').addClass('pull-left');
        $('.dataTables_paginate').addClass('pull-left');
        $('.dataTables_length').addClass('pull-right');
        $('.dataTables_info').addClass('pull-right');
    </script>


</body>
</html>