<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Application with Image Upload AJAX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</head>

<body>
    {{-- add new student modal start --}}
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="" id="add_student_form" enctype="multipart/form-data">

                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="my-2">
                                <label for="student_id">Student ID:</label>
                                <input type="text" id="student_id" class="form-control" placeholder="Student ID"
                                    required>
                            </div>
                            <div class="col-lg">
                                <label for="fname">First Name</label>
                                <input type="text" id="fname" class="form-control" placeholder="First Name"
                                    required>
                            </div>
                            <div class="col-lg">
                                <label for="lname">Last Name</label>
                                <input type="text" id="lname" class="form-control" placeholder="Last Name"
                                    required>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="my-2">
                            <label for="avatar">Select Photo</label>
                            <input type="file" id="avatar" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="add_student_btn" class="btn btn-primary">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add new student modal end --}}

    {{-- edit student modal start --}}
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="stu_id" id="stu_id">
                    <input type="hidden" name="stu_avatar" id="stu_avatar">
                    <div class="modal-body p-4 bg-light">
                        <div class="my-2">
                            <label for="studen_id">StudentId</label>
                            <input type="text" name="student_id" id="student_id" class="form-control"
                                placeholder="Student Id" required>
                        </div>
                        <div class="row">
                            <div class="col-lg">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control"
                                    placeholder="First Name" required>
                            </div>
                            <div class="col-lg">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control"
                                    placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="E-mail" required>
                        </div>
                        <div class="my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control"
                                placeholder="Phone" required>
                        </div>
                        <div class="my-2">
                            <label for="avatar">Select Photo</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                        <div class="mt-2" id="avatar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit_student_btn" class="btn btn-success">Update
                            Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit student modal end --}}

    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                        <h3 class="text-light">Manage Students</h3>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i
                                class="bi-plus-circle me-2"></i>Add New
                            Student</button>
                    </div>
                    <div class="card-body" id="show_all_students">
                        <h1 class="text-center text-secondary my-5">Loading...</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //add new stu ajax
        $(document).ready(function() {

            $('#add_student_btn').click(function(e) {
                e.preventDefault();

                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

                var data = {
                    'student_id': $('#student_id').val(),
                    'fname': $('#fname').val(),
                    'lname': $('#lname').val(),
                    'email': $('#email').val(),
                    'phone': $('#phone').val(),
                    'avatar': $('#avatar').val(),
                }

                $('#add_student_btn').text('Adding Student..');
                console.log(data);

                $.ajax({
                    type: "POST",
                    url: "{{ route('store') }}",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Added',
                                'Student Added Succesfully!',
                                'success'
                            )
                        }
                        $('#add_student_btn').text('Add Student');
                        $('#add_student_form')[0].reset();
                        $('#addStudentModal').modal('hide');
                    }
                });

            });
        });
    </script>


</body>

</html>
