@extends('profile/mainPageProfile')
@section('contentThird')
    <div class="container" style="width: 50%;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel  settings">

                    <div class="container " style="width:100%;">
                        <p class="main_settings">MAIN SETTINGS</p>
                        <div style="width: 40%; float:left;">
                            <h4 align="center"><p style="font-weight: bold;">Name</p></h4>
                        </div>
                        <div style="width: 50%; float:left;">
                            <textarea id="nameArea" align="left" class="text-center" rows="1"
                                      disabled>{{$user->name}}</textarea>
                        </div>
                        <div style="width: 10%;  float:right; color: #d58512;">
                            <button id="nameBtn" class="btn btn-warning" onclick="allowChangesName()">Edit</button>
                        </div>
                    </div>


                    <div class="container" style="width:100%;">
                        <div style="width: 40%; float:left;">
                            <h4 align="center"><p style="font-weight: bold;">E-mail (uses for login)</p></h4>
                        </div>
                        <div style="width: 50%; float:left;">
                            <textarea id="emailArea" align="left" class="text-center" rows="1"
                                      disabled>{{$user->email}}</textarea>
                        </div>
                        <div style="width: 10%;  float:right; color: #d58512;">
                            <button id="emailBtn" class="btn btn-warning" onclick="allowChangesEmail()">Edit</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function allowChangesName() {
            var button = document.getElementById("nameBtn");
            var nameArea = document.getElementById("nameArea");
            if (nameArea.disabled == true) {
                nameArea.disabled = false;
                button.textContent = "Save";
                button.style.backgroundColor = "#228B22";
            }else{
                sentData(nameArea.value,document.getElementById("emailArea").value);
                nameArea.disabled = true;
                button.textContent = "Edit";
                button.style.backgroundColor = "#cbb956";
            }
        }

        function allowChangesEmail() {
            var button = document.getElementById("emailBtn");
            var emailArea = document.getElementById("emailArea");

            if (emailArea.disabled == true) {
                emailArea.disabled = false;
                button.textContent = "Save";
                button.style.backgroundColor = "#228B22";
            }else{
                sentData(document.getElementById("nameArea").value,emailArea.value);
                emailArea.disabled = true;
                button.textContent = "Edit";
                button.style.backgroundColor = "#cbb956";
            }
        }
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function sentData(nameArea,emailArea) {
            $.ajax({
                type:'POST',
                url:'http://whatshappened/public/showProfile/edit',
                data: {name:nameArea,email:emailArea,_token: CSRF_TOKEN},
                dataType: 'json',
                success:function(data) {

                }
            });
        }
    </script>

@stop