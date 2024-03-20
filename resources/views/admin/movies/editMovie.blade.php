@extends('admin.layouts.main')
@section('admin_main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Movie {{$movie->title}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Movies</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edit Movie</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Add movie form -->
                <form method="POST" action="{{route('admin.movies.update')}}" class="form" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <input type="hidden" name="movie_id" value="{{$movie->id}}">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{$movie->title}}" required>
                    @error('title')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="language">Language</label>
                    <input type="text" class="form-control @error('language') is-invalid @enderror" id="language" name="language" value="{{$movie->language}}" required>
                    @error('language')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <img src="{{URL('public/frontend/images/movie/'.$movie->image)}}" alt="" width="100px"> 
                    <br>
                    <label for="image">Image</label>
                    {{-- preview curent image --}}
                    <br>
                    <input type="hidden" name="old_image" value="{{$movie->image}}">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" value="{{$movie->rating}}" min="0" max="10" step="0.1" required>
                    @error('rating')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="time" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{$movie->duration}}" step="60" required>
                    @error('duration')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" class="form-control @error('release_date') is-invalid @enderror" id="release_date" name="release_date" value="{{$movie->release_date}}" required>
                    @error('release_date')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" value="{{$movie->genre}}" required>
                    @error('genre')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="trailer_url">Trailer URL</label>
                    <input type="text" class="form-control @error('trailer_url') is-invalid @enderror" id="trailer_url" name="trailer_url" value="{{$movie->trailer_url}}" required>
                    @error('trailer_url')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>

                  </form>                  
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
@section('adminscript')
<script>
    $(function () {
    $("#movie_lists").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
