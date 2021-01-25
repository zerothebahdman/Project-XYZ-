@extends('layouts.backend.main')

@section('title', 'News 45 | Blog Index')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Blog</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ 'backend.index' }}">Blog</a></li>
                            <li class="breadcrumb-item active">All Blog Posts</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>

                                <p>Total Blog Posts</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-pen"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>

                                <p>Categories</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-folder"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>

                                <p>Total Users</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Tags</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <a href="{{ route('backend.create') }}" class="btn btn-primary">Add New Post</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            @if (!$posts->count())
                                <div class="alert alert-danger text-center">
                                    <strong>No Record Found</strong>
                                </div>
                            @else
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-bordered table-striped table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/N</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Author</th>
                                                <th width="150">Category</th>
                                                <th width="170">Date</th>
                                                <th width="130">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ $posts->firstItem() + $loop->index }}</td>
                                                <td>{{ $post->title }} </td>
                                                <td>{{ $post->user->name }}</td>
                                                <td><span class="tag tag-success">{{ $post->category->title }}</span></td>
                                                <td>
                                                    <abbr
                                                        title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr>
                                                    |
                                                    {!! $post->publicationLabel() !!}
                                                </td>
                                                <td>
                                                    <a href="{{ route('backend.edit', $post->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('backend.destroy', $post->id) }}"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination float-left">
                                    {!! $posts->links() !!}
                                </ul>
                                <div class="float-right">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        {{ Str::plural('Items', $postCount) }}
                                        <span class="badge bg-light">{{ $postCount }}</span>
                                    </button>
                                </div>
                            </div>
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
