@extends('admin.layouts.app')

@section('content')
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin#createCategory')}}" method="POST">
                @csrf
              <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="categoryName" class="form-control" placeholder="Enter category name">
                @error('categoryName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

              </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="categoryDescription" cols="30" rows="10" class="form-control" placeholder="Enter Description"></textarea>
                @error('categoryDescription')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
<div class="col-8">
    {{-- alert start --}}
    @if (Session::has('deleteSuccess'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{Session::get('deleteSuccess')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    @endif
    {{-- alert start --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category List Page</h3>

        <div class="card-tools">
          <form action="{{route('admin#categorySearch') }}" method="POST">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="categorySearch" class="float-right form-control" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
          </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="p-0 card-body table-responsive">
        <table class="table text-center table-hover text-nowrap">
          <thead>
            <tr>
              <th>Category ID</th>
              <th>Category Name</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {{-- @foreach($category as $item)
            <tr>
              <td>{{ $item['category_id']}}</td>
              <td>{{ $item['title']}}</td>
              <td>{{ $item['description']}}</td>
              <td>
                <a href="{{ route('admin#categoryEditPage',$item['category_id'])}}"><button class="text-white btn btn-sm bg-dark"><i class="fas fa-edit"></i></button></a>
                <a href="{{ route('admin#deleteCategory',$item['category_id'])}}"><button class="text-white btn btn-sm bg-danger"><i class="fas fa-trash-alt"></i></button></a>
              </td>
            </tr>
            @endforeach --}}
            @foreach($category as $item)
            <tr>
                <td>{{ $item['category_id'] }}</td>
                <td>{{ $item['title'] }}</td>
                <td>{{ \Illuminate\Support\Str::words($item['description'], 10, '...') }}</td>
                <td>
                    <a href="{{ route('admin#categoryEditPage', $item['category_id']) }}">
                        <button class="text-white btn btn-sm bg-dark">
                            <i class="fas fa-edit"></i>
                        </button>
                    </a>
                    <a href="{{ route('admin#deleteCategory', $item['category_id']) }}">
                        <button class="text-white btn btn-sm bg-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
