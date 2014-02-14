/**
 * @author Lou
 */
$(document).ready(function() {
    $('#newLocationForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            name: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 50,
                        message: 'The name must be more than 2 and less than 50 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The name can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            address_line_1: {
                validators: {
                    notEmpty: {
                        message: 'The address line 1 is required and can\'t be empty'
                    }
                }
            },
            address_line_2: {
                validators: {

                }
            },
            city: {
                validators: {

                }
            },
            state_province_region: {
                validators: {

                }
            },
            postal_code: {
                validators: {
                    /*usZipCode: {
                        message: 'The input is not a valid US zip code'
                    }*/
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'The country is required and can\'t be empty'
                    }
                }
            },
            location_comments: {
                validators: {

                }
            }
        }
    });
});