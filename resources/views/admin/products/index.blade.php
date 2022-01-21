@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{$title}}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @can('product_create')
        <a style="margin: 10px" href="{{route('admin.products.create')}}" class="btn btn-primary btn-lg">Create New Product</a>
    @endcan
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Detail</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $products)
                                <tr>
                                    <td>{{$products->id}}</td>
                                    <td>{{$products->name}}</td>
                                    <td>{{$products->detail}}</td>
                                    <td>
                                        @can('product_index')
                                            <a class="btn btn-info" href="/admin/products/show/{{$products->id}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('product_edit')
                                            <a class="btn btn-primary" href="/admin/products/edit/{{$products->id}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('product_delete')
                                            <button type="button" class="delete btn btn-danger" data="{{$products->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endcan
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
        </div>
    </section>
    <!-- /.content -->
@stop
@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.products.delete')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="product_id" id="product_id" value="0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Product!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you want to delete this product?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $('.delete').click(function(){
            $('#product_id').val($(this).attr('data'))
            var myModal = new bootstrap.Modal($('#deleteModal'),
                {
                    keyboard: false
                });
            myModal.show();
        });
    </script>
@stop

