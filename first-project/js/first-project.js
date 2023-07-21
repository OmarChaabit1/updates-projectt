// uodate and remove users 
function script(){

    this.initialize = function(){
        this.registerEvents();
    },
    this.registerEvents = function(){
        document.addEventListener("click",function(e){
            targetElement = e.target; 
            classList = targetElement.classList; 
    
    
            if(classList.contains("deleteUser")){
                e.preventDefault();
                userId = targetElement.dataset.userid;
                fname = targetElement.dataset.fname;
                lname = targetElement.dataset.lname;
                fullName = fname + ' ' + lname ; 
    
            BootstrapDialog.confirm({
                type: BootstrapDialog.TYPE_DANGER,
                message: "Are You sure to delete " + fullName + "?",
                callback: function(isDelete){
                    $.ajax({
                        method: 'POST',
                        data: {
                            user_id: userId,
                            f_name: fname,
                            l_name: lname
                        },
                        url:'database/delete-user.php',
                        dataType: 'json',
                        success: function(data){
                            if(data.success){
                                BootstrapDialog.alert({
                                    type: BootstrapDialog.TYPE_SUCCESS,
                                    message: data.message,
                                    callback: function(){
                                        location.reload();
                                    }
                                });
                            }
                            else {
                                BootstrapDialog.alert({
                                    type: BootstrapDialog.TYPE_DANGER,
                                    message: data.message,
                                });
                            }
                        }
                    });
                }
            });
        }
            if(classList.contains("updateUser")){
    
                e.preventDefault(); // --> prevent loading
                
                // --> Get data
                  const firstName = targetElement.closest("tr").querySelector("td.firstName").innerHTML;
                  const lastName = targetElement.closest("tr").querySelector("td.lastName").innerHTML;
                  const email = targetElement.closest("tr").querySelector("td.email").innerHTML;
                  const userId = targetElement.dataset.userid;
    
                        BootstrapDialog.confirm({
                                    title: "Update " + firstName + " " + lastName,
                                    message:'<form>\
                                    <div class="form-group">\
                                            <label for="firstName">firs Name:</label>\
                                            <input type="text" class="form-control" id="firstNameUpdate" value="'+ firstName +'">\
                                    </div>\
                                    <div class="form-group">\
                                            <label for="lastName">lastName:</label>\
                                            <input type="text" class="form-control" id="lastNameUpdate" value="'+ lastName +'">\
                                    </div>\
                                    <div class="form-group">\
                                            <label for="email">Email adresse:</label>\
                                            <input type="email" class="form-control" id="emailUpdate" value="'+ email +'">\
                                        </div>\
                                    </form>',
                                        callback: function(isUpdate){
                                        if(isUpdate){
                                    $.ajax({
                                        method:'POST',
                                        data: {
                                                userId: userId,
                                                f_name: document.getElementById('firstNameUpdate').value,
                                                l_name: document.getElementById('lastNameUpdate').value,
                                                email: document.getElementById('emailUpdate').value,
                                        },
                                        url:'database/update-user.php',
                                        dataType: 'json',
                                        success: function(data){
                                            if(data.success){
                                                    BootstrapDialog.alert({
                                                    type: BootstrapDialog.TYPE_SUCCESS,
                                                    message: data.message,
                                                    callback: function(){
                                                        location.reload();
                                                    }
                                                });
                                            }else {
                                                BootstrapDialog.alert({
                                                type: BootstrapDialog.TYPE_DANGER,
                                                message: data.message,
                                                callback: function(){
                                                    location.reload();
                                                }
                                            });
                                        }
                                        },
                                    });
                                        }
                                    }
                        });
            }
        });
    
    }
}
    
    var script = new script; 
    script.initialize();
