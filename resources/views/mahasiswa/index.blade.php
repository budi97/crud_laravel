<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <main class="container">
        @if (session('status'))
        <div class="pt-3">
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        </div>
        @endif
           
        <h2 class="text-center">Data Mahasiswa</h2>
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                <div class="pb-3">
                  <form class="d-flex" action="{{url('/home')}}" method="get">
                      <input class="form-control me-1" type="search" name="kata" value="{{ Request::get('katakunci') }}" placeholder="Masukkan Pencarian" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
                  </form>
                </div>
                
                <!-- TOMBOL TAMBAH DATA -->
                <div class="pb-3">
                  <a href='{{ url('crud/create') }}' class="btn btn-primary">+ Tambah Data</a>
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-2">NIM</th>
                            <th class="col-md-2">Nama</th>
                            <th class="col-md-2">Alamat</th>
                            <th class="col-md-2">Jurusan</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $a = $data->firstItem(); ?>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$a}}</td>
                            <td>{{$item->nim}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->jurusan}}</td>
                            <td>
                                <a href='{{url('crud/'.$item->nim.'/edit')}}' class="btn btn-success btn-sm">Edit</a>
                                <form class="d-inline" onsubmit="return confirm('Yakin mau hapus data???')" action="{{url('crud/'.$item->nim)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>                                
                            </td>
                        </tr>
                        <?php $a++ ?>
                        @endforeach                        
                    </tbody>
                </table>
               {{$data->links(); }}
          </div>
          <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>