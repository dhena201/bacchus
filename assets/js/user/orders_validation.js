/**
 * @author Lou
 */
$(document).ready(function() {
    $('#newOrderForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            wine_id: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The wine is required and can\'t be empty'
                    }
                }
            },
            location_id: {
                validators: {
                    notEmpty: {
                        message: 'The location is required and can\'t be empty'
                    }
                }
            },
            quantity: {
                validators: {
                   digits: {
                        message: 'The quantity can contain only digits'
                   },
                   notEmpty: {
                        message: 'The quantity is required and can\'t be empty'
                    }
                }
            },
            estimated_arrival: {
                validators: {

                }
            },
            order_comments: {
                validators: {

                }
            }
        }
    });
});