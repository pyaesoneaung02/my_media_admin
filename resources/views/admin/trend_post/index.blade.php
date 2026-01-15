@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post Page</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="float-right form-control" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="p-0 card-body table-responsive">
        <table class="table text-center table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th>View Count</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $post as $item )
            <tr>
              <td>{{ $item['post_id']}}</td>
              <td>{{ $item['title']}}</td>
              <td>
                <img class="rounded shadow-sm" width="100px" height="100px"
                @if ($item['image'] == null)
                src="{{asset('defaultImage/photo.jpg')}}"
                @else
                src="{{asset('postImage/'. $item['image'])}}"
                @endif>
            </td>
              <td><i class="fa-solid fa-eye"></i> {{ $item['post_count']}}</td>
              <td>
                {{-- <button class="text-white btn btn-sm bg-dark"><i class="fas fa-edit"></i></button> --}}
                <a href="{{ route('admin#trendPostDetails', $item['post_id']) }}">
                    <button class="text-white btn btn-sm bg-dark"><i class="fa-solid fa-eye"></i></button>
                </a>
                {{-- <button class="text-white btn btn-sm bg-danger"><i class="fas fa-trash-alt"></i></button> --}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
          {{ $post->links() }}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
