$( document ).ready( function () {
    $( ".userForm" ).validate( {
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            email: {
                required: true,
                minlength: 7,
                maxlength: 200,
            },
			password:{
            	required: true,
				minlength: 6,
				maxlength:32
			},
            password_confirmation:{
            	required: true,
				minlength: 6,
				maxlength:32
			},
			fullname: {
            	required: true,
				minlength: 2,
				maxlength: 100
			}
        }
    });

    $( ".userUpdateForm" ).validate( {
        rules: {
            fullname: {
                required: true,
                minlength: 2,
                maxlength: 100
            }
        }
    });

    $( ".service-detailForm" ).validate( {
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            price: {
                required: true,
                maxlength: 10,
            },
            time:{
                required: true,
            },
            description:{
                required: true,
                minlength: 6,
            }
        }
    });


    $( ".serviceForm" ).validate( {
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            preview: {
                required: true,
                minlength: 6,
                maxlength: 200,
            },
            description:{
                required: true,
                minlength: 6,
            }
        }
    });

    $( ".polishBrandForm" ).validate( {
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            price: {
                required: true,
                minlength: 1,
                maxlength: 10,
            },
            description:{
                required: true,
                minlength: 6,
            }
        }
    });
    $( ".informationForm" ).validate( {
        rules: {
            name: {
                required: true,
                minlength: 6,
                maxlength: 200,
            },
            email: {
                required: true,
                minlength: 6,
                maxlength: 200,
            },
            phone: {
                required: true,
                maxlength: 20,
            },
            facebook: {
                required: true,
                maxlength: 300,
            },
            twitter: {
                required: true,
                maxlength: 300,
            },
            instagram: {
                required: true,
                maxlength: 300,
            },
            address:{
                required: true,
                minlength: 6,
            }
        }
    });

    $( ".reviewForm" ).validate( {
        rules: {
            fullname: {
                required: true,
                minlength: 2,
                maxlength: 100
            },
            reviewContent:{
                required: true,
                minlength: 6,
            },
        }
    });
    $( ".galleryForm" ).validate( {
        rules: {
            title: {
                required: true,
                minlength: 2,
                maxlength: 200
            }
        }
    });
    $( ".giftCardForm" ).validate( {
        rules: {
            title: {
                required: true,
                minlength: 2,
                maxlength: 200
            }
        }
    });
    $( ".homeImageForm" ).validate( {
        rules: {
            title: {
                required: true,
                minlength: 2,
                maxlength: 200
            }
        }
    });

    $( ".contactForm" ).validate( {
        rules: {
            Name: {
                required: true,
            },
            Email: {
                required: true,
                email: true
            },
            Phone: {
                required: true,
            },
            Message: {
                required: true,
            }
        },
        message: {
            Name: {
                required: "Please fill in this field"
            },
            Email: {
                required: "Please fill in this field",
                email: "Invalid email format"
            },
            Phone: {
                required: "Please fill in this field",
            },
            Message: {
                required: "Please fill in this field"
            }
        }
    });

    $( ".aboutForm" ).validate( {
        ignore: [],
        rules: {
            detail: {
                required: function()
                {
                    CKEDITOR.instances.intro.updateElement();
                },
                minlength: 6
            }
        }
    });
});