@extends('admin/layout')
@extends('admin/menu')

@section('menu')
    <div>

        <div> <label class="alert alert-warning"> <a href="{{ route('admin.category.add') }}" data-toggle="modal"
                    data-target="#addMenuModal" class="btn btn-success">{{ request()->root_id > 0 ? 'ქვე' : '' }}კატეგორიის დამატება</a> </label>

        </div>


        <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
            <form action="{{ route('admin.category.index') }}" method="get">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> {{ request()->root_id > 0 ? 'ქვე' : '' }}კატეგორიის დამატება</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            სათაური KA <input type="text" name="name_ka" required /> <br>
                            სათაური EN <input type="text" name="name_en" required /><br>
                                  <input type="hidden" name="root_id" value="{{ request()->id > 0 ? request()->id : $categories->root_id = 0 }}">

                            <label>დამალვა მენიუს ზოლიდან </label>

                            <input type="checkbox" name="check" value="1">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">დახურვა</button>
                            <button type="submit" name="addmenu" class="btn btn-primary">შენახვა</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>



    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">დასახელება KA</th>
                <th scope="col">დასახელება EN</th>
                <th scope="col">პოზიცია</th>
                <th scope="col">რედაქტირება</th>
                <th scope="col">HIDE</th>
                <th scope="col">წაშლა</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row"> <a
                            href="{{ route('admin.category.index', ['id' => $category->id]) }}&root_id={{ $category->id }}">
                            {{ $category->name_ka }}
                        </a>
                    </th>
                    <th scope="row"> {{ $category->name_en }}</th>
                    <th>
                        @if ($loop->index < $categories->count() - 1)
                            <a href="{{ route('admin.category.index', ['id' => (int)request()->root_id]) }}&down={{ $category->id }}&root_id={{ (int)request()->root_id }}">
                                <i class="fa fa-arrow-down"></i> </a>
                        @endif

                        @if ($loop->index > 0)
                            <a href="{{ route('admin.category.index', ['id' => (int)request()->root_id]) }}&up={{ $category->id }}&root_id={{ (int)request()->root_id }}">
                                <i class="fa fa-arrow-up"></i> </a>
                        @endif

                    </th>
                    <td><a class="btn btn-warning" href="{{ route('admin.category.edit', $category->id) }}"">EDIT</a>
                    </td>
                    <td>

                        @if (!empty($category->check))
          <a href="{{ route('admin.category.index', ['id'=>$category->id]) }}&show={{ $category->id }}"> <i class="fas fa-eye-slash"></i> </a>
          @else <a href="{{ route('admin.category.index', ['id'=>$category->id]) }}&hide={{ $category->id }}"><i class="fas fa-eye"></i> </a>
          @endif

                       </td>
                    <td>

                        <a onclick="return confirm('ნამდვილად გსურთ წაშლა?');" class="btn btn-danger"
                        href="{{ route('admin.category.delete', $category->id) }}">Delete</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
