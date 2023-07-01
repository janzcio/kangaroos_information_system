@extends('layouts.authenticated.layout')

@section('title', 'Edit Kangaroo')
@section('page_name', 'Edit Kangaroo page')
@section('page_description', 'Edit Kangaroo page')

@section('extend-css')
@endsection


@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('web.kangaroos.index') }}"> <i class="ti-harddrives"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('web.kangaroos.index') }}">Kangaroos</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('web.kangaroos.edit', $kangaroo->id) }}">Edit kangaroo</a>
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
                        <h5>Edit kangaroo Form</h5>
                    </div>
                    <div class="card-block">
                        @include('pages.kangaroos.form', ['isEdit' => true, 'submitButton' => 'Update', 'formId' => 'id-update-kangaroos-form'])
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
    const formUpdate = document.getElementById('id-update-kangaroos-form');

    formUpdate.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent form submission
        
        const urlApi = formUpdate.getAttribute("data-href");

        // Clear previous error messages
        clearErrors();

        // Get form data
        const formData = new FormData(formUpdate);

        // Make API request using Axios
        axios.post(urlApi, formData)
            .then((response) => {
                // Handle successful submission
                // formUpdate.reset(); // Reset form after successful submission
                showNofif('success', "Successs!", "Kangaroo successfully updated.")
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
        $('.form-danger').each(function(){
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