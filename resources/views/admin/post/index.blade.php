@extends('admin.layouts.app')

@section('content')
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin#createPost')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                <label>Title</label>
                <input type="text" value="{{ old('postTitle')}}" name="postTitle" class="form-control" placeholder="Enter Post Title">
                @error('postTitle')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="postDescription" cols="30" rows="10" class="form-control" placeholder="Enter Description">{{ old('postDescription')}}</textarea>
                @error('postDescription')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="file" value="{{ old('postImage')}}" name="postImage" class="form-control">
                {{-- @error('postImage')
                    <div class="text-danger">{{ $message }}</div>
                @enderror --}}
                </div>
            <div class="form-group">
                <label>Category Name</label>
                <select name="postCategory" id="" class="form-control">
                    <option value="">Choose Category...</option>
                    @foreach ($category as $item)
                    <option value="{{$item['category_id']}}">{{$item['title']}}</option>
                    @endforeach
                </select>
                @error('postCategory')
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
        <h3 class="card-title">Post List Page</h3>

        <div class="card-tools">
          <form action="{{route('admin#categorySearch') }}" method="POST">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="categorySearch" class="form-control float-right" placeholder="Search">

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
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Post ID</th>
              <th>Title</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($post as $item)
            <tr>
              <td>{{ $item['post_id']}}</td>
              <td>{{ $item['title']}}</td>
              <td><img class="rounded shadow-sm" width="100px" height="100px"
                @if ($item['image'] == null)
                src="{{asset('defaultImage/photo.jpg')}}"
                @else
                src="{{asset('postImage/'. $item['image'])}}"
                @endif></td>
              <td>
                <a href="{{ route('admin#updatePostPage',$item['post_id'])}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                <a href="{{ route('admin#deletePost',$item['post_id'])}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
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
