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
    <a style="margin: 10px" href="{{route('admin.users.index')}}" class="btn btn-primary btn-lg">Back</a>
    <!-- Main content -->
    <section class="content">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
        @endif
            <form method="post" action="{{ route('admin.users.edit.update' , $user->id) }}" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group" data-select2-id="46">
                    <label>Roles</label>
                    <div class="select2-green" data-select2-id="45">
                        <select class="select2 select2-hidden-accessible"  name="roles[]" id="roles" multiple="" data-placeholder="Select a Role" data-dropdown-css-class="select2-green" style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true">
                            @foreach($roles as $id => $roles)
                                <option
                                    value="{{ $roles->id }}"
                                    {{
                                        (in_array($id, old('roles', [])) ||
                                         $user->roles->contains($roles->id)) ? 'selected' : ''
                                    }}
                                >
                                    {{ $roles->name }}
                                </option>
                            @endforeach
                        </select>
                        {{--                                                <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="16" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="Alaska" data-select2-id="165"><span class="select2-selection__choice__remove" role="presentation">×</span>Alaska</li><li class="select2-selection__choice" title="California" data-select2-id="166"><span class="select2-selection__choice__remove" role="presentation">×</span>California</li><li class="select2-selection__choice" title="Delaware" data-select2-id="167"><span class="select2-selection__choice__remove" role="presentation">×</span>Delaware</li><li class="select2-selection__choice" title="Texas" data-select2-id="168"><span class="select2-selection__choice__remove" role="presentation">×</span>Texas</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>--}}
                    </div>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{ $user->name }}" name="name" placeholder="Enter name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" name="email" placeholder="Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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
