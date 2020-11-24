@extends('admin_layout')
@section('admin_content')


    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($user_edit as $key => $userr_edit)
                            <form role="form" action="{{ URL::to('/update-user/' . $userr_edit->id) }}"
                                method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên người dùng</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="user_name"
                                        value="{{ $userr_edit->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">email người dùng</label>
                                    <Textarea style="resize: none" rows="5" class="form-control" id="exampleInputPassword1"
                                        name="user_email">{{ $userr_edit->email }}</Textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">password</label>
                                    <Textarea disabled style="resize: none" rows="5" class="form-control" id="exampleInputPassword1"
                                        name="user_password">{{ $userr_edit->password }}</Textarea>
                                </div>

                                <button type="submit" class="btn btn-info" name="add_category_product">Sửa danh
                                    mục</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
