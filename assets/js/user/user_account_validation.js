/**
 * @author Lou
 */
$(document).ready(function() {
	
    $('#editUserForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            first_name: {
                validators: {
                    
                }
            },
            last_name: {
                validators: {

                }
            },
            company: {
                validators: {

                }
            },
            phone: {
                validators: {
					/*digits: {
						message: 'The phone number can only contain digits'
					}*/
                }
            }
        }
    });
    $('#editUserPasswordForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            old: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The current password is required and can\'t be empty'
                    }
                }
            },
            new: {
                validators: {
                   notEmpty: {
                        message: 'The new password is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The password must be more than 6 and less than 30 characters long'
                    },
                    identical: {
                        field: 'new_confirm',
                        message: 'The password and its confirm are not the same'
                    }
                }
            },
            new_confirm: {
                validators: {
                    notEmpty: {
                        message: 'The new confirm password is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The confirm password must be more than 6 and less than 30 characters long'
                    },
                    identical: {
                        field: 'new',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    });
});