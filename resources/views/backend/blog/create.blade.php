@extends('layouts.backend.main')

@section('title', 'Add New Post | News 45')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create New Blog</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Blog</a></li>
                            <li class="breadcrumb-item active">Add New Post</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                {!! Form::model($post, [
                                'method' => 'POST',
                                'route' => 'backend.store',
                                'files' => true,
                                ]) !!}

                                <div class="form-group {{ $errors->has('title' ? 'has-error' : '') }}">
                                    {!! Form::label('title') !!}
                                    {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}

                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif

                                    {{-- <label for="exampleFormControlInput1"
                                        class="form-label">Title</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" required
                                        value="{{ old('title') }}" id="exampleFormControlInput1" placeholder="Title">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror --}}
                                </div>

                                <div class="form-group {{ $errors->has('slug' ? 'has-error' : '') }}">
                                    {!! Form::label('slug') !!}
                                    {!! Form::text('slug', null, ['class' => 'form-control', 'required']) !!}

                                    @if ($errors->has('slug'))
                                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('category_id' ? 'has-error' : '') }}">
                                    {!! Form::label('Category_id', 'Category') !!}
                                    {!! Form::select('category_id', App\Models\Category::pluck('title', 'id'), null,
                                    ['class' => 'form-control', 'placeholder' => 'Select Category', 'required']) !!}

                                    @if ($errors->has('category_id'))
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('excerpt' ? 'has-error' : '') }}">
                                    {!! Form::label('excerpt') !!}
                                    {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'required']) !!}

                                    @if ($errors->has('excerpt'))
                                        <span class="text-danger">{{ $errors->first('excerpt') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('body' ? 'has-error' : '') }}">
                                    {!! Form::label('body') !!}
                                    {!! Form::textarea('body', null, ['class' => 'form-control', 'required']) !!}

                                    @if ($errors->has('body'))
                                        <span class="text-danger">{{ $errors->first('body') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('published_at' ? 'has-error' : '') }}">
                                    {!! Form::label('Published_at', 'Publish Date') !!}
                                    {!! Form::text('published_at', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Y-m-d
                                    H:i:s',
                                    ]) !!}

                                    @if ($errors->has('published_at'))
                                        <span class="text-danger">{{ $errors->first('published_at') }}</span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('image' ? 'has-error' : '') }}">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Upload Post Image</label>
                                        <input type="file" name="image" class="form-control-file"
                                            id="exampleFormControlFile1">
                                    </div>

                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>

                                <hr>

                                {!! Form::submit('Create New Post', ['class' => 'btn btn-primary']) !!}

                                {!! Form::close() !!}
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </section>
    </div><!-- /.container-fluid -->
    <!-- /.content -->
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');

    </script>
@endsection
