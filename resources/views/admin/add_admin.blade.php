@extends('admin_layout')
@section('admin_content')


    <div class="row">
    <?php
                    $message = Session::get('message');
                    if ($message) {
                    echo ' <div class="badge badge-light">
                        ' .
                        $message .
                        '</div>';
                    Session::put('message', null);
                    }
                    ?>
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm người quản trị
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    <form role="form" action="{{URL::to('/save-add-admin')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên người quản trị </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                    name="admin_name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                    name="admin_email" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">PassWord </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                    name="admin_password" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                                    name="admin_phone" required>
                            </div>
                           
                            <button type="submit" class="btn btn-info" name="add_category_product">Thêm người quản trị</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </div>
@endsection
