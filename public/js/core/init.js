$.validator.setDefaults({
    errorClass: 'validate invalid',
    validClass: "validate valid",
    errorElement: 'div',
    errorPlacement: function(error, element) {
        console.log(error);
        var placement = $(element).data('error');
        if (placement) {
            $(placement).append(error)
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        form.submit();
    }
});
$(".form-validate").each(function() {
    var $this = $(this);
    $this.validate({
        ignore: ['.ignore, .select2-input'],
    });
});
$('#patient_id').select2({
    ajax: {
        url: "/operator/patients",
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            return {
                results: data.items,
                pagination: {
                    more: (params.page * 20) < data.total
                }
            };
        },
        cache: true
    },
    allowClear: true,
    placeholder: 'Search Patients',
    minimumInputLength: 1,
}).on('change', function () {
    $(this).valid()
});

$(".brand-logo").sideNav();

$(".dropdown-button").dropdown();

$(document).ready(function() {

    $(".select2-list").select2({
        minimumResultsForSearch: -1
    }).on('change', function(event) {
        $(this).valid();
    });;

    $('select').material_select();

    $('.collapsible').collapsible({
        accordion : false
    });

    $('.modal-trigger').leanModal({
        dismissible: false,
    });

    $('.tooltipped').tooltip({delay: 50});
});

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
});

$('.delete-link').on('click', function(event) {
    var form = $(this).next('.delete-form')
    event.preventDefault()
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this action",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4caf50",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }, function(isConfirm) {
        if (isConfirm) {
            form.submit()
        }
    });
});
$.validator.addMethod("notinzero", function(value, element, arg) {
    return value > 0;
    // if (value > 0) {
    //     return true;
    // } else {
    //     console.log(element);
    //     toastr.options.positionClass = 'toast-top-center'
    //     toastr.error('Patient Name is required')
    //     return false;
    // }
}, "Please Select Patient");