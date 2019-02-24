(function(){
// if(document.querySelector("#configuration_step")){
//     let step = document.getElementById("configuration_step").value;
//     step = parseInt(step, 10);
//     if( step === 1){
//         document.getElementById("step1").classList.remove("hidden");
//         document.getElementById("step1Save").addEventListener("click", function(e){
//             let validData = true;
//             let institution = document.getElementById("institution").value;
//             let county = document.getElementById("county").value;
//             if(institution.length <= 3){
//                 document.getElementById("institutionInfo").classList.remove("hidden");
//                 validData = false;
//             } else {
//                 document.getElementById("institutionInfo").classList.add("hidden");
//             }

//             if(parseInt(county, 10) === 0){
//                 document.getElementById("countyInfo").classList.remove("hidden");
//                 validData = false;
//             } else {
//                 document.getElementById("countyInfo").classList.add("hidden");
//             }

//             if(validData){
//                 let js_request_token = document.getElementById("js_request_token").value;
//                 let user_id = document.getElementById("user_id").value;
//                 let form = new FormData();
//                 form.append("institution", institution);
//                 form.append("county", county);
//                 form.append("js_request_token", js_request_token);
//                 form.append("_method", "POST");
//                 form.append("user_id", user_id);
                
//                 xhr = new XMLHttpRequest();
//                 xhr.open("POST", "/js/pas1", true);

//                 xhr.onload = function () {
//                     if (xhr.readyState == 4 && xhr.status == "200") {
//                         //succ
//                         let resp = xhr.response;
//                         if(parseInt(resp, 10) === 1){
//                             document.getElementById("configuration_step").value = 2;
//                             document.getElementById("step1").classList.add("hidden");
//                             document.getElementById("step2").classList.remove("hidden");
//                         }
//                     } else {
//                         //failed
//                     }
//                 };
//                 xhr.send(form);

//             }

//         });
//     } else if(step === 2){
//         document.getElementById("step2").classList.remove("hidden");
//     } else if(step === 3){
//         document.getElementById("step3").classList.remove("hidden");
//     } else if(step === 4){
//         document.getElementById("step4").classList.remove("hidden");
//     } else if(step === 5){
//         document.getElementById("step5").classList.remove("hidden");
//     } else if(step === 6){
//         document.getElementById("step6").classList.remove("hidden");
//     }
// }

let btnAddDep = document.getElementById("addDepartment");
let btnRemoveDep = document.getElementById("removeDepartment");

let btnAddUser = document.getElementById("addUser");
let btnRemoveUser = document.getElementById("removeUser");

btnAddDep.addEventListener("click", function(e){
    let depGroup = document.getElementById("departmentsGroup");
    let row = document.createElement("div");
    row.className="row mt-3";

    let col4 = document.createElement("div");
    col4.className="col-lg-4";

    let col42 = document.createElement("div");
    col42.className="col-lg-5";

    let depName = document.createElement("input");
    depName.className="form-control departmentName";
    depName.type="text";
    depName.name="departmentName[]";
    depName.placeholder="Numele departamentului";

    let depPerson = document.createElement("input");
    depPerson.className="form-control departmentPerson";
    depPerson.type="text";
    depPerson.name="departmentPerson[]";
    depPerson.placeholder="Numele persoanei care conduce departamentul";

    col4.appendChild(depName);
    col42.appendChild(depPerson);

    row.appendChild(col4);
    row.appendChild(col42);

    depGroup.appendChild(row);

});

btnRemoveDep.addEventListener("click", function(e){
    let depGroup = document.getElementById("departmentsGroup");
    if(depGroup.children.length>1){
        depGroup.removeChild(depGroup.lastChild);
    }
});

btnAddUser.addEventListener("click", function(e){
    
});

})();