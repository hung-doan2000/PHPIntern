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
    <a style="margin: 10px" href="{{route('admin.roles.index')}}" class="btn btn-primary btn-lg">Back</a>
    <!-- Main content -->
    <section class="content">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
        @endif
        <form role="form" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" value="{{ $role->name }}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label>Permission</label>
                <div class="form-group" data-select2-id="46">
                    <div class="select2-green" data-select2-id="45">
                        <select class="select2 select2-hidden-accessible"  name="permissions[]" id="permissions" multiple="" data-placeholder="Select a Role" data-dropdown-css-class="select2-green" style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true">
                            @foreach($permissions as $id => $permissions)
                                <option
                                    value="{{ $permissions->id }}"
                                    {{
                                        (in_array($id, old('permissions', [])) ||
                                         $role->permissions->contains($permissions->id)) ? 'selected' : ''
                                    }}
                                >
                                    {{ $permissions->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            @csrf
        </form>
    </section>
    <!-- /.content -->
@stop
