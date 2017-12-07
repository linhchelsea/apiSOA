$( document ).ready( function () {
    $( ".userForm" ).validate( {
        rules: {
            email: {
                required: true,
                email: true,
                minlength: 7,
                maxlength: 200
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

    $( ".lessonForm" ).validate( {
        rules: {
            LessonNameEn: {
                required: true,
                maxlength: 100
            },
            LessonNameVi: {
                required: true,
                maxlength: 100
            }
        }
    });

    $( ".sentenceForm" ).validate( {
        rules: {
            EngSentence: {
                required: true,
                minlength: 2
            },
            VieSentence: {
                required: true,
                minlength: 2
            }
        }
    });

    $( ".topicForm" ).validate( {
        rules: {
            EngName: {
                required: true,
                minlength: 2,
                maxlength: 100
            },
            VieName: {
                required: true,
                minlength: 2,
                maxlength: 100
            }
        }
    });

    $( ".vocabularyForm" ).validate( {
        rules: {
            VocaEn: {
                required: true,
                maxlength: 100
            },
            VocaVi: {
                required: true,
                maxlength: 100
            },
            VocaPronouce: {
                required: true,
                maxlength: 100
            },
            VocaExample: {
                required: true,
                minlength: 5
            },
            VocaExplain: {
                required: true,
                minlength: 5
            }
        }
    });
});