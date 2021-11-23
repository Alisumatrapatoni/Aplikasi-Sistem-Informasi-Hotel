@extends('layout.admin')
@push('css')
      <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- toastr CSS CDN--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')


        <div class="content-wrapper">
        <!-- Content Header (Page header) -->



            <div class="content-header ">
            <div class="container-fluid ">
                <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="m-10">Data Pegawai</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                    <li class="breadcrumb-item active">Data Pegawai</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>


    <div class="card row-center">
        <div class="container ">
        <a href="/tambahpegawai" class="btn btn-success mt-2 ">Tambah Data</a>
         <div class="row g-3 align-items-center mt-2 mb-2">
            <div class="col-auto">
            <form action="/pegawai" method="GET">
                <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
            </form>
            </div>
            <div class="col-auto">
                <a href="/exportpdfdatapegawai" class="btn btn-danger">Export PDF</a>
            </div>
            <div class="col-auto">
                <a href="/exportexceldatapegawai" class="btn btn-success">Export Excel</a>
            </div>

            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import data
                </button>
            </div>
    </div>

            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/importexceldatapegawai" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                         <div class="form-group">
                            <input type="file" name="file" required> </input>
                         </div
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </form>
            </div>
            </div>

        </div>
        <div class="row">
            {{-- @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif --}}
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">No Telpon</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $no = 1;
                    @endphp

                    @foreach ($data as $index => $row)
                    <tr>
                        <th scope="row">{{ $index + $data ->firstItem() }}</th>
                        <td>{{ $row->nama }}</td>
                        <td>
                            <img src="{{ asset('fotopegawai/'.$row->foto) }}"  alt="" style="width: 40px">
                        </td>
                        <td>{{ $row->jeniskelamin }}</td>
                        <td>0{{ $row->notelpon }}</td>
                        <td>{{ $row->created_at->format('D M Y') }}</td>
                        <td>
                            <a href="/tampilkandatapegawai/{{ $row->id }}" class="btn btn-info">Edit</a>
                            <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>

</div>


@endsection

@push('scripts')
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{-- to astr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
  <script>
      $('.delete').click(function(){
            var pegawaiid = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');

            swal({
                title: "Yakin?",
                text: "Kamu akan menghapus data pegawai dengan nomer id " +pegawaiid+ " " + "dengan nama " +nama+ "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/deletedatapegawai/"+pegawaiid + ""
                    swal("Data berhasil dihapus!", {
                    icon: "success",
                    });
                } else {
                    swal("Data tidak jadi dihapus!");
                }
            });
      });

  </script>

  <script>

    @if (Session::has('success'))
      toastr.success("{{ Session::get('success') }}")
    @endif

  </script>
@endpush
