@extends('layouts.authenticated.layout')

@section('title', 'Create Kangaroo')
@section('page_name', 'Create Kangaroo')
@section('page_description', 'Create Kangaroo page')

@section('extend-css')

@endsection


@section('breadcrumb')
<div id="#msgs"></div>
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('web.kangaroos.index') }}"> <i class="ti-harddrives"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('web.kangaroos.index') }}">Kangaroos</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('web.kangaroos.create') }}">Create new kangaroo</a>
    </li>
</ul>

@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create New kangaroo Form</h5>
                    </div>
                    <div class="card-block">
                        @include('pages.kangaroos.form', ['isEdit' => false, 'submitButton' => 'Submit', 'formId' => 'id-save-kangaroos-form'])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('extend-js')
<script>
    // Get the form element and attach a submit event listener
    const formCreate = document.getElementById('id-save-kangaroos-form');

    formCreate.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent form submission

        const urlApi = formCreate.getAttribute("data-href");

        // Clear previous error messages
        clearErrors();

        // Get form data
        const formData = new FormData(formCreate);

        // Make API request using Axios
        axios.post(urlApi, formData)
            .then((response) => {
                // Handle successful submission
                console.log(response.data);
                formCreate.reset(); // Reset form after successful submission
                showNofif('success', "Successs!", "Kangaroo successfully saved.")
            })
            .catch((error) => {
                // Handle submission errors
                if (error.response.status === 422) {
                    const errors = error.response.data.errors;

                    // Display validation errors
                    displayErrors(errors);
                } else {
                    // Handle other errors
                    console.error(error);
                }
            });
    });

    // Function to display validation errors
    function displayErrors(errors) {
        Object.keys(errors).forEach((key) => {
            const fieldName = errors[key].field;
            const errorMessage = errors[key].message;

            $("#" + fieldName).closest('.form-group').addClass('form-danger').focus();
            showNofif('danger', fieldName, errorMessage);
        });
    }

    // Function to clear error messages
    function clearErrors() {
        $('.form-danger').each(function() {
            $(this).removeClass('form-danger')
        })
    }

    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection