/**
 * @author Lou
 */
$(document).ready(function() {
    $('#newUserForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            email: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 16,
                        message: 'The username must be more than 3 and less than 16 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    },
                    different: {
                        field: 'password',
                        message: 'The username and password can\'t be the same as each other'
                    }
                }
            },
            password: {
                validators: {
                   notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 20,
                        message: 'The password must be more than 6 and less than 20 characters long'
                    },
                    identical: {
                        field: 'cpassword',
                        message: 'The password and its confirmation are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password can\'t be the same as username'
                    }
                }
            },
            cpassword: {
                validators: {
					notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                   stringLength: {
                        min: 6,
                        max: 20,
                        message: 'The confirm password must be more than 6 and less than 20 characters long'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirmation are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'The password can\'t be the same as username'
                    }
                }
            }
        }
    });
    
    $('#loginUserForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            identity: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Email/Username is required and can\'t be empty'
                    }
                }
            },
            password: {
                validators: {
                   notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    }
                }
            }
        }
    });
    
    $('#forgotPasswordForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            email: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            }
        }
    });
    
    $('#resetPasswordForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
			new: {
                validators: {
                   notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 20,
                        message: 'The password must be more than 6 and less than 20 characters long'
                    },
                    identical: {
                        field: 'new_confirm',
                        message: 'The password and its confirmation are not the same'
                    }
                }
            },
            new_confirm: {
                validators: {
					notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                   stringLength: {
                        min: 6,
                        max: 20,
                        message: 'The confirm password must be more than 6 and less than 20 characters long'
                    },
                    identical: {
                        field: 'new',
                        message: 'The password and its confirmation are not the same'
                    }
                }
            }
        }
    });
    
    $('#changePasswordForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
			old: {
                validators: {
                   notEmpty: {
                        message: 'The current password is required and can\'t be empty'
                    }
                }
            },
			new: {
                validators: {
                   notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 20,
                        message: 'The password must be more than 6 and less than 20 characters long'
                    },
                    identical: {
                        field: 'new_confirm',
                        message: 'The password and its confirmation are not the same'
                    }
                }
            },
            new_confirm: {
                validators: {
					notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                   stringLength: {
                        min: 6,
                        max: 20,
                        message: 'The confirm password must be more than 6 and less than 20 characters long'
                    },
                    identical: {
                        field: 'new',
                        message: 'The password and its confirmation are not the same'
                    }
                }
            }
        }
    });
});