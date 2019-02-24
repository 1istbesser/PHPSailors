(function(){
    function hasNumber(myString) {
        return /\d/.test(myString);
    }
    if(document.getElementById("registerForm")){
        let formObj = document.getElementById("registerForm");
        formObj.addEventListener("submit", function(e){
            e.preventDefault();
            var loader = document.getElementById("form-status");
            loader.className ="mx-auto my-5";
            loader.innerHTML="";
            let valid = true;

            let nume = document.getElementById("nume").value;
            let prenume = document.getElementById("prenume").value;
            let email = document.getElementById("email").value;
            let parola = document.getElementById("parola").value;

            if(prenume.length < 2){
                document.getElementById("prenume-info").textContent="Completeaza prenumele";
                valid = false;
            } else {
                document.getElementById("prenume-info").textContent="";
            }

            if(nume.length < 2){
                document.getElementById("nume-info").textContent="Completeaza numele";
                valid = false;
            } else {
                document.getElementById("nume-info").textContent="";
            }

            if(email.length < 2){
                document.getElementById("email-info").textContent="Completeaza emailul";
                valid = false;
            } else {
                document.getElementById("email-info").textContent="";
            }

            if(parola.length < 8 || !hasNumber(parola)){
                document.getElementById("parola-info").textContent="Parola trebuie sa contina minim 8 caractere si o cifra.";
                valid = false;
            } else {
                document.getElementById("parola-info").textContent="";
            }

            if(valid){
                loader.classList.add("loader");
                let form = new FormData();
                form.append("nume", nume);
                form.append("prenume", prenume);
                form.append("email", email);
                form.append("parola", parola);
                form.append("_method", "POST");
                
                xhr = new XMLHttpRequest();
                xhr.open("POST", "/inregistrare", true);
                xhr.upload.onprogress = function (e) {
                    
                }
                xhr.upload.onloadstart = function (e) {
                
                }

                xhr.onload = function () {
                    setTimeout(function(){ 
                        loader.classList.remove("loader");
                        
                    }, 1200);
                    if (xhr.readyState == 4 && xhr.status == "200") {
                        setTimeout(function(){ 
                            loader.classList.add("text-success");
                            let p = document.createElement("p");
                            p.textContent="Contul tau a fost inregistrat cu succes!";
                            loader.appendChild(p);
                            formObj.reset();
                        }, 1200);
                    } else {
                        setTimeout(function(){ 
                            loader.classList.add("text-danger");
                            let p = document.createElement("p");
                            p.textContent="Inregistrarea a esuat!";
                            loader.appendChild(p);
                            formObj.reset();
                        }, 1200);
                    }
                };
                xhr.send(form);
            }
        });
    }
    if(document.querySelector(".btn-update")){
        let updateBtns = document.getElementsByClassName("btn-update");
        Array.from(updateBtns).forEach(function(btn){
            btn.addEventListener("click", function(e){
                let meta = btn.parentElement.parentElement.querySelector(".meta-data");
                document.querySelector("#userID").value = meta.dataset.id;
                document.querySelector("#modalEditUser").value = meta.dataset.username;
                document.querySelector("#modalEditName").value = meta.dataset.name;
                document.querySelector("#modalEditEmail").value = meta.dataset.email;

                let group = meta.dataset.level;
                let institution = meta.dataset.institution;
                let department = meta.dataset.department;
                let status = meta.dataset.status;

                let groupOptions = document.querySelector("#modalEditGroup").options;
                Array.from(groupOptions).forEach(function(gr){
                    if(group === gr.value){
                        gr.selected=true;
                    }
                });

                let statusOptions = document.querySelector("#modalEditStatus").options;
                Array.from(statusOptions).forEach(function(st){
                    if(status === st.value){
                        st.selected=true;
                    }
                });

                let institutionOptions = document.querySelector("#modalEditInstitution").options;
                Array.from(institutionOptions).forEach(function(ins){
                    if(institution === ins.value){
                        ins.selected=true;
                    }
                });

                let departmentOptions = document.querySelector("#modalEditDepartment").options;
                Array.from(departmentOptions).forEach(function(dep){
                    if(department === dep.value){
                        dep.selected=true;
                    }
                });

                $('#editUserModal').modal('show');
            });
        });
    }
    if(document.querySelector(".btn-update-institution")){
        let updateBtns = document.getElementsByClassName("btn-update-institution");
        Array.from(updateBtns).forEach(function(btn){
            btn.addEventListener("click", function(e){
                let meta = btn.parentElement.parentElement.querySelector(".meta-data");
                document.querySelector("#institutionID").value = meta.dataset.id;
                document.querySelector("#modalEditName").value = meta.dataset.name;
                document.querySelector("#modalEditCounty").value = meta.dataset.county;

                let county = meta.dataset.countyid;
                let status = meta.dataset.status;

                let statusOptions = document.querySelector("#modalStatus").options;
                Array.from(statusOptions).forEach(function(gr){
                    if(status === gr.value){
                        gr.selected=true;
                    }
                });

                let countyOptions = document.querySelector("#modalEditCounty").options;
                Array.from(countyOptions).forEach(function(gr){
                    if(county === gr.value){
                        gr.selected=true;
                    }
                });


                $('#institutionModal').modal('show');
            });
        });
    }
    if(document.querySelector(".btn-update-department")){
        let updateBtns = document.getElementsByClassName("btn-update-department");
        Array.from(updateBtns).forEach(function(btn){
            btn.addEventListener("click", function(e){
                let meta = btn.parentElement.parentElement.querySelector(".meta-data");
                document.querySelector("#departmentID").value = meta.dataset.id;
                document.querySelector("#modalEditName").value = meta.dataset.name;
                document.querySelector("#modalEditResponsible").value = meta.dataset.responsible;
                

                let institution = meta.dataset.institution;

                let institutionOptions = document.querySelector("#modalEditInstitution").options;
                Array.from(institutionOptions).forEach(function(gr){
                    if(institution === gr.value){
                        gr.selected=true;
                    }
                });

                $('#departmentModal').modal('show');
            });
        });
    }
    if(document.querySelector("#addProfessionalFormation")){
        document.querySelector("#addProfessionalFormation").addEventListener("click", function(e){
            $('#professionalFormationModal').modal('show');
        });
    }
    if(document.querySelector("#radioBtn")){
        $('#radioBtn a').on('click', function(){
            var sel = $(this).data('title');
            var tog = $(this).data('toggle');
            $('#'+tog).prop('value', sel);
    
            $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
            $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
        })
    }
    if(document.querySelector("#addInstitution")){
        document.getElementById("addInstitution").addEventListener("click", function(e){
            $('#newInstitutionModal').modal('show');
        });
    }
    if(document.querySelector("#addDepartment")){
        document.getElementById("addDepartment").addEventListener("click", function(e){
            $('#newDepartmentModal').modal('show');
        });
    }
    if(document.querySelector("#addUser")){
        document.getElementById("addUser").addEventListener("click", function(e){
            $('#newUserModal').modal('show');
        });
    }
})();