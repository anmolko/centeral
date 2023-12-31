@extends('backend.layouts.master')
@section('title') Teams @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')


    <div class="page-content">
        <div class="container-fluid" style="position:relative;">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Teams</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Teams</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            {!! Form::open(['route' => 'teams.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-7">
                    <div class="card ctm-border-radius shadow-sm grow flex-fill">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                Team details
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Name <span class="text-muted text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                                <div class="invalid-feedback">
                                    Please enter the name.
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Post  <span class="text-muted text-danger">*</span></label>
                                <input type="text" class="form-control" name="post" required>
                                <div class="invalid-feedback">
                                    Please enter the post.
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>FB link </label>
                                <input type="url" class="form-control" name="fb">
                                <div class="invalid-feedback">
                                    Please enter the fb link.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Twitter link </label>
                                <input type="url" class="form-control" name="twitter">
                                <div class="invalid-feedback">
                                    Please enter the twitter link.
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success w-sm mt-4" >Add Team</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card ctm-border-radius shadow-sm grow flex-fill">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                Team Image Details <span class="text-muted text-danger">*</span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div style="margin: auto;width: 60%;">
                                <img  id="current-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                <input  type="file" accept="image/png, image/jpeg" hidden
                                        id="profile-foreground-img-file-input" onchange="loadbasicFile('profile-foreground-img-file-input','current-img',event)" name="image" required
                                        class="profile-foreground-img-file-input" >

                                <div class="invalid-feedback" >
                                    Please select a image.
                                </div>
                                <span class="ctm-text-sm">*use image minimum of 365 x 365px</span>

                                <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                </label>
                            </div>
                            <div class="form-group mb-3">
                                <label>Instagram link </label>
                                <input type="url" class="form-control" name="insta">
                                <div class="invalid-feedback">
                                    Please enter the Instagram link.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Linkedin </label>
                                <input type="url" class="form-control" name="linkedin">
                                <div class="invalid-feedback">
                                    Please enter the Linkedin link.
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="company-doc">
                        <div class="card ctm-border-radius shadow-sm grow">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block mb-0">
                                    Team List
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive  mt-3 mb-1">
                                    <table id="client-index" class="table align-middle table-nowrap table-striped">
                                        <thead class="table-light">
                                        <tr>
                                            <th width="30px">#</th>
                                            <th>Team Image</th>
                                            <th>Name</th>
                                            <th>Post</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tablecontents">
                                        @if(@$teams)
                                            @foreach($teams as  $team)
                                                <tr class="row1" data-id="{{ $team->id }}">
                                                    <td class="pl-3" style="font-size: 20px"><i class=" ri-drag-move-2-fill"></i></td>
                                                    <td class="align-middle pt-6 pb-4 px-6">
                                                        <img src="<?php if(!empty($team->image)){ echo '/images/teams/'.$team->image; } else{  echo 'assets/backend/images/users/user-dummy-img.jpg'; } ?>" alt="{{@$team->name}}" class="figure-img rounded avatar-lg">

                                                    </td>
                                                    <td>{{ucfirst(@$team->name)}}</td>
                                                    <td>{{(!empty($team->post) ? $team->post:"")}}</td>
                                                    <td>
                                                        <div class="row">

                                                            <div class="col text-center dropdown">
                                                                <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                    <li><a class="dropdown-item action-edit" href="#" hrm-update-action="{{route('teams.update',$team->id)}}" hrm-edit-action="{{route('teams.edit',$team->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                    <li><a class="dropdown-item action-delete" cs-delete-route="{{route('teams.destroy',$team->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editTeam" tabindex="-1" aria-hidden="true">
        <form action="#" method="post" id="deleted-form" >
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
        </form>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="myModalLabel">Page Structure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-content">
                    {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateteams','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

                    <div class="modal-body">

                        <h4 class="modal-title mb-3">Edit Teams</h4>

                        <h4 class="modal-title mb-3">Edit Clients</h4>
                        <div class="row">

                            <div class="col-md-7">
                                <div class="card ctm-border-radius shadow-sm flex-fill">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">
                                            Team Details
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label>Name <span class="text-muted text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                            <div class="invalid-feedback">
                                                Please enter the name.
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Post  <span class="text-muted text-danger">*</span></label>
                                            <input type="text" class="form-control" name="post" id="post" required>
                                            <div class="invalid-feedback">
                                                Please enter the post.
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>FB link </label>
                                            <input type="url" class="form-control" name="fb" id="fb">
                                            <div class="invalid-feedback">
                                                Please enter the fb link.
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Twitter link </label>
                                            <input type="url" class="form-control" name="twitter" id="twitter">
                                            <div class="invalid-feedback">
                                                Please enter the twitter link.
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card ctm-border-radius shadow-sm flex-fill">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">
                                            Team Image Details <span class="text-muted text-danger">*</span>
                                        </h4>
                                    </div>
                                    <div class="card-body">

                                        <div style="margin: auto;width: 60%;">
                                            <img id="current-edit-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                            <input  type="file" accept="image/png, image/jpeg" hidden
                                                    id="image-edit" onchange="loadbasicFile('image-edit','current-edit-img',event)" name="image"
                                                    class="profile-foreground-img-file-input" >
                                            <div class="invalid-feedback" >
                                                Please select a image.
                                            </div>
                                            <span class="ctm-text-sm">*use image minimum of 365 x 365px</span>

                                            <label for="image-edit" class="profile-photo-edit btn btn-light feature-image-button">
                                                <i class="ri-image-edit-line align-bottom me-1"></i> Update Image
                                            </label>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Instagram link </label>
                                            <input type="url" class="form-control" name="insta" id="insta">
                                            <div class="invalid-feedback">
                                                Please enter the Instagram link.
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Linkedin </label>
                                            <input type="url" class="form-control" name="linkedin" id="linkedin">
                                            <div class="invalid-feedback">
                                                Please enter the Linkedin link.
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-success w-sm mt-4">Update</button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery-ui.min.js')}}"></script>

    <script type="text/javascript">

        var loadbasicFile = function(id1,id2,event) {
            var image       = document.getElementById(id1);
            var replacement = document.getElementById(id2);
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };


        $(document).ready(function () {
            $('#client-index').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            });

            $( "#tablecontents" ).sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {
                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');
                $('tr.row1').each(function(index,element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index+1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('teams.order') }}",
                    data: {
                        order: order,
                        _token: token
                    },
                    success: function(response) {

                        if (response.status == "200") {
                            Swal.fire({
                                html: '<div class="mt-2">' +
                                    '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                                    'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                                    '</lord-icon>' +
                                    '<div class="mt-4 pt-2 fs-15">' +
                                    '<h4>Success !</h4>' +
                                    '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                    '</div>' +
                                    '</div>',
                                timerProgressBar: !0,
                                timer: 2e3,
                                showConfirmButton: !1
                            });
                        } else {
                            Swal.fire({
                                html: '<div class="mt-2">' +
                                    '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                                    ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                                    'style="width:120px;height:120px"></lord-icon>' +
                                    '<div class="mt-4 pt-2 fs-15">' +
                                    '<h4>Oops...! </h4>' +
                                    '<p class="text-muted mx-4 mb-0">' + response +'</p>' +
                                    '</div>' +
                                    '</div>',
                                timerProgressBar: !0,
                                timer: 3000,
                                showConfirmButton: !1
                            });

                        }
                    }
                });
            }

            $(document).on('click', '.action-edit', function (e) {
                e.preventDefault();
                var url = $(this).attr('hrm-edit-action');
                // console.log(action)
                var id = $(this).attr('id');
                var action = $(this).attr('hrm-update-action');

                $.ajax({
                    url: $(this).attr('hrm-edit-action'),
                    type: "GET",
                    cache: false,
                    dataType: 'json',
                    success: function (dataResult) {
                        // $('#id').val(data.id);
                        $("#editTeam").modal("toggle");
                        $('#name').attr('value',dataResult.name);
                        if(dataResult.post !== null){
                            $('#post').attr('value',dataResult.post);
                        }
                        if(dataResult.fb !== null){
                            $('#fb').attr('value',dataResult.fb);
                        }
                        if(dataResult.insta !== null){
                            $('#insta').attr('value',dataResult.insta);
                        }
                        if(dataResult.twitter !== null){
                            $('#twitter').attr('value',dataResult.twitter);
                        }
                        if(dataResult.linkedin !== null){
                            $('#linkedin').attr('value',dataResult.linkedin);
                        }
                        if(dataResult.image !== null) {
                            $('#current-edit-img').attr("src", '/images/teams/' + dataResult.image);
                        }
                        $('.updateteams').attr('action',action);

                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            });


            $(document).on('click','.action-delete', function (e) {
                e.preventDefault();
                var form = $('#deleted-form');
                var action = $(this).attr('cs-delete-route');
                form.attr('action',action);
                var url = form.attr('action');
                var form_data = form.serialize();
                Swal.fire({
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                        ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                        'style="width:120px;height:120px"></lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Are your sure? </h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'You want to Remove this Record ?</p>' +
                        '</div>' +
                        '</div>',
                    showCancelButton: !0,
                    confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-danger w-xs mt-2",
                    confirmButtonText: "Yes!",
                    buttonsStyling: !1,
                    showCloseButton: !0
                }).then(function(t)
                {
                    t.value
                        ?
                        $.post( url, form_data)
                            .done(function(response) {
                                if(response.status == "success") {
                                    Swal.fire({
                                        html: '<div class="mt-2">' +
                                            '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                                            'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                                            '</lord-icon>' +
                                            '<div class="mt-4 pt-2 fs-15">' +
                                            '<h4>Success !</h4>' +
                                            '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                            '</div>' +
                                            '</div>',
                                        timerProgressBar: !0,
                                        timer: 2e3,
                                        showConfirmButton: !1
                                    });
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 2500);
                                }else{
                                    Swal.fire({
                                        html: '<div class="mt-2">' +
                                            '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                                            ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                                            'style="width:120px;height:120px"></lord-icon>' +
                                            '<div class="mt-4 pt-2 fs-15">' +
                                            '<h4>Oops...! </h4>' +
                                            '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                            '</div>' +
                                            '</div>',
                                        timerProgressBar: !0,
                                        timer: 3000,
                                        showConfirmButton: !1
                                    });
                                }
                            })
                            .fail(function(response){
                                console.log(response)
                            })

                        :
                        t.dismiss === Swal.DismissReason.cancel &&
                        Swal.fire({
                            title: "Cancelled",
                            text: "Team details was not removed.",
                            icon: "error",
                            confirmButtonClass: "btn btn-primary mt-2",
                            buttonsStyling: !1
                        });
                });



            });

        });


    </script>
@endsection



