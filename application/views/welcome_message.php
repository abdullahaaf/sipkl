                        <!--First row-->
            <div class="row">
                <div class="col-md-7">
                    <!--Featured image -->
                    <div class="view overlay hm-white-light z-depth-1-half">
                        <img src="http://mdbootstrap.com/images/proffesions/slides/socialmedia/img%20(2).jpg" class="img-fluid " alt="">
                        <div class="mask">
                        </div>
                    </div>
                    <br>
                </div>

                <!--Main information-->
                <div class="col-md-5">
                    <h2 class="h2-responsive">We are professionals</h2>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis pariatur quod ipsum atque quam dolorem voluptate officia sunt placeat consectetur alias fugit cum praesentium ratione sint mollitia, perferendis natus quaerat!</p>

                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-register">
                    Modal Register
                    </button>

                    <div class="input-field col s12">
                        <select class="form-control">
                          <option value="" disabled selected>Choose your option</option>
                          <option value="1">Option 1</option>
                          <option value="2">Option 2</option>
                          <option value="3">Option 3</option>
                        </select>
                        <label>Materialize Select</label>
                      </div>

                    <select class="mdb-select">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="" data-icon="http://mdbootstrap.com/wp-content/uploads/2015/10/avatar-1.jpg" class="rounded-circle">example 1</option>
                        <option value="" data-icon="http://mdbootstrap.com/wp-content/uploads/2015/10/avatar-2.jpg" class="rounded-circle">example 2</option>
                        <option value="" data-icon="http://mdbootstrap.com/wp-content/uploads/2015/10/avatar-3.jpg" class="rounded-circle">example 1</option>
                    </select>
                    <label>Example label</label>


                </div>
            </div>
            <!--/.First row-->

            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    <fieldset class="form-group">
                                        <input type="checkbox" id="checkbox1">
                                        <label for="checkbox1"></label>
                                    </fieldset>
                                </td>
                                <td>Ashley</td>
                                <td>Lynwood</td>
                                <td>@ashow</td>
                                <td>
                                    <a class="blue-text"><i class="fa fa-user"></i></a>
                                    <a class="teal-text" data-toggle="modal" data-target="#modal-register"><i class="fa fa-pencil"></i></a>
                                    <a class="red-text"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>
                                    <fieldset class="form-group">
                                        <input type="checkbox" id="checkbox2">
                                        <label for="checkbox2"></label>
                                    </fieldset>
                                </td>
                                <td>Billy</td>
                                <td>Cullen</td>
                                <td>@cullby</td>
                                <td>
                                    <a class="blue-text"><i class="fa fa-user"></i></a>
                                    <a class="teal-text" data-toggle="modal" data-target="#modal-register"><i class="fa fa-pencil"></i></a>
                                    <a class="red-text"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>
                                    <fieldset class="form-group">
                                        <input type="checkbox" id="checkbox3">
                                        <label for="checkbox3"></label>
                                    </fieldset>
                                </td>
                                <td>Ariel</td>
                                <td>Macy</td>
                                <td>@arielsea</td>
                                <td>
                                    <a class="blue-text"><i class="fa fa-user"></i></a>
                                    <a class="teal-text" data-toggle="modal" data-target="#modal-register"><i class="fa fa-pencil"></i></a>
                                    <a class="red-text"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>       

            
                    
                                
<!-- Modal Register -->
<div class="modal fade modal-ext" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3><i class="fa fa-user"></i> Register with:</h3>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="md-form">
                    <i class="fa fa-envelope prefix"></i>
                    <input type="text" id="form2" class="form-control">
                    <label for="form2">Your email</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-lock prefix"></i>
                    <input type="password" id="form3" class="form-control">
                    <label for="form3">Your password</label>
                </div>

                <div class="text-xs-center">
                    <button class="btn btn-primary btn-lg">Sign up</button>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal End -->
